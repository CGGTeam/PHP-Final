 /**
     * Created by PhpStorm.
     * User: antoi
     * Date: 2018-04-01
     * Time: 11:27 AM
     */

    /**
     * Class Document - Modèle qui représente un document
     */
    class DocumentBD
    {
        constructor(obj){

            obj && Object.assign(this, obj);

            /** @var string id */
            (this.id === "undefined") && (this.id = "");
            /** @var string session No de la session (A-2099; H-2018 à A-2021) */
            (this.session  === "undefined") && (this.session = "");
            /** @var string sigle Sigle du cours (999-ZZZ; ADM-A99) */
            (this.sigle  === "undefined") && (this.sigle = "");
            /** @var string dateCours Date de remise du document */
            (this.dateCours  === "undefined") && (this.dateCours = "");
            /** @var int noSequence No de séquence dans le cours */
            (this.noSequence  === "undefined") && (this.noSequence = "");
            /** @var string dateAccesDebut Date de début d’accessibilité */
            (this.dateAccesDebut  === "undefined") && (this.dateAccesDebut = "");
            /** @var string dateAccesFin Date de fin d’accessibilité */
            (this.dateAccesFin  === "undefined") && (this.dateAccesFin = "");
            /** @var string titre Titre du document */
            (this.titre  === "undefined") && (this.titre = "");
            /** @var string description Description du document */
            (this.description  === "undefined") && (this.description = "");
            /** @var int nbPages Nombre de pages */
            (this.nbPages  === "undefined") && (this.nbPages = 0);
            /** @var string categorie Catégorie du document */
            (this.categorie  === "undefined") && (this.categorie = "");
            /** @var int noVersion Numéro de la version */
            (this.noVersion  === "undefined") && (this.noVersion = 1);
            /** @var string dateVersion Date de la dernière version */
            (this.dateVersion  === "undefined") && (this.dateVersion = "");
            /** @var string hyperLien Nom du document ex: 25-projet-fin-session-2018-03-23.pdf */
            (this.hyperLien  === "undefined") && (this.hyperLien = "");
            /** @var string ajoutePar No de l’administrateur ayant effectué l’ajout */
            (this.ajoutePar  === "undefined") && (this.ajoutePar = "");
        }

}