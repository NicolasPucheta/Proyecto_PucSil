<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('principal');
    }
    public function legal(): string
    {
        $data['Titulo'] = 'Legal';
        return view('front/Legal', $data);

    }
}
