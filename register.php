<?php
$login = $_POST['login'];
$pattern_login = "/^[A-Za-z0-9]{5,}$/";

$email = $_POST['email'];
$pattern_email = "/^[a-zA-Z0-9.]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";

$password = $_POST['password'];
$pattern_pass = "/^.{8,}$/";

// $conf_pass = isset($_POST('confirm_password'));
$conf_pass = $_POST['confirm_password'];
$pattern_confirm_pass = $pattern_pass;

//condition

//login
if (preg_match($pattern_login, $login)) {
    echo "Valeur de login valide <br>";
} else {
    echo "Merde ça passe pas ton login! <br>";
}
//email
if (preg_match($pattern_email, $email)) {
    echo "Valeur d'email valide <br>";
} else {
    echo "Merde l'email passe pas !<br>";
}

//pass
if (preg_match($pattern_pass, $password)) {
    echo "mdp valide <br>";
} else {
    echo "Merde ça pue ton mdp! <br>";
}

//confirmation mdp

if ($password == $conf_pass) {
    echo " Mot de passe valide <br>";
} else {
    echo "T'es con ou quoi? vérifie ton mdp <br>";
}

if (preg_match($pattern_login, $login) && preg_match($pattern_email, $email) && preg_match($pattern_pass, $password) && $password == $conf_pass) {
    echo "Login Succès!";
} else {
    echo "Bon ça march pas";
}