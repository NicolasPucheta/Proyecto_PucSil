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

    public function Carrito() // carrito que se muestra
    {
        $cart = \Config\Services::cart();
        $cart = $cart->contents();
        
        // Obtener el stock de los productos para mostrarlo en el carrito si es necesario
        $productoModel = new Producto_Model();
        foreach ($cart as &$item) {
            $producto = $productoModel->getProducto($item['id']);
            $item['stock_disponible'] = $producto ? $producto['stock'] : 0; // Añadir stock disponible
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
        $productoModel = new Producto_Model(); // Instanciar el modelo de producto

        $producto_id = $request->getPost('id');
        $cantidad_a_agregar = 1; // Siempre se agrega 1 por el diseño actual

        // 1. Obtener el producto de la base de datos para verificar el stock
        $producto = $productoModel->find($producto_id);

        if (!$producto) {
            $this->session->setFlashdata('error', 'Producto no encontrado.');
            return redirect()->back();
        }

        $stock_disponible = $producto['stock'];
        $nombre_producto = $producto['nombre_prod']; // Para el mensaje de error

        // 2. Obtener la cantidad actual de este producto en el carrito
        $current_qty_in_cart = 0;
        foreach ($this->cart->contents() as $item) {
            if ($item['id'] == $producto_id) {
                $current_qty_in_cart = $item['qty'];
                break;
            }
        }

        // 3. Validar si la nueva cantidad excede el stock disponible
        if (($current_qty_in_cart + $cantidad_a_agregar) > $stock_disponible) {
            $this->session->setFlashdata('error', 'No hay suficiente stock de "' . esc($nombre_producto) . '". Stock disponible: ' . $stock_disponible);
            return redirect()->back();
        }

        // Si hay stock, agregar al carrito
        $this->cart->insert([
            'id' => $producto_id,
            'qty' => $cantidad_a_agregar,
            'name' => $nombre_producto,
            'price' => $producto['precio_vta'], // Usar el precio de venta del producto de la DB
            'imagen' => $producto['imagen'], // Usar la imagen del producto de la DB
        ]);
        
        $this->session->setFlashdata('success', 'Producto "' . esc($nombre_producto) . '" agregado al carrito correctamente.');
        
        return redirect()->back();
    }
    

    public function eliminar_item($rowid)
    {
        $this->cart->remove($rowid);
        $this->session->setFlashdata('success', 'Producto eliminado del carrito.');
        return redirect()->to(base_url('muestro'));
    }

    public function borrar_carrito()
    {
        $this->cart->destroy();
        $this->session->setFlashdata('success', 'Carrito vaciado correctamente.');
        return redirect()->to(base_url('muestro'));
    }

    public function remove($rowid)
    {
        if ($rowid === "all") {
            $this->cart->destroy();
            $this->session->setFlashdata('success', 'Carrito vaciado correctamente.');
        } else {
            $this->cart->remove($rowid);
            $this->session->setFlashdata('success', 'Producto eliminado del carrito.');
        }
        return redirect()->back();
    }

    public function actualiza_carrito()
    {
        $productoModel = new Producto_Model(); // Instanciar el modelo de producto

        $rowid = $this->request->getPost('rowid');
        $new_qty = (int)$this->request->getPost('qty'); // Asegurarse de que sea un entero

        $item_en_carrito = $this->cart->getItem($rowid); // Obtener el ítem actual del carrito

        if (!$item_en_carrito) {
            $this->session->setFlashdata('error', 'El producto no se encontró en el carrito.');
            return redirect()->back();
        }

        $producto_id = $item_en_carrito['id'];
        $nombre_producto = $item_en_carrito['name'];

        // 1. Obtener el stock disponible del producto
        $producto = $productoModel->find($producto_id);

        if (!$producto) {
            $this->session->setFlashdata('error', 'Producto no encontrado en la base de datos.');
            return redirect()->back();
        }

        $stock_disponible = $producto['stock'];

        // 2. Validar la nueva cantidad vs stock
        if ($new_qty > $stock_disponible) {
            $this->session->setFlashdata('error', 'No hay suficiente stock de "' . esc($nombre_producto) . '". Stock disponible: ' . $stock_disponible . '. La cantidad en el carrito se ajustó a: ' . $stock_disponible);
            
            $data = [
                'rowid' => $rowid,
                'qty' => $stock_disponible // Ajustar a la cantidad máxima disponible
            ];
            $this->cart->update($data);
            
            return redirect()->back();
        }

        if ($new_qty <= 0) { // Si la cantidad es 0 o menos, eliminar el item del carrito
            $this->cart->remove($rowid);
            $this->session->setFlashdata('success', 'Producto "' . esc($nombre_producto) . '" eliminado del carrito.');
        } else {
            $data = [
                'rowid' => $rowid,
                'qty' => $new_qty,
                
            ];
            $this->cart->update($data);
            $this->session->setFlashdata('success', 'Cantidad de "' . esc($nombre_producto) . '" actualizada a ' . $new_qty . '.');
        }
        
        return redirect()->back();
    }

    public function devolver_carrito()
    {
        return $this->cart->contents();
    }

    public function suma($rowid)
    {
        $productoModel = new Producto_Model(); // Instanciar el modelo de producto
        $carrito = $this->cart->contents();

        foreach ($carrito as $item) {
            if ($item['rowid'] === $rowid) {
                $producto_id = $item['id'];
                $nombre_producto = $item['name'];
                $current_qty = $item['qty'];

                // 1. Obtener el stock disponible del producto
                $producto = $productoModel->find($producto_id);
                if (!$producto) {
                    $this->session->setFlashdata('error', 'Producto no encontrado en la base de datos.');
                    return redirect()->back();
                }
                $stock_disponible = $producto['stock'];

                // 2. Validar si al sumar 1 excede el stock
                if (($current_qty + 1) > $stock_disponible) {
                    $this->session->setFlashdata('error', 'No hay suficiente stock de "' . esc($nombre_producto) . '". Stock disponible: ' . $stock_disponible);
                    return redirect()->back();
                }

                // Si hay stock, actualizar
                $data = [
                    'rowid' => $rowid,
                    'qty' => $current_qty + 1
                ];
                $this->cart->update($data);
                $this->session->setFlashdata('success', 'Cantidad de "' . esc($nombre_producto) . '" incrementada.');
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
                $nombre_producto = $item['name'];
                if ($item['qty'] > 1) {
                    $data = [
                        'rowid' => $rowid,
                        'qty' => $item['qty'] - 1
                    ];
                    $this->cart->update($data);
                    $this->session->setFlashdata('success', 'Cantidad de "' . esc($nombre_producto) . '" disminuida.');
                } else {
                    $this->cart->remove($rowid);
                    $this->session->setFlashdata('success', 'Producto "' . esc($nombre_producto) . '" eliminado del carrito.');
                }
                break;
            }
        }
        return redirect()->back();
    }


    public function procesar_compra()
    {
        $cart = $this->cart->contents();
        $productoModel = new Producto_Model(); // Instanciar el modelo de producto

        if (empty($cart)) {
            $this->session->setFlashdata('error', 'No hay productos en el carrito para procesar la compra.');
            return redirect()->to(base_url('carrito'));
        }

        // Obtener usuario_id de la sesión
        $usuario_id = session()->get('id');
        if (!$usuario_id) {
            $this->session->setFlashdata('error', 'Debe iniciar sesión para realizar la compra.');
            return redirect()->to('/login');
        }
        foreach ($cart as $item) {
            $producto = $productoModel->find($item['id']);
            if (!$producto || $producto['stock'] < $item['qty']) {
                // Si el producto no existe o el stock es insuficiente,
                // limpiar el carrito y redirigir con un error
                $this->session->setFlashdata('error', 'Stock insuficiente para el producto "' . esc($item['name']) . '". Stock disponible: ' . ($producto['stock'] ?? 0) . '. Por favor, revise su carrito.');
                $this->cart->destroy(); // Vaciar el carrito para evitar problemas futuros
                return redirect()->to(base_url('carrito'));
            }
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
            default: // Asegurar un valor predeterminado si no se selecciona
                $costo_envio = 0;
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

        if (!$idVenta) {
            $this->session->setFlashdata('error', 'Error al registrar la venta. Por favor, inténtelo de nuevo.');
            return redirect()->to(base_url('carrito'));
        }

        // Insertar los detalles de la venta y DECREMENTAR EL STOCK
        foreach ($cart as $item) {
            $ventaDetalleModel->insert([
                'venta_id' => $idVenta,
                'producto_id' => $item['id'],
                'cantidad' => $item['qty'],
                'precio' => $item['price']
            ]);
            
            // DECREMENTAR EL STOCK DEL PRODUCTO
            $productoModel->decrementStock($item['id'], $item['qty']);
            
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

        $this->cart->destroy();
        $this->session->setFlashdata('success', '¡Compra realizada con éxito! Su número de pedido es: ' . $idVenta);
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
