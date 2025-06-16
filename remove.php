<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["product_id"])) {
    $product_id = intval($_POST["product_id"]);
    

    if (isset($_SESSION["cart"][$product_id])) {
        // Remove the item from the cart
        unset($_SESSION["cart"][$product_id]);
    }

    // Recalculate totals
    $_SESSION["sum"] = 0;
    $_SESSION["count"] = 0;
    foreach ($_SESSION["cart"] as $item) {
        $_SESSION["sum"] += $item["unit_price"] * $item["qty"];
        $_SESSION["count"] += $item["qty"];
    }
}

header("Location: cart.php");
exit;
?>