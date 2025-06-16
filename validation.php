<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "assignment1");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();
?>
<!DOCTYPE html>
<html>
   <title>Validation Form</title>
   <style type="text/css">
      
   </style>
   <link rel="stylesheet" href="style.css">
   </head>
   <body>
    <header class="header">
        <div class="container">
            <div class="header-top">
                <div class="logo"><img src="https://api.iconify.design/lucide/shopping-cart.svg" alt="Cart Icon" width="32" height="32" style="color: white;";>
                    
                <button class="button-heading" onclick="window.location.href='Untitled-1.html'"><h1>The Basketeers</h1></button>                        

                    
                </div>
                <div class="header-button">
                    
                    <button class="btn-primary" onclick="window.location.href='cart.php'">
                        <!-- <a href="cart.html">Cart</a> -->
                         Cart

                    </button>
                </div>
            </div>

            
        </div>
        <script src="script.js"></script>
    </header>
      

<?php
echo '<div class="success-box">';

// Assuming cart is stored in session
$cart = $_SESSION['cart'] ?? [];

if (empty($cart)) {
    echo "Your cart is empty.";
    exit;
}

$orderPlaced = true;

foreach ($cart as $productId => $item) {
    $qty = $item['qty']; // Correctly extract quantity

    // Check stock availability
    $query = $conn->prepare("SELECT in_stock, product_name FROM products WHERE product_id = ?");
    $query->bind_param("i", $productId);
    $query->execute();
    $result = $query->get_result();
    $product = $result->fetch_assoc();

    if ($product && isset($product['in_stock'])) {
        // echo "<br>Product ID: $productId, Quantity: $qty, In Stock: " . $product['in_stock'];

        if ($product['in_stock'] < $qty) {
            echo "<br>Sorry, " . $product['product_name'] . " is out of stock or insufficient quantity.";
            $orderPlaced = false;
            break;
        }
    } else {
        echo "<br>Product ID: $productId - Error: Could not fetch stock.";
        $orderPlaced = false;
        break;
    }
}

// If stock is available, process the order
if ($orderPlaced) {
    foreach ($cart as $productId => $item) {
        $quantity = $item['qty']; // Correctly extract quantity
        // Deduct stock
        $updateQuery = $conn->prepare("UPDATE products SET in_stock = in_stock - ? WHERE product_id = ?");
        $updateQuery->bind_param("ii", $quantity, $productId);
        $updateQuery->execute();
    }

    // Clear the cart
    $_SESSION['cart'] = [];
    $_SESSION['count'] = 0;
    $_SESSION['sum'] = 0;
    
    
    echo '<h2>Order Confirmation</h2>';
    echo '<p>Thank you for your order!</p>';

    echo 'Your order has been placed successfully, and will be delivered shortly!';
    echo '<button class="btn-primary" onclick="window.location.href=\'Untitled-1.html\'">Continue Shopping</button>';

    echo '</div>';
}

$conn->close();
?>

    
    </body>
</html>