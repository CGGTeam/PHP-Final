class Utilisateur{

    constructor(obj){
        /**
         * @type {number}
         */
        this.id = obj.id;
        /**
         * @type {string}
         */
        this.nomUtilisateur = obj.nomUtilisateur;
        /**
         * @type {string}
         */
        this.motDePasse = obj.motDePasse;
        /**
         * @type {number}
         */
        this.statutAdmin = obj.statutAdmin;
        /**
         * @type {string}
         */
        this.nomComplet = obj.nomComplet;
        /**
         * @type {string}
         */
        this.courriel = obj.courriel;
    }

}