<?php
namespace App\Controllers;

use App\Models\Producto_Model;
use App\Models\Usuario_Model;
use App\Models\categoria_model;
use CodeIgniter\Controller;

class ProductoController extends Controller {

    public function __construct() {
        helper(['url', 'form']);
        $session = session(); // Aunque no se usa directamente aquí, está bien que lo tengas
    }

    // Método para mostrar productos en el CRUD del backend (tu función actual)
    public function index() {
        $productoModel = new Producto_Model();
        // Asegúrate de que 'eliminado' sea la columna correcta para productos activos/inactivos
        // Si 'activo' es tu columna, úsala aquí. Asumo 'eliminado' = 0 para activos.
        $data['productos'] = $productoModel->where('eliminado', 0)->findAll(); 

        $data['Titulo'] = 'Crud productos';
        echo view('front/head_view', $data);
        echo view('front/navbar');
        echo view('front/CRUD_productos', $data); // Esta es la vista de tu CRUD
        echo view('front/footer_view');
    }


    // Nuevo método para mostrar productos en el frontend (tu "main class='procesadores'")
    public function mostrarProductosFront() {
        $productoModel = new Producto_Model();
        // Obtener solo los productos que no están "eliminados"
        $data['productos'] = $productoModel->where('eliminado', 0)->findAll(); // Usa 'eliminado' = 0 para activos

        $data['Titulo'] = 'Nuestros Productos'; // Título para la vista del frontend
        
        // Carga tus vistas del frontend (head, navbar, la vista de productos y footer)
        echo view('front/head_view', $data);
        echo view('front/navbar');
        echo view('front/Productos', $data); // ¡Aquí es donde cargas tu vista principal de productos!
        echo view('front/footer_view');
    }

    // Cargar el formulario para crear un nuevo producto
    public function crearProducto() {
        $categoriaModel = new categoria_model();
        $data['categorias'] = $categoriaModel->getCategorias(); // trae las categorías de la DB

        $productoModel = new Producto_Model();
        // Si necesitas todos los productos en el formulario de creación, está bien.
        // Sino, esta línea podría ser redundante aquí.
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
            'categoria' => 'required|is_not_unique[categorias.id]', // Asegúrate que 'categorias.id' sea correcto
            'precio' => 'required|numeric',
            'precio_vta' => 'required|numeric',
            'stock' => 'required|numeric',
            'stock_min' => 'required|numeric',
            'imagen' => 'uploaded[imagen]|is_image[imagen]|max_size[imagen,2048]'
        ]);
    
        if (!$input) {
            // Si hay errores de validación, puedes redirigir con los errores
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
    
        $img = $this->request->getFile('imagen');
        $nombre_aleatorio = $img->getRandomName();
        // Asegúrate de que ROOTPATH . 'assets/uploads/' sea la ruta correcta donde quieres guardar las imágenes.
        // Y que esta ruta sea accesible públicamente desde la web.
        $img->move(ROOTPATH . 'public/assets/uploads/', $nombre_aleatorio); // Recomiendo 'public/'

        $data = [
            'nombre_prod' => $this->request->getVar('nombre_prod'),
            'imagen' => 'assets/uploads/' . $nombre_aleatorio, // Guarda la ruta relativa para usar con base_url()
            'categoria_id' => $this->request->getVar('categoria'),
            'precio' => $this->request->getVar('precio'),
            'precio_vta' => $this->request->getVar('precio_vta'),
            'stock' => $this->request->getVar('stock'),
            'stock_min' => $this->request->getVar('stock_min'),
            'eliminado' => 0 // Asegúrate de establecer esto para nuevos productos
        ];
    
        $productoModel = new Producto_Model(); // Instancia el modelo
        $productoModel->insert($data);
    
        session()->setFlashdata('success', 'Producto creado correctamente.');
        return $this->response->redirect(site_url('crearProducto')); // Redirige a la página de creación de productos
    }

    // Esta función 'listar' parece ser para una API o AJAX, si es para mostrar en el frontend,
    // es mejor usar el método 'mostrarProductosFront' que carga una vista.
    public function listar()
    {
        $productoModel = new Producto_Model();
        // Revisa si la columna es 'activo' o 'eliminado'. Usaré 'eliminado' = 0.
        $productos = $productoModel->where('eliminado', 0)->findAll(); 

        return $this->response->setJSON($productos);
    }
}