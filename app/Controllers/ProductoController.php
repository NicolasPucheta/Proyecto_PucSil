<?php
namespace App\Controllers;

use App\Models\Producto_Model;
use App\Models\Usuario_Model; // Asegúrate de que esta línea esté presente si usas Usuario_Model
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
        // Carga productos no eliminados para el CRUD del administrador
        $data['productos'] = $productoModel->where('eliminado', 0)->findAll(); 

        $data['Titulo'] = 'Crud productos';
        echo view('front/head_view', $data);
        echo view('front/navbar');
        echo view('front/CRUD_productos', $data); 
        echo view('front/footer_view');
    }

    // maneja la visualización de todos los productos, por categoría y por búsqueda
    public function mostrarProductosFront() {
        $session = session();
        $productoModel = new Producto_Model();
        $data['productos'] = []; // Inicializamos el array de productos
        $data['search_query'] = null; // Inicializamos la variable de búsqueda

        // 1. Verificar si hay una consulta de búsqueda
        $query = $this->request->getGet('query'); 

        if ($query) {
            // Si hay una consulta, realizar la búsqueda por nombre del producto
            $data['productos'] = $productoModel
                                    ->where('eliminado', 0) // Solo productos no eliminados
                                    ->like('nombre_prod', $query)
                                    ->findAll();
            $data['search_query'] = $query; // Pasar la consulta a la vista para mostrarla
            $data['Titulo'] = 'Resultados de búsqueda';
        } else {
            // 2. Si NO hay consulta de búsqueda, verificar si hay un filtro por categoría
            $categoria_id_session = $session->get('id_categoria_filtro'); // Usar un nombre de sesión más específico si es necesario
            
            // Si la URL tiene un parámetro de categoría, priorizarlo sobre la sesión
            $categoria_id_url = $this->request->getGet('categoria'); 
            $categoria_a_usar = $categoria_id_url ?? $categoria_id_session;

            if ($categoria_a_usar) {
                // Si hay una categoría, filtrar productos por esa categoría
                $productos = $productoModel
                    ->where('eliminado', 0)
                    ->where('categoria_id', $categoria_a_usar)
                    ->findAll();
                
                // Opcional: Obtener el nombre de la categoría para el título
                $categoriaModel = new categoria_model();
                $categoria_info = $categoriaModel->find($categoria_a_usar);
                $data['Titulo'] = 'Productos en ' . ($categoria_info['descripcion'] ?? 'Categoría');

            } else {
                // Si no hay búsqueda ni categoría, mostrar todos los productos no eliminados
                $productos = $productoModel->where('eliminado', 0)->findAll();
                $data['Titulo'] = 'Todos nuestros Productos';
            }
            $data['productos'] = $productos;
        }
        
        echo view('front/head_view', $data);
        echo view('front/navbar');
        echo view('front/Productos', $data); // Tu vista de productos existente
        echo view('front/footer_view');
    }

    public function mostrarVentas()
    {
        echo view('front/head_view');
        echo view('front/navbar');
        echo view('back/ventas/Muestra_ventas'); // tu vista actual con la tabla
        echo view('front/footer_view');
    }
        
    public function obtenerVentas()
    {
        $ventasCabeceraModel = new \App\Models\Ventas_cabecera_model();
        $ventasDetalleModel = new \App\Models\Ventas_detalle_model();
        $productoModel = new Producto_model();

        $id_usuario = session()->get('usuario_id');

        // Obtener fechas del GET
        $fecha_inicio = $this->request->getGet('fecha_inicio');
        $fecha_fin = $this->request->getGet('fecha_fin');

        // Formatear fechas con horas para asegurar el rango completo
        if ($fecha_inicio) {
            $fecha_inicio .= ' 00:00:00';
        }
        if ($fecha_fin) {
            $fecha_fin .= ' 23:59:59';
        }

        // Usar método del modelo con los parámetros
        $ventasCabeceras = $ventasCabeceraModel->getVentas($id_usuario, $fecha_inicio, $fecha_fin);

        $ventas = [];

        foreach ($ventasCabeceras as $venta) {
            $detalles = $ventasDetalleModel->getDetalles($venta['id']);

            foreach ($detalles as $detalle) {
                $producto = $productoModel->find($detalle['producto_id']);

                $ventas[] = [
                    'fecha' => $venta['fecha'],
                    'producto' => $producto['nombre_prod'] ?? 'Producto desconocido',
                    'cantidad' => $detalle['cantidad'],
                    'precio' => number_format($detalle['precio'], 2, '.', ''),
                    'total' => number_format($detalle['precio'] * $detalle['cantidad'], 2, '.', '')
                ];
            }
        }

        return $this->response->setJSON($ventas);
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
    
    public function eliminar($id)
    {
        $productoModel = new Producto_model();

        // Verificamos si el producto existe
        $producto = $productoModel->find($id);
        if (!$producto) {
            session()->setFlashdata('mensaje', 'Producto no encontrado.');
            session()->setFlashdata('tipo', 'danger');
            return redirect()->to('/');
        }

        // Eliminación lógica
        $productoModel->update($id, ['eliminado' => 1]);

        session()->setFlashdata('mensaje', 'Producto eliminado correctamente.');
        session()->setFlashdata('tipo', 'success');

        return redirect()->to('crudProductos');
    }

    public function productosEliminados()
    {
        $productoModel = new Producto_Model();
        $data['productos'] = $productoModel->where('eliminado', 1)->findAll(); 
        $data['Titulo'] = 'Productos Eliminados';

        echo view('front/head_view', $data);
        echo view('front/navbar');
        echo view('back/productos/productosEliminados', $data); 
        echo view('front/footer_view');
    }

    public function restaurar($id)
    {
        $productoModel = new Producto_Model();

        $producto = $productoModel->find($id);
        if (!$producto) {
            session()->setFlashdata('mensaje', 'Producto no encontrado.');
            session()->setFlashdata('tipo', 'danger');
            return redirect()->to('productosEliminados');
        }

        $productoModel->update($id, ['eliminado' => 0]);

        session()->setFlashdata('mensaje', 'Producto restaurado correctamente.');
        session()->setFlashdata('tipo', 'success');
        return redirect()->to('productosEliminados');
    }

    
    public function editar($id)
    {
        $productoModel = new Producto_model();
        $producto = $productoModel->find($id);
        $categoriaModel = new Categoria_model();
        $categorias = $categoriaModel->findAll();

        if (!$producto) {
            return redirect()->to('crudProductos')->with('fail', 'Producto no encontrado');
        }

        echo view('front/head_view', ['Titulo' => 'Editar Producto']);
        echo view('front/navbar');
        echo view('back/productos/editar_producto', [
            'producto' => $producto,
            'categorias' => $categorias
        ]);
        echo view('front/footer_view');

    }

    public function actualizarProducto()
    {
        $productoModel = new Producto_model();
        $id = $this->request->getPost('id');

        $rules = [
            'nombre_prod' => 'required|min_length[3]',
            'categoria' => 'required|is_natural_no_zero',
            'precio' => 'required|decimal',
            'precio_vta' => 'required|decimal',
            'stock' => 'required|integer',
            'stock_min' => 'required|integer',
            'imagen' => 'uploaded[imagen]|max_size[imagen,2048]|is_image[imagen]|mime_in[imagen,image/jpg,image/jpeg,image/png]'
        ];

        // Si no se sube una nueva imagen, no validamos el campo
        if ($this->request->getFile('imagen')->getError() === 4) {
            unset($rules['imagen']);
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $data = [
            'nombre_prod' => $this->request->getPost('nombre_prod'),
            'categoria_id' => $this->request->getPost('categoria'),
            'precio' => $this->request->getPost('precio'),
            'precio_vta' => $this->request->getPost('precio_vta'),
            'stock' => $this->request->getPost('stock'),
            'stock_min' => $this->request->getPost('stock_min')
        ];

        $imagen = $this->request->getFile('imagen');
        if ($imagen && $imagen->isValid() && !$imagen->hasMoved()) {
            $nombreImagen = $imagen->getRandomName();
            $imagen->move(FCPATH . 'assets/uploads/', $nombreImagen);
            $data['imagen'] = $nombreImagen;
        }

        $productoModel->update($id, $data);
        return redirect()->to('crudProductos')->with('success', 'Producto actualizado correctamente');
    }
}
