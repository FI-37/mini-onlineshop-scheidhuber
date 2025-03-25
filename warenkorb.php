<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        session_start();

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id'])) {
            $product_id = $_POST['product_id'];

            if(isset($_POST['increase_quantity'])) {
                foreach ($_SESSION['cart'] as $key => $item) {
                    if ($item['id'] == $product_id) {
                        $_SESSION['cart'][$key]['quantity']++;
                        break;
                    }
                }
            }

            if(isset($_POST['decrease_quantity'])) {
                foreach ($_SESSION['cart'] as $key => $item) {
                    if ($item['id'] == $product_id) {
                        $_SESSION['cart'][$key]['quantity']--;
                        break;
                    }
                }
            }
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['clear_cart'])) {
            unset($_SESSION['cart']);
            echo "Der Warenkorb wurde geleert.<br>";
        }
    ?>

    <?php require_once("login.php"); ?>

    <h1>Onlineshop - Warenkorb</h1>
    <?php require_once("templates/navigation.php"); ?>

    <?php
        // Überprüfen, ob der Warenkorb existiert und Produkte enthält
        if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
            echo "<h1>Warenkorb von {$_SESSION['username']}</h1>";
            echo "<ul>";

            foreach ($_SESSION['cart'] as $item) {
                echo "<li>";
                echo "Produkt: " . htmlspecialchars($item['name']);
                echo " - Preis: " . htmlspecialchars($item['price']) . " €";
                echo " - Anzahl: " . $item['quantity'];

                ?>

                <form action="warenkorb.php" method="POST">
                    <input type="hidden" name="product_id" value="<?php echo $item["id"] ?>">
                    <button type="submit" name="increase_quantity">+</button>
                    <button type="submit" name="decrease_quantity">-</button>
                </form>

                <?php

                echo "</li>";
            }
            echo "</ul>";

            $total_cost = 0;
            if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
                foreach ($_SESSION['cart'] as $item) {
                    $total_cost += $item['price'] * $item['quantity'];
                }

                echo "<p>Gesamtkosten: " . number_format($total_cost, 2) . " €</p>";
            }

            ?>

            <form action="warenkorb.php" method="POST">
                <button type="submit" name="clear_cart">Warenkorb leeren</button>
            </form>

            <?php
        } else {
            echo "<p>Ihr Warenkorb ist leer.</p>";
        }
    ?>

    <?php require_once("templates/footer.php"); ?>

</body>
</html>
