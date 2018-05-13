class Session {

 constructor(obj){

     obj && Object.assign(this, obj);

     /**
      * @type {string}
      */
     (typeof this.description === "undefined") && (this.description = "");
     /**
      * @type {Date}
      */
     (typeof this.dateDebut === "undefined") && (this.dateDebut = "");
     /**
      * @type {Date}
      */
     (typeof this.dateFin === "undefined") && (this.dateDebut = "");
 }

}