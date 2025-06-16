<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "assignment1");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = intval($_POST['product_id']);
    $quantity = intval($_POST['quantity']);

    if ($productId > 0 && $quantity > 0) {
        $query = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
        $query->bind_param("i", $productId);
        $query->execute();
        $result = $query->get_result();

        if ($result->num_rows > 0) {
            $product = $result->fetch_assoc();

            // Add to session cart
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }

            if (!isset($_SESSION['cart'][$productId])) {
                $_SESSION['cart'][$productId] = [
                    'product_name' => $product['product_name'],
                    'unit_price' => $product['unit_price'],
                    'image' => 'data:image/png;base64,' . base64_encode($product['images']),
                    'qty' => $quantity
                ];
            } else {
                $_SESSION['cart'][$productId]['qty'] += $quantity;
            }

            // Update total count and sum
            $_SESSION['count'] = ($_SESSION['count'] ?? 0) + $quantity;
            $_SESSION['sum'] = ($_SESSION['sum'] ?? 0) + ($product['unit_price'] * $quantity);

            // Optional: redirect back to the product page
            header("Location: " . $_SERVER['HTTP_REFERER']); // Redirect back
            exit;
        } else {
            echo "Product not found.";
        }
    } else {
        echo "Invalid input.";
    }
}
?>
