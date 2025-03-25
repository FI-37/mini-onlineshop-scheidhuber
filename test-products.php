<?php
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
echo "<h1>Produkte</h1>";
echo "<ul>";
foreach ($products as $product) {
    echo "<li>";
    echo "<h2>" . htmlspecialchars($product['name']) . "</h2>";
    echo "<p>Preis: €" . number_format($product['price'], 2) . "</p>";
    echo "<p>" . htmlspecialchars($product['description']) . "</p>";
    echo "</li>";
}
echo "</ul>";
?>