class Cours{
    constructor(obj){
        /**
         * @type {string}
         */
        this.sigle = "";
        /**
         * @type {string}
         */
        this.titre = "";

        Object.assign(this, obj);
    }
}