<?php
// Include the database connection file
include 'db_connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cake Bakery</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&family=Montserrat:wght@400;500&display=swap" rel="stylesheet">
</head>
<body>

    <header class="main-header">
        <div class="container">
            <a href="#" class="logo">Cake Bakery</a>
            <nav class="main-nav">
                <ul>
                    <li><a href="#">Main</a></li>
                    <li><a href="#catalog">Catalog</a></li>
                    <li><a href="#about-us">About us</a></li>
                    <li><a href="#special-offer">Special offer</a></li>
                    <li><a href="#reviews">Reviews</a></li>
                    <li><a href="#contacts">Contacts</a></li>
                </ul>
            </nav>
            <div class="header-contact">
                <span>+1 567 832 93 78</span>
            </div>
        </div>
    </header>

    <section class="hero" style="
    /* 1. The section is now a container */
    position: relative;
    height: 700px;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    color: #fff;
    overflow: hidden; /* This clips the edges of the blurred image */
">

    <div class="hero-background" style="
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image: url('images/hero-bg.jpeg');
        background-size: cover;
        background-position: center;

        /* --- HERE IS THE BLUR --- */
        filter: blur(5px);
        z-index: 1; /* Sits at the bottom of the stack */

        /* This scales the image slightly to hide the soft edges from the blur */
        transform: scale(1.05);
    ">
    </div>

    <div class="container" style="
        position: relative;
        z-index: 2; /* Sits on top of the z-index: 1 background */
    ">
        <h1 style="font-family: 'Dancing Script', cursive; font-size: 8rem; color: white; text-shadow: 2px 2px 4px rgba(0,0,0,0.75);">
            Delicious cakes <br> to order
        </h1>

        <a href="#catalog" class="btn-primary" style="

            margin-top: 1.5rem;
            font-size: 1.1rem;
            display: inline-block;
            background-color: #B51313;
            border: 3px solid #ddd;
            color: #fff;
            padding: 12px 30px;
            text-decoration: none;
            font-weight: 500;
            border-radius: 8px;
            font-family: 'Montserrat', sans-serif;

        ">Choose a Cake</a>
    </div>

</section>



    <section id="catalog" class="catalog">
        <div class="container">
            <h2>Our catalog</h2>
            <div class="catalog-nav">
                <ul>
                    <li><a href="catalog.php?category=cake">Cakes</a></li>
                    <li><a href="catalog.php?category=cupcake">Cupcakes</a></li>
                    <li><a href="catalog.php?category=cookie">Cookies</a></li>
                </ul>
            </div>

            <div class="catalog-grid">
                <?php
                // Fetch products from the database
                try {
                    // This query now fetches the ID as well
                    $stmt = $pdo->query("SELECT id, name, image_url FROM products WHERE category = 'cake'");
                    while ($row = $stmt->fetch()) {
                        
                        // EACH IMAGE IS NOW A LINK to product.php, passing its own ID
                        echo '<div class="product-card">';
                        echo '  <a href="product.php?id=' . htmlspecialchars($row['id']) . '">';
                        echo '    <img src="' . htmlspecialchars($row['image_url']) . '" alt="' . htmlspecialchars($row['name']) . '">';
                        echo '  </a>';
                        echo '</div>';
                        
                    }
                } catch (PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }
                ?>
            </div>
            </div>
    </section>

    <section id="about-us" class="about-us">
        <div class="container">
            <h2>About Us</h2>
            <p>We specialize in selling cakes, cupcakes and cookies to order, but we also have two wonderful cafes in the city. You can come to us for a cup of coffee and a cake, or you can have a wonderful time with your friends. Here you can buy cakes to order (min.1kg). Cakes according to their design for any holiday.</p>
            <span class="signature">Cake Bakery</span>
        </div>
    </section>

    <section id="special-offer" class="special-offer">
        <div class="container-split">
            <div class="offer-text">
                <h3>Special offer</h3>
                <p>When you buy three cakes of 1 kilogram each, you get one more cake of 0.5 kilogram size as a gift.</p>
                <a href="#" class="btn-secondary">To Order</a>
            </div>
            <div class="offer-image" style="background-image: url('images/special-offer-cake.jpeg');">
                </div>
        </div>
    </section>

    <section id="reviews" style="padding: 6rem 0; text-align: center; background-color: #fdfaf7; position: relative;">
    
    <div class="container" style="max-width: 800px; margin: 0 auto;">
        
        <div class="quote-icon" style="font-family: 'Dancing Script', cursive; font-size: 8rem; color: #ccc; line-height: 1; margin-bottom: -3rem; display: block;">
            "
        </div> 
        
        <p class="review-text" style="font-size: 1.2rem; color: #333333; margin-bottom: 2rem; line-height: 1.8;">
            Wonderful bakery, it's always nice to sit in their cafe with a Cup of tea and a piece of my favorite cake.
            I love Snickers filling. When it is not possible to come to the cafe, I always use delivery. Cake bakeries
            always work quickly. Thanks.
        </p>
        
        <span class="reviewer-name" style="font-family: 'Dancing Script', cursive; font-size: 2.2rem; color: #B51313; display: block; margin-top: 1.5rem;">
            Julia Lan
        </span> 
        
        <div class="review-nav-arrows" style="position: absolute; top: 50%; left: 0; right: 0; transform: translateY(-50%); display: flex; justify-content: space-between; padding: 0 2rem; pointer-events: none;">
            
            <button class="arrow prev-arrow" style="background: none; border: none; font-size: 3rem; color: #ccc; cursor: pointer; padding: 10px; pointer-events: auto;">
                &#8592;
            </button> 
            
            <button class="arrow next-arrow" style="background: none; border: none; font-size: 3rem; color: #ccc; cursor: pointer; padding: 10px; pointer-events: auto;">
                &#8594;
            </button> 
        </div>
        
    </div>
</section>

<section id="contacts" class="contacts-section">
    
    <div class="container-split" style="min-height: 450px; background-color: #fff; display: grid; grid-template-columns: 1fr 1fr;">
        
        <div class="contact-image" style="background-image: url('images/contact-image.jpeg'); background-size: cover; background-position: center;">
        </div>
        
        <div class="contact-info-box" style="background-color: #B51313; color: #fff; padding: 3rem 4rem; display: flex; flex-direction: column; justify-content: center;">
            
            <h2 style="color: #fff; text-align: left; font-family: 'Dancing Script', cursive; font-size: 2.8rem; margin-bottom: 2rem;">Our contacts</h2>
            
            <div class="contact-detail" style="display: grid; grid-template-columns: 80px 1fr; margin-bottom: 1.2rem; font-size: 1rem; line-height: 1.5; font-family: 'Montserrat', sans-serif;">
                <span class="label" style="font-weight: 500; color: rgba(255, 255, 255, 0.8);">Phone:</span>
                <span class="value" style="font-weight: 400;">+1 567 632 65 78</span>
            </div>
            
            <div class="contact-detail" style="display: grid; grid-template-columns: 80px 1fr; margin-bottom: 1.2rem; font-size: 1rem; line-height: 1.5; font-family: 'Montserrat', sans-serif;">
                <span class="label" style="font-weight: 500; color: rgba(255, 255, 255, 0.8);">E-mail:</span>
                <span class="value" style="font-weight: 400;">cakebakery@mail.com</span>
            </div>
            
            <div class="contact-detail" style="display: grid; grid-template-columns: 80px 1fr; margin-bottom: 1.2rem; font-size: 1rem; line-height: 1.5; font-family: 'Montserrat', sans-serif;">
                <span class="label" style="font-weight: 500; color: rgba(255, 255, 255, 0.8);">Address:</span>
                <span class="value" style="font-weight: 400;">
                    8326 Marconi Ave. <br>
                    Corona, NY 11368
                </span>
            </div>
            
            <div class="contact-detail" style="display: grid; grid-template-columns: 80px 1fr; margin-bottom: 1.2rem; font-size: 1rem; line-height: 1.5; font-family: 'Montserrat', sans-serif;">
                <span class="value no-label" style="font-weight: 400; grid-column-start: 2;">
                    728 Howard Street <br>
                    Staten Island, NY 10314
                </span>
            </div>
        </div>
        
    </div>
</section>
    
    <section id="application" class="application">
        <div class="container">
            <h2>Application</h2>

            <?php
            // Show success/error messages from the form handler
            if (isset($_GET['status'])) {
                if ($_GET['status'] == 'success') {
                    echo '<p class="form-success">Thank you! Your application has been sent.</p>';
                } else if ($_GET['status'] == 'error') {
                    echo '<p class="form-error">Something went wrong. Please try again.</p>';
                } else if ($_GET['status'] == 'invalid') {
                    echo '<p class="form-error">Please fill out all fields correctly.</p>';
                }
            }
            ?>

            <form action="form_handler.php" method="POST" class="contact-form">
                <div class="form-row">
                    <input type="text" name="first_name" placeholder="Your name" required>
                    <input type="text" name="surname" placeholder="Your surname">
                </div>
                <div class="form-row">
                    <input type="tel" name="phone" placeholder="Phone" required>
                    <input type="email" name="email" placeholder="E-mail" required>
                </div>
                <button type="submit" class="btn-primary">Send</button>
            </form>
        </div>
    </section>

    <footer class="main-footer">
        <div class="container">
            <a href="#" class="logo">Cake Bakery</a>
            <nav class="main-nav">
                <ul>
                    <li><a href="#">Main</a></li>
                    <li><a href="#catalog">Catalog</a></li>
                    <li><a href="#about-us">About us</a></li>
                    <li><a href="#special-offer">Special offer</a></li>
                </ul>
            </nav>
            <div class="social-links">
                </div>
        </div>
    </footer>

</body>
</html>