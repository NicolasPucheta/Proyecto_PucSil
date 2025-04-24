<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data['Titulo'] = 'principal';
        echo view('principal');
    }

    public function legal()
    {
        $data['Titulo'] = 'Legal';
        echo view('front/head_view');
        echo view('front/Legal', $data);
        echo view('front/footer_view');
    }

    public function quienesSomos()
    {
        $data['Titulo'] = 'Quienes Somos?';
        echo view('front/head_view');
        echo view('front/Quienes_Somos', $data);
        echo view('front/footer_view');
    }

    public function ayuda()
    {
        $data['Titulo'] = 'Ayuda';
        echo view('front/head_view');
        echo view('front/Ayuda', $data);
        echo view('front/footer_view');
    }

    public function comercializacion()
    {
        $data['Titulo'] = 'Comercializacion';
        echo view('front/head_view');
        echo view('front/Comercializacion', $data);
        echo view('front/footer_view');
    }

    public function productos()
    {
        $data['Titulo'] = 'Productos';
        echo view('front/head_view');
        echo view('front/Productos', $data);
        echo view('front/footer_view');
    }

    public function carrito()
    {
        $data['Titulo'] = 'Carrito';
        echo view('front/head_view');
        echo view('front/Carrito', $data);
        echo view('front/footer_view');
    }
}

