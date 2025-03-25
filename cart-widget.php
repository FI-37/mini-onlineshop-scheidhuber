<?php
    // Anzeige der Produkte
    if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
        echo "<h3>Aktueller Warenkorb</h3>";
        echo "<ul>";

        foreach ($_SESSION['cart'] as $item) {
            echo "<li>";
            echo htmlspecialchars($item['name']) . " - Preis: " . htmlspecialchars($item['price']) . " € - " . $item['quantity'];
            echo "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>Ihr Warenkorb ist leer.</p>";
    }
?>