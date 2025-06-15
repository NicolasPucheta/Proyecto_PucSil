<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniterCart\Cart;
use CodeIgniter\Config\Services;
use App\Models\Producto_Model;
use App\Models\Pedidos_model;
use App\Models\DetallePedido_model;
use App\Models\Ventas_cabecera_model;
use App\Models\Ventas_detalle_model;



class carrito_controller extends BaseController
{
    protected $session;
    protected $cart;

    public function __construct()
    {
        helper(['form', 'url', 'cart']);
        $this->cart = \Config\Services::cart();
        $this->session = session();
    }

    public function catalogo()
    {
        $productoModel = new Producto_Model();
        $data['producto'] = $productoModel->orderBy('id', 'DESC')->findAll();
        $data['Titulo'] = 'Todos los Productos';

        echo view('front/head_view', $data);
        echo view('front/nav_view');
        echo view('back/carrito/productos_catalogo_view', $data);
        echo view('front/footer_view');
    }

   public function Carrito()// carrito que se muestra
    {
        $cart = \Config\Services::cart();
        $cart = $cart->contents();
        
        // Obtener el stock de los productos
        $productoModel = new Producto_Model();
        foreach ($cart as &$item) {
            $producto = $productoModel->getProducto($item['id']);
            $item['stock'] = $producto ? $producto['stock'] : 0;
        }

        $data['cart'] = $cart;
        $data['Titulo'] = 'Carrito';
        
        echo view('front/head_view', $data);
        echo view('front/navbar', $data); 
        echo view('front/Carrito', $data); 
        echo view('front/footer_view');
    }
 
        public function finalizarCompra()
    {
        $carrito = $this->cart->contents();
        $total = $this->cart->total();

        $data = [
            'Titulo' => 'Finalizar Compra',
            'carrito' => $carrito,
            'total' => $total
        ];

        echo view('front/head_view', $data);
        echo view('front/navbar', $data);
        echo view('front/detalleCompra', $data); // Asegurate de que este es el archivo donde tenés el código HTML
        echo view('front/footer_view');
    }


    public function add()
    {
        $request = \Config\Services::request();
    
        $this->cart->insert([
            'id' => $request->getPost('id'),
            'qty' => 1,
            'name' => $request->getPost('nombre_prod'),
            'price' => $request->getPost('precio_vta'),
            'imagen' => $request->getPost('imagen'),
        ]);
    
        // Setear mensaje flash
        $this->session->setFlashdata('success', 'Producto agregado al carrito correctamente.');
    
        return redirect()->back();
    }
    

    public function eliminar_item($rowid)
    {
        $this->cart->remove($rowid);
        return redirect()->to(base_url('muestro'));
    }

    public function borrar_carrito()
    {
        $this->cart->destroy();
        return redirect()->to(base_url('muestro'));
    }

    public function remove($rowid)
    {
        if ($rowid === "all") {
            $this->cart->destroy();
        } else {
            $this->cart->remove($rowid);
        }
        return redirect()->back();
    }

    public function actualiza_carrito()
    {
        $data = [
            'rowid' => $this->request->getPost('rowid'),
            'qty' => $this->request->getPost('qty'),
            'price' => $this->request->getPost('price'),
            'name' => $this->request->getPost('name'),
        ];

        $this->cart->update($data);
        return redirect()->back();
    }

    public function devolver_carrito()
    {
        return $this->cart->contents();
    }

    public function suma($rowid)
    {
        $carrito = $this->cart->contents();

        foreach ($carrito as $item) {
            if ($item['rowid'] === $rowid) {
                $data = [
                    'rowid' => $rowid,
                    'qty' => $item['qty'] + 1
                ];
                $this->cart->update($data);
                break;
            }
        }

        return redirect()->back();
    }

    public function resta($rowid)
    {
        $carrito = $this->cart->contents();

        foreach ($carrito as $item) {
            if ($item['rowid'] === $rowid) {
                if ($item['qty'] > 1) {
                    $data = [
                        'rowid' => $rowid,
                        'qty' => $item['qty'] - 1
                    ];
                    $this->cart->update($data);
                } else {
                    $this->cart->remove($rowid);
                }
                break;
            }
        }

        return redirect()->back();
    }


    public function procesar_compra()
{
    $cart = $this->cart->contents();

    if (empty($cart)) {
        return redirect()->to(base_url('carrito'))->with('error', 'No hay productos en el carrito.');
    }

    // Obtener usuario_id de la sesión
    $usuario_id = session()->get('id');
    if (!$usuario_id) {
        return redirect()->to('/login')->with('error', 'Debe iniciar sesión para realizar la compra.');
    }

    // Calcular total del carrito
    $total = 0;
    foreach ($cart as $item) {
        $total += $item['price'] * $item['qty'];
    }

    // Obtener método de pago/envío del form
    $metodo_pago = $this->request->getPost('metodo_pago');
    $metodo_envio = $this->request->getPost('metodo_envio');

    // Costo de envío
    $costo_envio = 0;
    switch ($metodo_envio) {
        case 'domicilio':
            $costo_envio = 1000;
            break;
        case 'correo':
            $costo_envio = 1500;
            break;
    }

    $total_final = $total + $costo_envio;

    // Insertar en ventas_cabecera
    $ventaCabeceraModel = new Ventas_cabecera_model();
    $ventaDetalleModel = new Ventas_detalle_model();

    $idVenta = $ventaCabeceraModel->insert([
        'usuario_id' => $usuario_id,
        'total_venta' => $total_final,
        'fecha' => date('Y-m-d H:i:s')
    ]);

    // Insertar los detalles de la venta
    foreach ($cart as $item) {
        $ventaDetalleModel->insert([
            'venta_id' => $idVenta,
            'producto_id' => $item['id'],
            'cantidad' => $item['qty'],
            'precio' => $item['price']
        ]);
    }
    $data['Titulo'] = 'Proceso compra';
    echo view('front/head_view', $data);
    echo view('front/navbar');    
    // MOSTRAR VISTA ANTES DE BORRAR CARRITO
    echo view('front/procesarPago', [
        'cart' => $cart,
        'metodo_pago' => $metodo_pago,
        'metodo_envio' => $metodo_envio,
        'total' => $total,
        'costo_envio' => $costo_envio,
        'total_final' => $total_final,
        'confirmacion' => true,
        'idVenta' => $idVenta,
        'fecha' => date('Y-m-d H:i:s')
    ]);
    echo view('front/footer_view');

    // AHORA sí, destruir el carrito DESPUÉS de mostrar la vista
    $this->cart->destroy();
}

public function mostrarDatosPago()
{
    // Recibir los datos enviados por POST
    $metodo_pago = $this->request->getPost('metodo_pago');
    $metodo_envio = $this->request->getPost('metodo_envio');
    $total_pagar = $this->request->getPost('total_pagar');

    // Pasar datos a la vista
    $data = [
        'metodo_pago' => $metodo_pago,
        'metodo_envio' => $metodo_envio,
        'total_pagar' => $total_pagar,
    ];
    $data['Titulo'] = 'Datos pago';
    echo view('front/head_view', $data);
    echo view('front/navbar'); 
    echo view('front/mostrarDatosPago', $data);
    echo view('front/footer_view');

}

}
