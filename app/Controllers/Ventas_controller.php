<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Usuarios_model;
use App\Models\Producto_Model;
use App\Models\Ventas_cabecera_model;
use App\Models\Ventas_detalle_model;
use CodeIgniterCart\Cart;
use CodeIgniter\Config\Services;


class Ventascontroller extends Controller
{
    
    public function registrar_venta()
    {
        $productoModel = new Producto_Model();
        require(APPPATH . 'Controllers/carrito_controller.php');
        $cartController = new carrito_controller();
        $carrito_contents = $cartController->devolver_carrito();

        $productos_validos = [];
        $productos_sin_stock = [];
        $total = 0;

        if (!$session->has('id_usuario')) {
            $session->setFlashdata('mensaje', 'Debe iniciar sesión para finalizar la compra.');
            return redirect()->to(base_url('login'));
        }
        

        // Validar stock y filtrar productos válidos
        foreach ($carrito_contents as $item) {
            $producto = $productoModel->getProducto($item['id']);

            if ($producto && $producto['stock'] >= $item['qty']) {
                $productos_validos[] = $item;
                $total += $item['subtotal'];
            } else {
                $productos_sin_stock[] = $item['name'];
                // Eliminar del carrito el producto sin stock
                $cartController->eliminar_item($item['rowid']);
            }
        }

        $session = session();

        // Si hay productos sin stock, avisar y volver al carrito
        if (!empty($productos_sin_stock)) {
            $mensaje = 'Los siguientes productos no tienen stock suficiente y fueron eliminados del carrito: <br>' 
                        . implode(', ', $productos_sin_stock);
            $session->setFlashdata('mensaje', $mensaje);
            return redirect()->to(base_url('muestro'));
        }

        // Si no hay productos válidos, no se registra la venta
        if (empty($productos_validos)) {
            $session->setFlashdata('mensaje', 'No hay productos válidos para registrar la venta.');
            return redirect()->to(base_url('muestro'));
        }

        // Registrar cabecera de la venta
        $nueva_venta = [
            'usuario_id'   => $session->get('id_usuario'),
            'total_venta'  => $total
        ];
        $venta_id = $ventasModel->insert($nueva_venta);
        
        // Registrar detalle y actualizar stock
        foreach ($productos_validos as $item) {
            $detalle = [
                'venta_id'    => $venta_id,
                'producto_id' => $item['id'],
                'cantidad'    => $item['qty'],
                'precio'      => $item['subtotal']
            ];
            $detalleModel->insert($detalle);
        
            $producto = $productoModel->getProducto($item['id']);
            $productoModel->updateStock($item['id'], $producto['stock'] - $item['qty']);
        }
        
        // Vaciar carrito y mostrar confirmación
        $cartController->borrar_carrito();
        $session->setFlashdata('mensaje', 'Venta registrada exitosamente.');
        return redirect()->to(base_url('vista_compras/' . $venta_id));
    }
    public function mostrar_resumen_ventas()
    {
        $ventasModel = new \App\Models\Ventas_cabecera_model();
        $sumaTotal = $ventasModel->obtenerSumaTotalVentas();

        $data = [
            'Titulo' => 'Resumen de Ventas',
            'sumaTotal' => $sumaTotal,
            // Otros datos como la lista de ventas si es necesario
        ];


        echo view('front/head_view', $data);
        echo view('front/navbar');
        echo view('back/Muestra_ventas', $data);
        echo view('front/footer_view');
       
    }
    
    public function data()
    {
        $ventasModel = new Ventas_cabecera_model();

        $fechaInicio = $this->request->getGet('fechaInicio');
        $fechaFin = $this->request->getGet('fechaFin');

        $ventas = $ventasModel->obtenerVentasConDetalles($fechaInicio, $fechaFin);

        return $this->response->setJSON($ventas);
    }

}
