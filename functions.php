<?php

function getProductView($id, $showImage=false) {

    // JSON-Datei laden
    $jsonData = file_get_contents("products.json");

    // Überprüfen, ob die Datei geladen wurde
    if ($jsonData === false) {
        die("Fehler beim Laden der Produktdaten.");
    }

    // JSON-Daten in ein PHP-Array umwandeln
    $products = json_decode($jsonData, true);

    // Überprüfen, ob die Dekodierung erfolgreich war
    if ($products === null) {
        die("Fehler beim Dekodieren der JSON-Daten.");
    }

    // Produkte auf der Webseite anzeigen
    foreach ($products as $product) {
        if($id == $product['id']) { ?>
            <div>
                <h2><a href="produkt_detail.php?id=<?php echo $product['id'] ?>"><?php echo htmlspecialchars($product['name']) ?></a></h2>
                <p><?php echo htmlspecialchars($product['description']) ?></p>
                <?php if($showImage === true) {?>
                    <img src="<?php echo htmlspecialchars($product['image']) ?>" width="400px" />
                <?php } ?>
                <p>Preis: <?php echo number_format($product['price'], 2) ?> €</p>
                <?php if (isset($_SESSION['eingeloggt'])) { ?>
                    <form action="produkt_detail.php?id=1" method="POST">
                        <input type="hidden" name="product_id" value="<?php echo $product['id'] ?>">
                        <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($product['name']) ?>">
                        <input type="hidden" name="product_price" value="<?php echo $product['price'] ?>">
                        <button name="add_product" type="submit">In den Warenkorb</button>
                    </form>
                <?php }
                }
            } ?>
            </div>
        <?php
    }
?>
