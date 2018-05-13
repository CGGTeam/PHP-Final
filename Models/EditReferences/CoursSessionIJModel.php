<?php
/**
 * Created by PhpStorm.
 * User: Simon Boyer
 * Date: 12/05/18
 * Time: 17:25
 */

class CoursSessionIJModel extends ModelBinding
{

    /** @var string $session No de la session (A-2099; H-2018 à A-2021) H */
    public $session;
    /** @var string $sigle Sigle du cours (999-ZZZ; ADM-A99) */
    public $sigle;
    /** @var int $utilisateur */
    public $utilisateur;
    /** @var string $nomUtilisateur Identifiant pour connexion */
    public $nomUtilisateur;
    /** @var string $motDePasse Mot de passe pour connexion */
    public $statutAdmin;
    /** @var string $nomComplet Nom et prénom de l’utilisateur */
    public $nomComplet;

    public function __construct(array $properties = array(), $binAjout = false) {
        parent::__construct($properties, $binAjout);
    }

    public function valider() {
        return true;
    }

}