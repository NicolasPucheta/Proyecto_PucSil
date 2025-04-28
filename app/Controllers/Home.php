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

    public function Productos()
    {
        $data['Titulo'] = 'Productos';
        echo view('front/head_view',$data);
        echo view('front/navbar',$data);
        echo view('front/productos',$data);
        echo view('front/footer_view',$data);
    }
    
    public function Almacenamiento()
    {
        $data['Titulo'] = 'Almacenamiento';
        echo view('front/head_view', $data);
        echo view('front/navbar',$data);
        echo view('front/almacenamiento',$data);
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

    public function carrito()
    {
        $data['Titulo'] = 'Carrito';
        echo view('front/head_view',$data);
        echo view('front/navbar',$data);
        echo view('front/Carrito');
        echo view('front/footer_view');
    }
}

