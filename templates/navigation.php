<nav>
    <ul>
        <li><a href="index.php">Startseite</a></li>
        <li><a href="produkte.php">Produkte</a></li>
        <?php if (isset($_SESSION['eingeloggt'])) { ?>

            <li><a href="warenkorb.php">Warenkorb</a></li>

        <?php } ?>
        <li><a href="ueber-uns.php">Über uns</a></li>
        <li><a href="kontakt.php">Kontakt</a></li>
    </ul>
</nav>
