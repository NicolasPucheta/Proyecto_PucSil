<?php
namespace App\Controllers;

use App\Models\Producto_Model;
use App\Models\Usuario_Model;
//use App\Models\Ventas_cabecera_model;
//use App\Models\Ventas_detalle_model;
use App\Models\categoria_model;
use CodeIgniter\Controller;

class ProductoController extends Controller {

    public function __construct() {
        helper(['url', 'form']);
        $session = session();
    }

    // Mostrar productos en lista
    public function index() {
        $productoModel = new Producto_Model();
        $data['producto'] = $productoModel->getProductoAll(); // función en el modelo

        $data['titulo'] = 'Crud productos';
        echo view('front/head_view', $data);
        echo view('front/navbar');
        echo view('back/productos/producto_nuevo_view', $data);
        echo view('front/footer_view');
    }

    // Cargar el formulario para crear un nuevo producto
    public function crearProducto() {
        $categoriaModel = new categoria_model();
        $data['categorias'] = $categoriaModel->getCategorias(); // trae las categorías de la DB

        $productoModel = new Producto_Model();
        $data['producto'] = $productoModel->getProductoAll();

        $data['titulo'] = 'Alta producto';
        echo view('front/head_view', $data);
        echo view('front/navbar');
        echo view('back/productos/alta_producto_view', $data);
        echo view('front/footer_view');
    }

    // Guardar producto en la base de datos
    public function store() {
        $input = $this->validate([
            'nombre_prod' => 'required|min_length[3]',
            'categoria' => 'is_not_unique[categorias.id]',
            'precio' => 'required|numeric',
            'precio_vta' => 'required|numeric',
            'stock' => 'required|numeric',
            'stock_min' => 'required|numeric',
            'imagen' => 'uploaded[imagen]'
        ]);

        $productoModel = new Producto_Model();

        if ($input) {
            $categoria_model = new categoria_model();
            $data['categorias'] = $categoria_model->getCategorias();
            $data['validation'] = $this->validator;

            $data['titulo'] = 'Alta';
            echo view('front/head_view', $data);
            echo view('front/navbar');
            echo view('back/productos/alta_producto_view', $data);
        } else {
            $img = $this->request->getFile('imagen');
            $nombre_aleatorio = $img->getRandomName();
            $img->move(ROOTPATH . 'assets/uploads/', $nombre_aleatorio);

            $data = [
                'nombre_prod' => $this->request->getVar('nombre_prod'),
                'imagen' => $img->getName(),
                'categoria_id' => $this->request->getVar('categoria'),
                'precio' => $this->request->getVar('precio'),
                'precio_vta' => $this->request->getVar('precio_vta'),
                'stock' => $this->request->getVar('stock'),
                'stock_min' => $this->request->getVar('stock_min')
            ];

            $producto = new Producto_Model();
            $producto->insert($data);
            session()->setFlashdata('success', 'Alta Exitosa...');
            return $this->response->redirect(site_url('crear'));
        }
    }
}
