<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "assignment1");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Product Cards</title>
    <style>
        /* body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            padding: 30px;
        } */

        /* h1 {
            text-align: center;
            color: #333;
        } */

        .container1 {
            display: flex;
            flex-wrap: wrap;
            gap: 50px;
            justify-content: center;
        }

        .card {
            background-color: #fff;
            width: 250px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            padding: 20px;
            box-sizing: border-box;
            text-align: center;
            transition: 0.3s ease-in-out;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card img {
            width: 100%;
            height: auto;
            border-radius: 8px;
            object-fit: cover;
            margin-bottom: 15px;
        }

        .card p {
            margin: 5px 0;
            color: #555;
            font-size: 14px;
        }

        .card .title {
            font-weight: bold;
            font-size: 16px;
            margin-bottom: 10px;
            color: #222;
        }

        .btn-add{
            background-color: #4CAF50; /* Green */
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .btn-add:hover {
            background-color: #45a049;
        }
        .btn-add:disabled {
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
                    
                        <button class="button-heading"><h1>The Basketeers</h1></button>
                        

                    
                </div>
                <div class="header-button">
                    
                    <button class="btn-primary">
                        <!-- <a href="cart.html">Cart</a> -->
                         Cart

                    </button>
                </div>
            </div>

            <div class="header-bottom">
                <nav class="categories">
                    <div class="category-item">
                        <button class="category-btn">
                            <img src="https://api.iconify.design/lucide/snowflake.svg" alt="Frozen Icon" width="24" height="24">
                            <a href="filterprods.php?category=1000">Frozen</a> 
                        </button>
                        <div class="dropdown-menu">
                            <a href="filterprods.php?category=1000&subcategory=2">Ice Cream</a>
                            <a href="filterprods.php?category=1000&subcategory=1">Frozen food</a>
                            
                        </div>
                    </div>
                    <div class="category-item">
                        <button class="category-btn">
                        <img src="https://api.iconify.design/lucide/home.svg" alt="Home Icon" width="24" height="24">                           
                        <a href="filterprods.php?category=2000">Home</a>                            
                            
                        </button>
                        <div class="dropdown-menu">
                        <a href="filterprods.php?category=2000&subcategory=3">Medicine</a>                            
                        <a href="filterprods.php?category=2000&subcategory=4">Everyday Use</a>      
                        <a href="filterprods.php?category=2000&subcategory=5">Cleaning</a>                           
                     
                        </div>
                    </div>
                    <div class="category-item">
                        <button class="category-btn">
                            <img src="https://api.iconify.design/lucide/apple.svg" alt="Fresh Icon" width="24" height="24">                            <a href="filterprods.php?category=3000">Fresh</a> 
                        </button>
                        <div class="dropdown-menu">
                        <a href="filterprods.php?category=3000&subcategory=6">Food</a>                            
                        <a href="filterprods.php?category=3000&subcategory=7">Fruits</a>                            
                                                    
                        </div>
                    </div>
                    <div class="category-item">
                        <button class="category-btn">
                            <img src="https://api.iconify.design/lucide/coffee.svg" alt="Beverages Icon" width="24" height="24">
                            <a href="filterprods.php?category=4000">Snacks</a> 
                        </button>
                        <div class="dropdown-menu">
                        <a href="filterprods.php?category=4000&subcategory=8">Tea</a>                            
                        <a href="filterprods.php?category=4000&subcategory=9">Coffee</a>                            
                        <a href="filterprods.php?category=4000&subcategory=10">Chocolate</a>                            
                        </div>
                    </div>
                    <div class="category-item">
                        <button class="category-btn">
                            <img src="https://api.iconify.design/lucide/dog.svg" alt="Pet Food Icon" width="24" height="24">
                            <a href="filterprods.php?category=5000">Pets</a> 
                        </button>
                        <div class="dropdown-menu">
                        <a href="filterprods.php?category=5000&subcategory=11">Dog Food</a>                            
                        <a href="filterprods.php?category=5000&subcategory=12">Bird Food</a>                            
                        <a href="filterprods.php?category=5000&subcategory=13">Cat Food</a>                            
                        <a href="filterprods.php?category=5000&subcategory=14">Fish Food</a>                            
                        </div>
                    </div>
                </nav>

                <div class="search-container">
                    <form action="viewproducts.php" method="post">
                        <button type="submit" class="search-icon">
                            <img src="https://api.iconify.design/lucide/search.svg" alt="Search Icon" width="20" height="20">
                        </button>
                        <input type="hidden" name="search" value="search">
                        <input type="text" id="searchInput" placeholder="Search for products..." class="search-bar" name="search">
                    </form>
                </div>
                
            </div>
        </div>
    </header>

    <h1 style="text-align: center; padding: 20px 0;">Matching Products:</h1><div class="container1">
    <script src="script.js"></script>


<?php
if (isset($_POST['search'])) {
    $input = mysqli_real_escape_string($conn, $_POST['search']);

    $query_string = "SELECT * FROM products WHERE product_name LIKE '%$input%';";
    $result = mysqli_query($conn, $query_string);

    echo "<div class='container1'>";
    if (mysqli_num_rows($result) > 0) {
        while ($a_row = mysqli_fetch_assoc($result)) {
            echo "<div class='card'>";
    
            foreach ($a_row as $field_n => $field_v) {
                if ($field_n == 'images') {
                    $base64 = base64_encode($field_v);
                    $img_src = 'data:image/jpeg;base64,' . $base64;
                    echo "<img src='$img_src' alt='Product Image'>";
                } elseif ($field_n == 'product_name') {
                    echo "<div class='title'>" . htmlspecialchars($field_v) . "</div>";
                } 
                elseif ($field_n == 'product_name') {
                    echo "<div class='title'>" . htmlspecialchars($field_v) . "</div>";
                } elseif ($field_n == 'unit_price') {
                    echo "<p><strong>Price:</strong> $" . htmlspecialchars($field_v) . "</p>";
                } elseif ($field_n == 'product_id') {
                    // Skip product_id field
                } elseif ($field_n == 'unit_quantity') {
                    echo "<p><strong>Quantity:</strong> " . htmlspecialchars($field_v) . "</p>";
                    
    
                }
                elseif ($field_n == 'in_stock') {
                    echo "<p><strong>Current Stock:</strong> " . htmlspecialchars($field_v) . "</p>";
                    if ($field_v == 0) {
                        echo "<p style='color: red;'>Out of Stock</p>";
                    } else {
                        echo "<p style='color: green;'>In Stock</p>";
                    }
    
                }
                 elseif ($field_n == 'category_id') {
                    // Skip category_id field
                } 
                
            }
    
            echo "<form method='POST' action='buy.php' style='margin-top: 10px;'>
            <input type='hidden' name='product_id' value='" . htmlspecialchars($a_row['product_id']) . "'>
            <label for='qty-" . $a_row['product_id'] . "'>Quantity:</label>
            <input type='number' name='quantity' id='qty-" . $a_row['product_id'] . "' value='1' min='1' required>";
        
        if ($a_row['in_stock'] > 0) {
            echo "<button type='submit' class='btn-add'>Add item</button>";
        } else {
            echo "<button type='submit' class='btn-add' disabled>Out of Stock</button>";
        }
        
        echo "</form>";
    
    
            echo "</div>";
    } 
}else {
        echo "<p>No matching products found.</p>";
    }
    echo "</div>";
} else {
    echo "<p>Please enter a search term.</p>";
}

mysqli_close($conn);
?>

</body>
</html>
