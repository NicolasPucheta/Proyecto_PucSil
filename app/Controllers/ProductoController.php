<?php
namespace App\Controllers;

use App\Models\Producto_Model;
use App\Models\Usuario_Model;
use App\Models\categoria_model;
use CodeIgniter\Controller;

class ProductoController extends Controller {

    public function __construct() {
        helper(['url', 'form']);
        $session = session(); 
    }

    // Método para mostrar productos en el CRUD del backend 
    public function index() {
        $productoModel = new Producto_Model();
        $data['productos'] = $productoModel->where('eliminado', 0)->findAll(); 

        $data['Titulo'] = 'Crud productos';
        echo view('front/head_view', $data);
        echo view('front/navbar');
        echo view('front/CRUD_productos', $data); 
        echo view('front/footer_view');
    }

    public function mostrarProductosFront() {
        $session = session();
        $categoria = $session->get('id'); // ID de la categoría seleccionada

        $productoModel = new Producto_Model();

        // Filtrar productos por 'eliminado = 0' y por 'categoria_id'
        if ($categoria) {
            $productos = $productoModel
                ->where('eliminado', 0)
                ->where('categoria_id', $categoria)
                ->findAll();
        } else {
            // Si no hay categoría, mostrar todos los productos no eliminados
            $productos = $productoModel->where('eliminado', 0)->findAll();
        }

        $data['productos'] = $productos;
        $data['Titulo'] = 'Nuestros Productos';
        echo view('front/head_view', $data);
        echo view('front/navbar');
        echo view('front/Productos', $data);
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
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
    
        $img = $this->request->getFile('imagen');
        $nombre_aleatorio = $img->getRandomName();
        // Asegúrate de que ROOTPATH . 'assets/uploads/' sea la ruta correcta donde quieres guardar las imágenes.
        // Y que esta ruta sea accesible públicamente desde la web.
        $img->move(ROOTPATH . 'public/assets/uploads/', $nombre_aleatorio); 

        $data = [
            'nombre_prod' => $this->request->getVar('nombre_prod'),
            'imagen' => 'assets/uploads/' . $nombre_aleatorio, 
            'categoria_id' => $this->request->getVar('categoria'),
            'precio' => $this->request->getVar('precio'),
            'precio_vta' => $this->request->getVar('precio_vta'),
            'stock' => $this->request->getVar('stock'),
            'stock_min' => $this->request->getVar('stock_min'),
            'eliminado' => 0 
        ];
    
        $productoModel = new Producto_Model(); // Instancia el modelo
        $productoModel->insert($data);
    
        session()->setFlashdata('success', 'Producto creado correctamente.');
        return $this->response->redirect(site_url('crearProducto')); // Redirige a la página de creación de productos
    }

    public function listar()
    {
        $productoModel = new Producto_Model();
        // Revisa si la columna es 'activo' o 'eliminado'. Usaré 'eliminado' = 0.
        $productos = $productoModel->where('eliminado', 0)->findAll(); 

        return $this->response->setJSON($productos);
    }

    public function productosPorCategoria($categoriaId = null)
{
    $productoModel = new Producto_Model();
    $categoriaModel = new categoria_model();

    // Si se pasa un ID de categoría
    if ($categoriaId) {
        // Buscar categoría
        $categoria = $categoriaModel->find($categoriaId);

        if (!$categoria) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Categoría no encontrada');
        }

        // Obtener productos de esa categoría
        $productos = $productoModel
            ->where('eliminado', 0)
            ->where('categoria_id', $categoriaId)
            ->findAll();

        $titulo = 'Categoría: ' . $categoria['descripcion'];
    } else {
        // Si no hay categoría, mostrar todos los productos
        $productos = $productoModel->where('eliminado', 0)->findAll();
        $titulo = 'Todos los Productos';
    }

    $data = [
        'productos' => $productos,
        'Titulo' => $titulo
    ];

    echo view('front/head_view', $data);
    echo view('front/navbar');
    echo view('front/Productos', $data);
    echo view('front/footer_view');
}

}