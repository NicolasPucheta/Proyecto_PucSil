<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GGHardware</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@600&family=Roboto&display=swap" rel="stylesheet">
    <link href="<?= base_url('assets/css/inicio.css') ?>" rel="stylesheet">

</head>
<body>
    <nav class="menu">
        <h1 class="titulo"></h1>
        <h2 class="Busqueda"> 
            <form action="/search" method="get">
                <input type="text" placeholder="¿Qué estás buscando?" name="query" class="search-input">
                <button type="submit" class="search-button">🔍</button>
            </form>                                                 
        </h2>  
        <ul> 
            <li><a href="#">Productos</a></li>
            <li><a href="#">Más vendidos</a></li> 
            <li><a href="<?= base_url('quienesSomos'); ?>">Quiénes Somos</a></li>
            <li><a href="#">Ayuda</a></li>
            <li><a href="<?= base_url('legal'); ?>">Legal</a></li>
        </ul>
    </nav>
