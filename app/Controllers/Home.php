<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data['Titulo'] = 'principal';
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

    public function productos()
    {
        $data['Titulo'] = 'Productos';
        echo view('front/head_view',$data);
        echo view('front/navbar',$data);
        echo view('front/Productos');
        echo view('front/footer_view');
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

