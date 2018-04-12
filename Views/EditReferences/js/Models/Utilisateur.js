class Utilisateur{

    constructor(id, nomUtilisateur, motDePasse, statutAdmin, nomComplet, courriel){
        /**
         * @type {number}
         */
        this.id = id;
        /**
         * @type {string}
         */
        this.nomUtilisateur = nomUtilisateur;
        /**
         * @type {string}
         */
        this.motDePasse = motDePasse;
        /**
         * @type {boolean}
         */
        this.statutAdmin = statutAdmin;
        /**
         * @type {string}
         */
        this.nomComplet = nomComplet;
        /**
         * @type {string}
         */
        this.courriel = courriel;
    }

}