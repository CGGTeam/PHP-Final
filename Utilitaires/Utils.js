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

function configPost(objClass, tabProto, fctOnParam){
    $_postObj.classToPost = objClass;
    $_postObj.protoToPost = tabProto;
    $_postObj.tabObjToPost = [];
    $_anguleuxInterne.customEventListeners.push( function (e) {
        let parents = getAllParents(e.target);
        let nodeTr = parents.find(obj => obj.tagName === "TR");
        if (nodeTr && nodeTr.$_objRef[nodeTr.$_objIndex]) {
            let objCourant = nodeTr.$_objRef[nodeTr.$_objIndex];
            if (objCourant instanceof $_postObj.classToPost) {
                let objPost = {modelState: 2};
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

function postChanges(type, toDoBefore=null){
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
    xhttp.open("POST", "index.php?controller=BD&action=Confirmer&strType=" + type, true);
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