<?php
// Include the database connection file
include 'db_connect.php';

// --- NEW PRODUCT PAGE LOGIC ---
$product = null;

// Check if an 'id' was passed in the URL (e.g., product.php?id=3)
if (isset($_GET['id'])) {
    
    $product_id = $_GET['id'];
    
    // SECURELY fetch this one product from the database
    try {
        $sql = "SELECT * FROM products WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$product_id]);
        
        $product = $stmt->fetch(); // Get the product data

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
// --- END OF NEW LOGIC ---

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-R">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cake Bakery - <?php echo htmlspecialchars($product['name'] ?? 'Product'); ?></title> <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&family=Montserrat:wght@400;500&display=swap" rel="stylesheet">
</head>
<body>

    <header class="main-header">
        <div class="container">
            <a href="index.php" class="logo">Cake Bakery</a> 
            <nav class="main-nav">
                <ul>
                    <li><a href="index.php">Main</a></li>
                    <li><a href="index.php#catalog">Catalog</a></li>
                    <li><a href="index.php#about-us">About us</a></li>
                    <li><a href="index.php#special-offer">Special offer</a></li>
                    <li><a href="index.php#reviews">Reviews</a></li>
                    <li><a href="index.php#contacts">Contacts</a></li>
                </ul>
            </nav>
            <div class="header-contact">
                <span>+1 567 832 93 78</span>
            </div>
        </div>
    </header>

    <div class="product-details-page">
        <div class="container">
            
            <?php if ($product): ?>
                <div class="product-layout">
                    <div class="product-image-container">
                        <img src="<?php echo htmlspecialchars($product['image_url']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                    </div>
                    
                    <div class="product-info-container">
                        <h1><?php echo htmlspecialchars($product['name']); ?></h1>
                        
                        <p class="product-description">
                            <?php echo htmlspecialchars($product['description']); ?>
                        </p>
                        
                        <a href="index.php#application" class="btn-primary">Order This Cake</a>
                    </div>
                </div>

            <?php else: ?>
                <h2>Product Not Found</h2>
                <p>Sorry, we couldn't find the product you were looking for.</p>
                <a href="index.php#catalog" class="btn-primary">Back to Catalog</a> 
            <?php endif; ?>

        </div>
    </div>
    <footer class="main-footer">
        <div class="container">
            <a href="index.php" class="logo">Cake Bakery</a>
            <nav class="main-nav">
                <ul>
                    <li><a href="index.php">Main</a></li>
                    <li><a href="index.php#catalog">Catalog</a></li>
                    <li><a href="index.php#about-us">About us</a></li>
                    <li><a href="index.php#special-offer">Special offer</a></li>
                </ul>
            </nav>
            <div class="social-links">
            </div>
        </div>
    </footer>

</body>
</html>