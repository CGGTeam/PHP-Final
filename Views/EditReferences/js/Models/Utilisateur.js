class Utilisateur{

    constructor(obj){
        /**
         * @type {number}
         */
        this.id = "";
        /**
         * @type {string}
         */
        this.nomUtilisateur = "";
        /**
         * @type {string}
         */
        this.motDePasse = "";
        /**
         * @type {number}
         */
        this.statutAdmin = false;
        /**
         * @type {string}
         */
        this.nomComplet = "";
        /**
         * @type {string}
         */
        this.courriel = "";

        obj && Object.assign(this, obj);

        this.statutAdmin = !!this.statutAdmin;

    }

}