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

        // Produkt in den Warenkorb legen
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_product'])) {
            $product_id = $_POST['product_id'];
            $product_name = $_POST['product_name'];
            $product_price = $_POST['product_price'];

            // Warenkorb initialisieren, falls er noch nicht existiert
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }

            // Produktanzahl erhöhen, wenn es bereits im Warenkorb ist
            $found = false;
            foreach ($_SESSION['cart'] as $key => $item) {
                if ($item['id'] == $product_id) {
                    $_SESSION['cart'][$key]['quantity']++;
                    $found = true;
                    break;
                }
            }

            // Produkt zum Warenkorb hinzufügen
            if (!$found) {
                $_SESSION['cart'][] = [
                    'id' => $product_id,
                    'name' => $product_name,
                    'price' => $product_price,
                    'quantity' => 1
                ];
                echo "Produkt wurde erfolgreich zum Warenkorb hinzugefügt.";
            }
        }
    ?>

    <?php require_once("login.php"); ?>

    <h1>Onlineshop - Produkte</h1>
    <?php require_once("templates/navigation.php"); ?>

    <?php
        require_once('functions.php');

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
            getProductView($product['id']);
        }
        ?>

    <?php require_once("templates/footer.php"); ?>

</body>
</html>
