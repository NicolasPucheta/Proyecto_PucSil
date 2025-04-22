<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Carrito Detallado</title>
  <link rel="stylesheet" href="assets\css\InicioSesion-Carrito.css" />
</head>
<body class="carrito-page">

  <main class="carrito-amplio">
    <h2 class="titulo-carrito">🛍️ Carrito de Compras</h2>

    <!-- Producto -->
    <div class="producto">
      <img src="https://via.placeholder.com/120" alt="Producto 1">
      <div class="detalle">
        <h3>Producto Premium</h3>
        <p class="descripcion">Un producto de calidad excepcional con materiales duraderos y diseño moderno. Ideal para uso diario.</p>
        <div class="cantidad-controles">
          <button class="btn-control">➖</button>
          <span class="cantidad">1</span>
          <button class="btn-control">➕</button>
        </div>
      </div>
      <div class="precio">$49.99</div>
    </div>

    <!-- Producto 2 -->
    <div class="producto">
      <img src="https://via.placeholder.com/120" alt="Producto 2">
      <div class="detalle">
        <h3>Accesorio Pro</h3>
        <p class="descripcion">Accesorio compatible con múltiples dispositivos. Ligero, compacto y funcional para llevar a todas partes.</p>
        <div class="cantidad-controles">
          <button class="btn-control">➖</button>
          <span class="cantidad">2</span>
          <button class="btn-control">➕</button>
        </div>
      </div>
      <div class="precio">$89.98</div>
    </div>

    <!-- Total y acción -->
    <div class="resumen">
      <span>Total:</span>
      <span class="total-precio">$139.97</span>
    </div>

    <div class="acciones">
      <button class="btn ir-a-pagar">💳 Ir a Pagar</button>
    </div>
  </main>

</body>
</html>
