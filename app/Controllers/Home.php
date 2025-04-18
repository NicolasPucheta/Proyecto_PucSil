<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('principal') ;
    }

    public function legal(): string
    {
        $data['Titulo'] = 'Legal';
        return view('front/head_view') . view('front/Legal', $data) . view('front/footer_view');
    }

    public function quienesSomos(): string
    {
        $data['Titulo'] = 'Quienes Somos?';
        return view('front/head_view') . view('front/Quienes_Somos', $data) . view('front/footer_view');
    }

    public function ayuda(): string
    {
        $data['Titulo'] = 'Ayuda';
        return view('front/head_view') . view('front/Ayuda', $data);
    }
    public function comercializacion(): string
    {
    $data['Titulo'] = 'Comercializacion';
    return view('front/head_view') . view('front/Comercializacion', $data);
    }
}
