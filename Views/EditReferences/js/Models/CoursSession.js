class CoursSession{
    constructor(obj){
        /**
         * @type {string}
         */
        this.session = "";
        /**
         * @type {string}
         */
        this.sigle = "";
        /**
         * @type {number}
         */
        this.utilisateur = "";

        this.nomComplet = "";

        this.nomUtilisateur = "";

        this.statutAdmin = false;

        obj && Object.assign(this, obj);
        this.statutAdmin = !!this.statutAdmin;
    }
}