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

function postEventList(e) {
    let parents = getAllParents(e.target);
    let nodeTr = parents.find(obj => obj.tagName === "TR");
    console.log(nodeTr);
    if (nodeTr && nodeTr.$_objRef[nodeTr.$_objIndex]) {
        let objCourant = nodeTr.$_objRef[nodeTr.$_objIndex];
        if (objCourant instanceof $_postObj.classToPost) {
            $_postObj.changed = true;
            let objPost = {};
            console.log(objCourant.modelState);
            objCourant.modelState = (objCourant.modelState === 0 || (objCourant.modelState === 1 && objCourant.toDelete)) ? objCourant.modelState : 2;
            $_postObj.protoToPost.forEach(param => {
                if($_postObj.fctOnParam && $_postObj.fctOnParam[param]){
                    $_postObj.fctOnParam[param](objPost, objCourant);
                }else {
                    objPost[param] = objCourant[param];
                }
            });
            console.log(objPost);
            $_postObj.tabObjToPost[nodeTr.$_objIndex] = objPost;
        }
    }
}

function postCouleursList(e) {
    console.log(e.type);
    //if((e.type === "keydown" || e.type === "change") && !e.target.$_init) {
    let parents = getAllParents(e.target);
    let nodeTr = parents.find(obj => obj.tagName === "TR");
    if (nodeTr && nodeTr.$_objRef[nodeTr.$_objIndex]) {
        if (nodeTr.$_objRef[nodeTr.$_objIndex].modelState === 2) {
            nodeTr.style.backgroundColor = '#ffff33';
        }else if(nodeTr.$_objRef[nodeTr.$_objIndex].modelState === 1){
            nodeTr.style.backgroundColor = 'red';
        }
    }
    //}
    if(e.target.name === "main_id"){
        //let btn = document.getElementsByName(e.target.id.replace("tr","annuler"));
        e.target.id = "tr_" + e.target.value;
        //btn.name = "annuler_" + e.target.value;
        //btn.onclick = "annuler('" + e.target.value + "')";
    }
}

function configCouleurs() {
    $_anguleuxInterne.customEventListeners.push(postCouleursList);
}


/**
 *
 * @param objClass Class a post
 * @param cheminTab
 * @param tabProto array (optionnel) proprietes a envoyer, null si tout
 * @param fctOnParam Object avec des fonctions a faire sur les proprietes precises ({prop1: func1, prop2: func2...})
 */
function configPost(objClass, tabProto,cheminTab, fctOnParam){
    window.onbeforeunload = function () {
        return $_postObj.changed;
    };
    $_postObj.classToPost = objClass;
    if(tabProto)
        $_postObj.protoToPost = tabProto;
    else
        $_postObj.protoToPost = Object.keys(new objClass());
    $_postObj.protoToPost.push("toDelete");
    if(cheminTab){
        $_postObj.cheminTab = cheminTab;
    }else if(!$_postObj.cheminTab){
        $_postObj.cheminTab = "$scope.model";
    }
    $_postObj.protoToPost.push("modelState");
    $_postObj.tabObjToPost = [];
    $_anguleuxInterne.customEventListeners.push(postEventList);
    if(fctOnParam) {
        $_postObj.fctOnParam = fctOnParam;
    }
}

/**
 * Post les changements
 * @param type
 * @param lien
 * @param toDoBefore
 * @param reload
 * @param toDoAfter
 */
function postChanges(type,lien = "?controller=BD&action=Confirmer", toDoBefore=null, reload=false, toDoAfter=null){
    if($_postObj.confirmer){
        let rep = confirm("Êtes-vous sûrs de vouloir supprimer les éléments en rouge?");
        if(rep != true){
            return;
        }
    }
    if(toDoBefore){
        toDoBefore();
    }
    $_postObj.toDoAfter = toDoAfter;
    let tabToPost = $_postObj.tabObjToPost.filter(function(n){ return typeof n !== 'undefined' });
    $_postObj.tabObjToPost.forEach(x => delete x.toDelete);
    let strJSON = '';
    strJSON += (type+'\n');
    strJSON += JSON.stringify(tabToPost);
    strJSON = strJSON.replace(/true/g,'1').replace(/false/g,'0');
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if(xhttp.readyState === XMLHttpRequest.DONE){
            $_postObj.confirmer = false;
            delete $_postObj.changed;
            if(!reload) {
                try {
                    eval($_postObj.cheminTab + " = JSON.parse(xhttp.responseText)");
                    eval($_postObj.cheminTab + '.unshift(new ' + type + '())');
                }catch (e){}

                if($_postObj.toDoAfter){
                    $_postObj.toDoAfter();
                }
                configCouleurs();
                $_anguleuxInterne.updateAgFor(document.getElementById("tr_parent"));
                configPost(eval(type), $_postObj.protoToPost);
            }else {
                location.reload();
            }

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

function deleteSelected(tab){
    tab.forEach((obj, i) =>{
        if(obj.toDelete){
            obj.modelState = 1;
            $_postObj.tabObjToPost[i] = obj;
            $_anguleuxInterne.agForElements[0].$_createdElementsTable[i].style.backgroundColor = 'red';
            $_postObj.confirmer = true;
            $_postObj.changed = true;
        }
    });
}

function reconstruireStyle() {
    $_anguleuxInterne.agForElements[0].$_createdElementsTable[0].$_objRef.forEach((obj, i) => {
        switch (obj.modelState){
            case 0:
                $_anguleuxInterne.agForElements[0].$_createdElementsTable[i].style.backgroundColor = 'green';
                break;
            case 1:
                $_anguleuxInterne.agForElements[0].$_createdElementsTable[i].style.backgroundColor = 'red';
                break;
            case 2:
                $_anguleuxInterne.agForElements[0].$_createdElementsTable[i].style.backgroundColor = '#ffff33';
                break;
        }
    });
}

function trier(tab, comparateur) {
    tab.sort(comparateur);
    $_anguleuxInterne.updateAgFor(document.getElementById("tr_parent"));
}