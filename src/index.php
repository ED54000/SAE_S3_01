<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset=" UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Touiteur</title>
<link rel="stylesheet" href="css/touit.css">
<link rel="icon" href="./favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>
<header>
    <h1 id="title">TOUITEUR</h1>
        <?php
        require_once '../vendor/autoload.php';
        use \iutnc\touiter\connect\checkConnexion;
        session_start();
        $c = new checkConnexion();
        echo $c::isConnected();
        ?>
</header>
<?php
use iutnc\touiter\db\ConnexionFactory;


ConnexionFactory::setConfig('./pages/classes/conf/config.ini');

if(!isset($_GET['action'])){
    $_GET['action'] = 'display-touite';
}

$d = new iutnc\touiter\dispatch\Dispatcher();
$d->run();
?>
</html>

