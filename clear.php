<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = intval($_POST["product_id"]);
    $quantity = intval($_POST["quantity"]);

    $_SESSION['cart'] = [];
    $_SESSION['count'] = 0;
    $_SESSION['sum'] = 0;
}

header("Location: cart.php");
exit;
?>