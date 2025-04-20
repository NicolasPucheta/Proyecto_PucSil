<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <link href="assets/css/inicioSesion-Carrito" rel="stylesheet">
</head>
<body class="carrito">
    <div class="cart-container">
        <h2>Tu Carrito</h2>
        <div class="cart-items">
            <div class="cart-item">
                <img src="path/to/product-image.jpg" alt="Producto 1">
                <div class="item-info">
                    <h5>Producto 1</h5>
                    <p>Descripción del producto</p>
                </div>
                <div class="item-price">$100.00</div>
                <button class="remove-btn">Eliminar</button>
            </div>
            <!-- Repite el bloque .cart-item por cada producto -->
        </div>
        <div class="cart-total">
            <span>Total:</span>
            <span>$300.00</span>
        </div>
        <button class="checkout-btn">Finalizar Compra</button>
    </div>
</body>
</html>
