<?php
declare(strict_types=1);

namespace iutnc\touiter\touit;

use iutnc\touiter\db\ConnexionFactory;

class TouiteList
{
    private array $touiteList;
    private int $nPages;

    public function __construct()
    {
        $this->touiteList = Array();
        $this->nPages=0;
    }


    public function __get(string $at): mixed
    {
        if (property_exists($this, $at)) return $this->$at;
        throw new \Exception ("$at: invalid property");
    }

    // Création d'une liste de touites selon une requête donné
    public function creerTouiteListe(\PDOStatement $statement, \PDO $pdo) : void {
        $statement->execute();
        while ($result = $statement->fetch(\PDO::FETCH_ASSOC)) {
            // s'il y a une image on ajoute un touite sans le chemin de l'image
                if (is_null($result['idImage'])) {
                    $this->touiteList[] = new Touite(intval($result['idTouite']), $result['datePubli'], $result['texteTouite'], $result['prenomUtil'], $result['nomUtil']);
                } else { // S'il y a une image on récupère son adresse depuis la base de données
                    $query2 = "select cheminImage from image where idImage = ?";
                    $stmt2 = $pdo->prepare($query2);
                    $stmt2->bindParam(1, $result['idImage']);
                    $stmt2->execute();
                    $result2 = $stmt2->fetch(\PDO::FETCH_ASSOC);
                    $this->touiteList[] = new Touite(intval($result['idTouite']), $result['datePubli'], $result['texteTouite'], $result['prenomUtil'], $result['nomUtil'], $result2['cheminImage']);
            }
        }
        $pdo=null;
    }

    // Créer une liste de touites contenant tous les touites existants
    public function mainTouiteList() : void {
        $this->touiteList = [];
        $pdo = ConnexionFactory::makeConnection();
        if (isset($_GET['page'])){
            $this->nPages=($_GET['page'])-1;
        }
        $limit = $this->nPages * 10;
        $query = "select idTouite, idImage, texteTouite, datePubli, prenomUtil, nomUtil 
                  from touite, util 
                  where touite.idUtil=util.idUtil 
                  order by datePubli desc limit 10 offset $limit";
        $stmt = $pdo->query($query);
        $this->creerTouiteListe($stmt, $pdo);
    }

    // Créer une liste des touites envoyés par un utilisateur donné
    public function userTouiteList(int $id) : void {
        $this->touiteList = [];
        $pdo = ConnexionFactory::makeConnection();
        if (isset($_GET['page'])){
            $this->nPages= intval($_GET['page'])-1;
        }
        $limit = $this->nPages * 10;
        $query = "select idTouite, idImage, texteTouite, datePubli, prenomUtil, nomUtil 
                  from touite, util 
                  where touite.idUtil=util.idUtil 
                    and util.idUtil = ? 
                  order by datePubli desc limit 10 offset $limit";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(1, $id);
        $this->creerTouiteListe($stmt, $pdo);
    }

    // Créer une liste de touites contnant un tag donné
    public function tagTouiteList(string $tag) : void {
        $this->touiteList = [];
        $pdo = ConnexionFactory::makeConnection();
        if (isset($_GET['page'])){
            $this->nPages=($_GET['page'])-1;
        }
        $limit = $this->nPages * 10;
        $query = "select tag2touite.idTouite, idImage, texteTouite, datePubli, prenomUtil, nomUtil
                  from touite, util, tag, tag2touite 
                  where touite.idUtil=util.idUtil 
                  and tag2touite.idTouite=touite.idTouite 
                  and tag2touite.idTag=tag.idTag 
                  and tag.libelleTag = ? 
                  order by datePubli desc limit 10 offset $limit";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(1, $tag);
        $this->creerTouiteListe($stmt, $pdo);
    }

    // Créer une liste de touites contenant un tag auquel l'utilisateur est abonné ou provenant d'une personne à laquelle on est abonnée
    public function getTouiteListInteressant(int $idUtil) : void {
        $this->touiteList = [];
        $pdo = ConnexionFactory::makeConnection();
        if (isset($_GET['page'])){
            $this->nPages=($_GET['page'])-1;
        }
        $limit = $this->nPages * 10;
        $sqlIdTouite = "SELECT touite.idTouite, idImage, texteTouite, datePubli, prenomUtil, nomUtil
                        FROM touite, util 
                        WHERE touite.idUtil=util.idUtil 
                        AND touite.idTouite IN 
                        (SELECT touite.idTouite FROM touite, suivreutil
                        WHERE touite.idUtil = suivreutil.idUtilSuivi
                        AND suivreUtil.idUtil = :idUtil
                        UNION 
                        SELECT tag2touite.idTouite FROM tag2touite, suivretag
                        WHERE tag2touite.idTag = suivretag.idTag
                        AND suivreTag.idUtil = :idUtil)
                        ORDER BY datePubli DESC;";
        $stmt = $pdo->prepare($sqlIdTouite);
        $stmt->bindParam(":idUtil", $idUtil);
        $this->creerTouiteListe($stmt, $pdo);
        $pdo = null;
    }

}