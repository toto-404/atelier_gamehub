<?php
// Start the session
session_start();

$login = $_POST['identifier'];
$password = $_POST['password'];

$login_test = "MamaMia";
$pass = "MotDePasse1234";

if ($login == $login_test) {
    echo "Ouiii";
} else {
    echo "Nooooon";
}

$_SESSION["identifier"] = $login;
$_SESSION["password"] = $password;



if (!isset($login_test, $pass)) {
    echo "Les champs sont vide ou invalide <br>";
}

if ($_SESSION["identifier"] == $login_test && ($_SESSION["password"]) == $password ) {
    echo "<h1>Hello$_SESSION[identifier]</h1>";
    header("Location: index.php");
    // header("Location: https://www.github.com");
}
else{
        echo "<h1>T'es qui $login</h1>";
        header("Location: https://www.google.com/search?q=porsche+911");

}
?>