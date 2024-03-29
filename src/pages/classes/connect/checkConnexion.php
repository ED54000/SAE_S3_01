<?php
declare(strict_types=1);

namespace iutnc\touiter\connect;

class checkConnexion
{
    //Permet d'afficher le menu avec le nom de l'utilisateur connecter,
    // le menu acceuil / profile / et statistiques et le boutton se deconnecter
    //Sinon on affiche qu'on est pas connecter, avec seulement acceuil, se connecter et s'inscrire
    public static function isConnected() : string{

        $html = '<div class="head"><div class="affiche">';

        if (isset($_SESSION['user'])){
            $user = unserialize($_SESSION['user']);
            $prenom = $user->nomUser;
            $nom = $user->prenomUser;
            $html .= ("<p>$prenom   $nom</p>");
            $html .= "</div>";
            $html .= "<div class=\"menu connexion\">
            <form action='?action=disconnect'>
            <a href=\"?action=disconnect\" class='buttonNavigation' >Se déconnecter</a>
            </form>
            </div>";
            $html .= "<div class=\"menu navigation\">

                    <a href=\"profil.php\" class='buttonNavigation'>Profil</a>
                    <a href=\"index.php\" class='buttonNavigation'>Accueil</a>
                    <a href=\"profil.php?action=stats\" class='buttonNavigation'>Mes statistiques</a>

            </div></div>";
        } else {
            $html .= "Vous n'êtes pas connecté(e)</div>";
            $html .= "<div class=\"menu connexion\">
            <a href=\"signin.php\" class='buttonNavigation'>Se connecter</a>
            <a href=\"signup.php\" class='buttonNavigation'>S'inscrire</a>
            </div>";
            $html .= "<div class=\"menu navigation\">
                <a href=\"index.php\" class='buttonNavigation'>Accueil</a>
            </div></div>";
        }
        return $html;
    }
}