<?php
// nastavi ili napravi sesiju
include 'proverakorpe.php';
include 'sessionizer.php';
?>


<header>
    <img src="image/logo.jpeg" alt="slika" class="logo">
    <link rel="stylesheet" href="style/shop.css">
    <hi class="header-title"><a href="index.php">TechDen</a></hi>
    <nav>
        <ul class="left-menu">
            <?php if (!isset($_SESSION['user_ID'])): ?>
                <li><a href="login.php">Login</a></li>
                <li><a href="register.php">Register</a></li>
                <!-- ako nema user_id-a u sesiji prikazi login i register -->
                <?php endif; ?>
                
                <?php if (isset($_SESSION['user_ID'])): ?>
                    <li>
                        <a href="<?php if ($_SESSION['is_admin'])
                        echo 'administrator.php'; ?>">
                        <?= $_SESSION["username"]; ?>
                        <!-- ako postoji user prikazace username a ako je trenutna sesija is_admin = 1 preusmerava na admin.php -->
                    </a>
                </li>
                <li>
                    <a href="logout.php">Logout</a>
                </li>
                
                <?php endif; ?>
            </ul>
            <ul class="right-menu">
                <li><a href="index.php">Home</a></li>
                <?php if ($_SESSION["korpa"] > 0): ?>
                    <li>
                        <div class="cart-badge">
                            <a href="korpa.php" class="cart-icon">🛒</a>
                            <span class="item-count">
                                <?= $_SESSION["korpa"]; ?>
                            </span>
                        </div>
                        <!-- ako korpa nije prazna prikazi korpu i broj stavki u korpi -->
                    </li>
                    <?php endif; ?>
                    <li><a href="shop.php">Shop</a></li>
                    
                    <?php if (isset($_SESSION['user_ID'])): ?>
                        <?php if ($_SESSION['is_admin']): ?>
                            <li><a href="izvestaj.php">Izvestaj</a></li>
                            <?php endif; ?>
                            <?php endif; ?>
                            
                        </ul>
                        
                    </nav>
                    
                </header>
                
   