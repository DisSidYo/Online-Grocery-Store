<?php session_start(); ?>

<!DOCTYPE html>

<head>
   
    <title>The Basketeers Grocery Store</title>
    <style>
        .btn-primary {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    margin-top: 10px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-size: 16px;
}

.btn-secondary {
    background-color: #f44336;
    color: white;
    padding: 10px 20px;
    margin-top: 10px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-size: 16px;
}

.btn-primary:disabled,
.btn-secondary:disabled {
    background-color: #ccc;
    cursor: not-allowed;
}

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
    </header>

    <main class="main">
        <!-- <div class="container">
            <div class="featured-grid">
                <div class="featured-card">
                    <img src="https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&q=80" alt="Fresh Produce">
                    <div class="card-content">
                        <h3>Fresh Produce</h3>
                        <p>Farm-fresh fruits and vegetables delivered daily</p>
                        <button class="btn-primary">Shop Now</button>
                    </div>
                </div>

                <div class="featured-card">
                    <img src="https://images.unsplash.com/photo-1534723452862-4c874018d66d?auto=format&fit=crop&q=80" alt="Fresh Bread">
                    <div class="card-content">
                        <h3>Freshly Baked</h3>
                        <p>Artisanal breads and pastries baked every morning</p>
                        <button class="btn-primary">Shop Now</button>
                    </div>
                </div>
            </div>

        </div> -->
       

<div class="container">
<h2>Your Cart</h2>

<?php 
$conn = mysqli_connect("localhost", "root", "", "assignment1");

if (!$conn)
    die("Could not connect to MySQL");

$query_string = "SELECT * FROM products";
$result = mysqli_query($conn, $query_string);

if (!empty($_SESSION['cart'])): ?>
  <ul class="cart-list">
    <?php foreach ($_SESSION['cart'] as $product_id => $item): ?>
        <li class="cart-item">
            <img src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['product_name']) ?>" class="cart-image">
            <div class="cart-details">
                <div class="product-name"><?= htmlspecialchars($item['product_name']) ?></div>
                <div class="product-price"><?= $item['qty'] ?> x $<?= $item['unit_price'] ?> = <strong>$<?= $item['unit_price'] * $item['qty'] ?></strong></div>

                <form method="POST" action="update.php" class="cart-form">
                    <input type="hidden" name="product_id" value="<?= htmlspecialchars($product_id) ?>">
                    <label for="qty-<?= $product_id ?>">Qty:</label>
                    <input type="number" name="quantity" id="qty-<?= $product_id ?>" value="<?= $item['qty'] ?>" min="1" required>
                    <button type="submit" class="btn btn-update">Update</button>
                </form>

                <form method="POST" action="remove.php" class="cart-form">
                    <input type="hidden" name="product_id" value="<?= htmlspecialchars($product_id) ?>">
                    <button type="submit" class="btn btn-remove">Remove</button>
                </form>
            </div>
        </li>
    <?php endforeach; ?>
</ul>

    <p><strong>Total Items:</strong> <?= $_SESSION['count'] ?></p>
    <p><strong>Total Price:</strong> $<?= $_SESSION['sum'] ?></p>
<?php else: ?>
    <p>Your cart is empty.</p>
<?php endif; ?>
<?php if (!empty($_SESSION['cart'])): ?>
    <!-- If the cart has items -->
    <button class="btn-primary" onclick="window.location.href='Untitled-1.html'">Continue Shopping</button>

    <form method="POST" action="clear.php" style="display:inline;">
        <button type="submit" class="btn-primary">Clear Cart</button>
    </form>

    <button id="checkout" class="btn-primary" style="margin-left: 10px;" onclick="window.location.href='order.html'">
        Checkout
    </button>
<?php else: ?>
    <!-- If the cart is empty -->
    

    <button class="btn-primary" onclick="window.location.href='Untitled-1.html'">Continue Shopping</button>
    
    <button class="btn-secondary" disabled>Clear Cart</button>
    <button class="btn-primary" disabled>Checkout</button>
<?php endif; ?>

    
    </div>
    </main>

    

<script src="script.js"></script>
</body>
</html>