const $_postObj = {
    classToPost: null,
    protoToPost: null,
    tabObjToPost: null
};


Array.prototype.inArray = function(comparer, element) {
    for(var i=0; i < this.length; i++) {
        if(comparer(this[i], element)) return true;
    }
    return !Boolean(element);
};

Array.prototype.refInArray = function(element){
    for(var i=0; i < this.length; i++) {
        if(this[i] == element) return true;
    }
    return false;
};

Array.prototype.pushIfNotExist = function(element, comparer) {
    if (!this.inArray(comparer, element)) {
        this.push(element);
    }
};

Array.prototype.removeIfExist = function(element, comparer) {
    if (this.inArray(comparer, element)) {
       // this.;
    }
};

Array.prototype.pushIfNoNull = function(element){
    if(element !== null){
        this.push(element);
    }
};

Array.prototype.pushCroissant = function(element, comparer, binCroissant){
    for(let i = 0; i < this.length; i++){
        if(comparer(this[i], element)){
            this.splice(i,0,element);
            return;
        }
    }
    this.push(element);
};

function getAllParents(a) {
    let els = [];
    while (a) {
        els.push(a);
        a = a.parentNode;
    }
    return els;
}

/**
 *
 * @param objClass Class a post
 * @param tabProto array (optionnel) proprietes a envoyer, null si tout
 * @param fctOnParam Object avec des fonctions a faire sur les proprietes precises ({prop1: func1, prop2: func2...})
 */
function configPost(objClass, tabProto, fctOnParam){
    $_postObj.classToPost = objClass;
    if(tabProto)
        $_postObj.protoToPost = tabProto;
    else
        $_postObj.protoToPost = Object.keys(new objClass());
    $_postObj.protoToPost.push("modelState");
    $_postObj.tabObjToPost = [];
    $_anguleuxInterne.customEventListeners.push( function (e) {
        let parents = getAllParents(e.target);
        let nodeTr = parents.find(obj => obj.tagName === "TR");
        if (nodeTr && nodeTr.$_objRef[nodeTr.$_objIndex]) {
            let objCourant = nodeTr.$_objRef[nodeTr.$_objIndex];
            if (objCourant instanceof $_postObj.classToPost) {
                let objPost = {};
                objCourant.modelState = 2;
                $_postObj.protoToPost.forEach(param => {
                    if(fctOnParam && fctOnParam[param]){
                        fctOnParam[param](objPost, objCourant);
                    }else {
                        objPost[param] = objCourant[param];
                    }
                });
                $_postObj.tabObjToPost[nodeTr.$_objIndex] = objPost;
            }
        }
    });
}

/**
 * Post les changements
 * @param type
 * @param lien
 * @param toDoBefore
 */
function postChanges(type,lien = "index.php?controller=BD&action=Confirmer", toDoBefore=null){
    if(toDoBefore){
        toDoBefore();
    }
    let tabToPost = $_postObj.tabObjToPost.filter(function(n){ return n !== undefined });
    let strJSON = '';
    strJSON += (type+'\n');
    strJSON += JSON.stringify(tabToPost);
    strJSON = strJSON.replace(/true/g,'1').replace(/false/g,'0');
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if(xhttp.readyState === XMLHttpRequest.DONE){
            tabDonnees = [];
        }
    };
    xhttp.open("POST", lien + "&strType=" + type, true);
    xhttp.setRequestHeader("Content-type", "application/json");
    console.log(strJSON);
    xhttp.send(strJSON);
}

function emptyObject(obj) {
    let newObj = {};
    for(let prop in obj){
        newObj[prop] = "";
    }
    return newObj;
}

function reconstruirePost(tableau) {
    $_postObj.tabObjToPost = [];
    tableau.forEach((obj,i) => {
       let nouvObj = {};
       $_postObj.protoToPost.forEach(prop => {
           (typeof obj[prop] !== "undefined") && (nouvObj[prop] = obj[prop]);
       });
       if((typeof nouvObj.modelState !== "undefined") && nouvObj.modelState !== 3){
           $_postObj.tabObjToPost[i] = nouvObj;
       }
    });
}