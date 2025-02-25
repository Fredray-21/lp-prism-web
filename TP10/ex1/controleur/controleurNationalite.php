<?php
require_once("modele/Nationalite.php");

class ControleurNationalite extends ControleurObjet
{
    protected static $objet = "Nationalite";
    protected static $cle = "numNationalite";
    protected static $tableauChamps = array(
        "pays" => ["text", "Pays"],
        "abrege" => ["text", "Abrege"]
    );

    public static function creerNationalite()
    {
        $titre = "Création d'une Nationalite";
        $tableau[] = $_GET["pays"];
        $tableau[] = $_GET["abrege"];

        $result = Nationalite::addNationalite($tableau[0], $tableau[1]);

        if ($result) {
            self::lireObjets();
        } else {
            self::afficherFormulaireCreationObjet();
        }
    }
    public static function afficherFormulaireModificationObjet()
    {
        // On récupère l'objet à modifier
        $table = static::$objet;
        $cle = static::$cle;
        $objet = $table::getObjetById($_GET[$cle]);

        // On récupère les champs de l'objet
        $tableauChamps = static::$tableauChamps;
        $tableauChamps["identifiant"] = $_GET[$cle];

        // On récupère le titre de la page
        $titre = "Modification d'un " . static::$objet;

        // On affiche la page
        include("vue/debut.php");
        include(Session::urlMenu());
        include("vue/formulaireModificationObjet.php");
        include("vue/fin.html");
    }

    public static function modifierNationalite()
    {
        $titre = "Modification d'une Nationalite";
        $tableau[] = $_GET["identifiant"];
        $tableau[] = $_GET["pays"];
        $tableau[] = $_GET["abrege"];

        $result = Nationalite::updateNationalite($tableau[0], $tableau[1], $tableau[2]);

        if ($result) {
            self::lireObjets();
        } else {
            self::afficherFormulaireModificationObjet();
        }
    }
}
