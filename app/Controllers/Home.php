<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data['Titulo'] = 'GGHardware';
        echo view('front/head_view',$data);
        echo view('front/navbar',$data);
        echo view('principal');
        echo view('front/footer_view');
    }

    public function legal()
    {
        $data['Titulo'] = 'Legal';
        echo view('front/head_view',$data);
        echo view('front/navbar',$data);
        echo view('front/Legal');
        echo view('front/footer_view');
    }

    public function quienesSomos()
    {
        $data['Titulo'] = 'Quienes Somos';
        echo view('front/head_view',$data);
        echo view('front/navbar',$data);
        echo view('front/Quienes_Somos');
        echo view('front/footer_view');
    }

    public function ayuda()
    {
        $data['Titulo'] = 'Ayuda';
        echo view('front/head_view',$data);
        echo view('front/navbar',$data);
        echo view('front/Ayuda');
        echo view('front/footer_view');
    }

    public function comercializacion()
    {
        $data['Titulo'] = 'Comercializacion';
        echo view('front/head_view',$data);
        echo view('front/navbar',$data);
        echo view('front/Comercializacion');
        echo view('front/footer_view');
    }
    
    public function usuarioData()
    {
        $data['Titulo'] = 'Mis datos';
        echo view('front/head_view',$data);
        echo view('front/navbar',$data);
        echo view('back/usuarioData');
        echo view('front/footer_view');
    }
    /*
    public function Procesadores()
    {
        $data['Titulo'] = 'Procesadores';
        echo view('front/head_view', $data);
        echo view('front/navbar',$data);
        echo view('front/Procesadores',$data);
        echo view('front/footer_view',$data );
    }

    public function Motherboard()
    {
        $data['Titulo'] = 'Motherboard';
        echo view('front/head_view', $data);
        echo view('front/navbar',$data);
        echo view('front/motherboard',$data);
        echo view('front/footer_view',$data );
    }
    public function placas_video()
    {
        $data['Titulo'] = 'Placas de Video';
        echo view('front/head_view', $data);
        echo view('front/navbar',$data);
        echo view('front/placas-videos',$data);
        echo view('front/footer_view',$data );
    }

    public function Almacenamiento()
    {
        $data['Titulo'] = 'Almacenamiento';
        echo view('front/head_view', $data);
        echo view('front/navbar',$data);
        echo view('front/almacenamiento',$data);
        echo view('front/footer_view',$data );
    }
    public function memorias_ram() 
    {
        $data['Titulo'] = 'Memoria RAM';
        echo view('front/head_view', $data);
        echo view('front/navbar',$data);
        echo view('front/memorias-ram',$data);
        echo view('front/footer_view',$data );
    }
    */
    public function carrito()
    {
        $data['Titulo'] = 'Carrito';
        echo view('front/head_view',$data);
        echo view('front/navbar',$data);
        echo view('front/Carrito');
        echo view('front/footer_view');
    }

     public function finalizarCompra()
    {
        $data['Titulo'] = 'Finalizar Compra';
        echo view('front/head_view',$data);
        echo view('front/navbar',$data);
        echo view('front/detalleCompra');
        echo view('front/footer_view');
    }


    public function principal()
    {
    $data['Titulo'] = 'Principal';
    echo view('front/head_view', $data);
    echo view('front/navbar', $data);
    echo view('principal', $data);
    echo view('front/footer_view', $data);
    }

    public function registro()
    {
        $data['Titulo'] = 'Registro';
        echo view('front/head_view',$data);
        echo view('front/navbar',$data);
        echo view('back/usuario/registrarse');
        echo view('front/footer_view');
    }

    public function login()
    {
        $data['Titulo'] = 'Login';
        echo view('front/head_view', $data);
        echo view('front/navbar',$data);
        echo view('front/inicio_sesion', $data); 
        echo view('front/footer_view',$data );

    }

    public function Cargar_Producto()
    {
        $data['Titulo'] = 'Nuevo Producto';
        echo view('front/head_view',$data);
        echo view('front/navbar',$data);
        echo view('back/producto/alta_producto_view',$data);
        echo view('front/footer_view',$data);
    }
   
    public function Crud_Usuarios()
    {
        $data['Titulo'] = 'CRUD Productos';
        echo view('front/head_view',$data);
        echo view('front/navbar',$data);
        echo view('front/CRUD_usuario',$data);
        echo view('front/footer_view',$data);
    }

    
}


