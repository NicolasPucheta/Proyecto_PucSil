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

        $data['Titulo'] = 'Crud productos';
        echo view('front/head_view', $data);
        echo view('front/navbar');
        echo view('front/CRUD_productos', $data);
        echo view('front/footer_view');
    }

    // Cargar el formulario para crear un nuevo producto
    public function crearProducto() {
        $categoriaModel = new categoria_model();
        $data['categorias'] = $categoriaModel->getCategorias(); // trae las categorías de la DB

        $productoModel = new Producto_Model();
        $data['producto'] = $productoModel->getProductoAll();

        $data['Titulo'] = 'Alta producto';
        echo view('front/head_view', $data);
        echo view('front/navbar');
        echo view('back/productos/alta_producto_view', $data);
        echo view('front/footer_view');
    }

    // Guardar producto en la base de datos
    public function store() {
        $input = $this->validate([
            'nombre_prod' => 'required|min_length[3]',
            'categoria' => 'required|is_not_unique[categorias.id]',
            'precio' => 'required|numeric',
            'precio_vta' => 'required|numeric',
            'stock' => 'required|numeric',
            'stock_min' => 'required|numeric',
            'imagen' => 'uploaded[imagen]|is_image[imagen]|max_size[imagen,2048]'
        ]);
    
        if (!$input) {
            return $this->response->setJSON(['error' => $this->validator->getErrors()]);
        }
    
        $img = $this->request->getFile('imagen');
        $nombre_aleatorio = $img->getRandomName();
        $img->move(ROOTPATH . 'assets/uploads/', $nombre_aleatorio);
    
        $data = [
            'nombre_prod' => $this->request->getVar('nombre_prod'),
            'imagen' => $nombre_aleatorio,
            'categoria_id' => $this->request->getVar('categoria'),
            'precio' => $this->request->getVar('precio'),
            'precio_vta' => $this->request->getVar('precio_vta'),
            'stock' => $this->request->getVar('stock'),
            'stock_min' => $this->request->getVar('stock_min')
        ];
    
        $producto = new Producto_Model();
        $producto->insert($data);
    
        session()->setFlashdata(['success' => 'Producto creado correctamente.']);
        return $this->response->redirect(site_url('crear'));
    }

    public function listar()
    {
        $productoModel = new Producto_Model();
        $productos = $productoModel->where('activo', 1)->findAll();

        return $this->response->setJSON($productos);
    }
}    
