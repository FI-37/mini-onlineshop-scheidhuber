<?php

    // Server-Session wieder aufnehmen oder neu starten
    session_start();

    echo "<pre>";
    // echo var_dump($_POST);
    echo "</pre>";

    // Login Funktionalität
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Simulierte Authentifizierung
        if ($username == 'John' && $password == 'beep') {
            setcookie('eingeloggt', true, time() + 3600); // Cookie für 1 Stunde setzen
            $_SESSION['eingeloggt'] = true;
            $_SESSION['username'] = $username;
            echo "Erfolgreich angemeldet.";
        } else {
            echo "Falsche Anmeldedaten.";
        }
    }

    // Logout Funktionalität
    if (isset($_POST['logout'])) {
        session_unset();
        session_destroy();
        setcookie('eingeloggt', "", time() - 3600);
        setcookie('PHPSESSID', "", time() - 3600);
        echo "Logged out....";
    }

    // Anzeige eingeloggt oder Login-Formular
    if (isset($_SESSION['eingeloggt'])) {
        echo "Sie sind angemeldet als " . $_SESSION['username']; ?>

        <br>
        <form action="index.php" method="POST">
            <button type="submit" name="logout">Abmelden</button>
        </form>
    <?php
    } else { ?>

        <h2>Bitte Einloggen</h2>

        <form action="index.php" method="POST">
            <label for="username">Benutzername:</label>
            <input type="text" id="username" name="username">
            <br />
            <label for="password">Passwort:</label>
            <input type="password" id="password" name="password">
            <br />
            <input type="submit" name="login" value="Anmelden">
        </form>

    <?php
    }
?>

<?php require_once("cart-widget.php") ?>
