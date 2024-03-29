<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset=" UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Touiteur</title>
    <link rel="stylesheet" href="css/touit.css">
    <link rel="icon" href="./favicon.ico" type="image/x-icon">
</head>
<header>
    <h1 id="title">TOUITEUR</h1>
    <div class="head">
        <div class="menu navigation">
            <a href="index.php" class='buttonNavigation'>Accueil</a>
        </div>
    </div>
</header>
<?php
require_once '../vendor/autoload.php';

use iutnc\touiter\db\ConnexionFactory;
use iutnc\touiter\dispatch\Dispatcher;

ConnexionFactory::setConfig('./pages/classes/conf/config.ini');

$_GET['action'] = 'signin';

$d = new Dispatcher();
$d->run();
?>
</html>