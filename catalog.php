<?php
// Include the database connection file
include 'db_connect.php';

// --- CATALOG PAGE LOGIC ---
// 1. Get the category from the URL.
// If no category is set, default to 'cake'.
$category = $_GET['category'] ?? 'cake';

// 2. A helper array to make sure the category is valid
$valid_categories = ['cake', 'cupcake', 'cookie'];
if (!in_array($category, $valid_categories)) {
    $category = 'cake'; // Default to 'cake' if URL is tampered with
}
// --- END OF LOGIC ---

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cake Bakery - Our Catalog</title>
    <link rel="stylesheet" href="style.css">
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
                    <li><a href="index.php#catalog" class="active">Catalog</a></li> <li><a href="index.php#about-us">About us</a></li>
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


    <section id="catalog" class="catalog">
        <div class="container">
            <h2>Our catalog</h2>
            <div class="catalog-nav">
                <ul>
                    <li><a href="catalog.php?category=cake" class="<?php if ($category == 'cake') echo 'active'; ?>">Cakes</a></li>
                    <li><a href="catalog.php?category=cupcake" class="<?php if ($category == 'cupcake') echo 'active'; ?>">Cupcakes</a></li>
                    <li><a href="catalog.php?category=cookie" class="<?php if ($category == 'cookie') echo 'active'; ?>">Cookies</a></li>
                </ul>
            </div>

            <div class="catalog-grid">
                <?php
                // The SQL query now uses the $category variable
                // We use a prepared statement for security
                try {
                    $sql = "SELECT id, name, image_url FROM products WHERE category = ?";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$category]);

                    while ($row = $stmt->fetch()) {
                        // Each image links to its own product detail page
                        echo '<div class="product-card">';
                        echo '  <a href="product.php?id=' . htmlspecialchars($row['id']) . '">';
                        echo '    <img src="' . htmlspecialchars($row['image_url']) . '" alt="' . htmlspecialchars($row['name']) . '">';
                        echo '  </a>';
                        echo '</div>';
                    }
                } catch (PDOException $e) {
                    // THIS IS THE CORRECTED LINE:
                    echo "Error: " . $e->getMessage();
                }
                ?>
            </div>
        </div>
    </section>
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