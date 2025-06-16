<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["product_id"], $_POST["quantity"])) {
    $product_id = intval($_POST["product_id"]);
    $quantity = intval($_POST["quantity"]);

    if (isset($_SESSION["cart"][$product_id])) {
        $_SESSION["cart"][$product_id]["qty"] = $quantity;
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