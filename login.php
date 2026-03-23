<?php
$login = $_POST['identifier'];
$password = $_POST['password'];

$login_test = "MamaMia";
$pass = "MotDePasse1234";

if (!isset($login_test, $pass)) {
    echo "Les champs sont vide ou invalide <br>";
}
// partie B & verif simulation connexion
