<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniterCart\Cart;
use CodeIgniter\Config\Services;
use App\Models\Producto_Model;

class carrito_controller extends BaseController
{
    protected $session;
    protected $cart;

      public function __construct()
    {
        helper(['form', 'url', 'cart']);
        $cart = \Config\Services::cart();
        $session = session();
    }

    public function catalogo()
    {
        $productoModel = new Producto_Model();
        $data['producto'] = $productoModel->orderBy('id', 'DESC')->findAll();

        $dato = ['titulo' => 'Todos los Productos'];
        echo view('front/head_view', $dato);
        echo view('front/nav_view');
        echo view('back/carrito/productos_catalogo_view', $data);
        echo view('front/footer_view');
    }

    public function Carrito()// carrito que se muestra
    {
        $cart = \Config\Services::cart();
        $cart = $cart->contents();
        $data['cart'] = $cart;

        $dato['titulo'] = 'Carrito';
        echo view('front/head_view', $data);
        echo view('front/navbar', $data); 
        echo view('front/Carrito', $data); 
        echo view('front/footer_view');
    }
 
    public function finalizarCompra()
    {
        $data['Titulo'] = 'Finalizar Compra';
        echo view('front/head_view', $data);
        echo view('front/navbar', $data);
        echo view('front/detalleCompra'); 
        echo view('front/footer_view');
    }

    public function add() // Agregar productos al carrito
    {
        $request = \Config\Services::request();
        $this->cart->insert([
            'id' => $request->getPost('id'),
            'qty' => 1,
            'name' => $request->getPost('nombre_prod'),
            'price' => $request->getPost('precio_vta'),
            'imagen' => $request->getPost('imagen'),
        ]);
        return redirect()->back()->withInput();
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
}
