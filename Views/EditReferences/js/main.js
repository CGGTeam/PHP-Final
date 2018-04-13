/**
 * @type {string}
 */
var type=type;

var strHTML_TH;
var strHTML_Rangee;

var refTable = document.getElementById('tableAffichage');

var tabProto = {
    "Session" : Session.prototype,
    "Cours" : Cours.prototype,
    "CoursSession" : CoursSession.prototype,
    "Categorie" : Categorie.prototype,
    "Utilisateur" : Utilisateur.prototype
};

var tabPropID = {
    "Session" : 'description',
    "Cours" : 'sigle',
    "CoursSession" : 'session-sigle',
    "Categorie" : 'id',
    "Utilisateur" : 'id'
};

let tabDonnees = [];

function getModel(){
    let jsonResult = JSON.parse(document.getElementById('model').innerHTML);
    jsonResult.forEach((x, i) => {
        tabDonnees[i] = new tabProto[type].constructor(x);
    });
}

function cbSelTout(){
    console.log("cbSelTout();")
}

function construireTH(){

    let strDebug = "";

    strDebug += "<tr>";
    strDebug += "<th><input id=\"cbSelTout\" type=\"checkbox\" onclick='cbSelTout();'></th>";

    for(let prop in (new tabProto[type].constructor({}))){
        strDebug += "<th>"+prop+"</th>";
    }

    strDebug += "</tr>";

    refTable.innerHTML += strDebug;

}

/**
 *
 * @param name string
 * @param prop object
 * @returns {string}
 */
function decideInputType(name, prop){
    switch(typeof prop){
        case 'string':
            if(name.includes("date"))
                return 'date';
            return 'text';
        case 'boolean':
            return 'checkbox';
        case 'number':
            return 'number';

    }
}

function cbObjNouv() {
    if(document.getElementById('cbObjNouv').checked){
        Array.from(document.getElementsByClassName("cbObjDef")).forEach(function(item) {
            item.checked = false;
        });
    }
}

function construireRangees(){

    let strFlux = "";

    strFlux += "<tr id='idRangeeNouv'>";
    strFlux += "<td><div id=\"id_cb_nouv\" class=\"checkbox\">\n" +
    "                    <label>\n" +
    "                        <input id=\"cbObjNouv\" type=\"checkbox\" onclick='cbObjNouv();'>\n" +
    "                        <em class=\"helper\"></em> </label>\n" +
    "                </div></td>";

    for(let prop in (new tabProto[type].constructor({}))){
        if(decideInputType(prop, tabDonnees[0][prop]) == 'checkbox'){
            strFlux += "<td><div class=\"checkbox\">\n" +
                "                    <label>\n" +
                "                        <input id='tb_" + prop + "_nouv' type='" + decideInputType(prop, tabDonnees[0][prop]) + "'>\n" +
                "                        <em class=\"helper\"></em> </label>\n" +
                "                </div></td>";
        }else {
            strFlux += "<td><input id='tb_" + prop + "_nouv' type='" + decideInputType(prop, tabDonnees[0][prop]) + "'></td>";
        }
        }

    tabDonnees.forEach((x,i) => {
        strFlux += "<tr class='sRangeeDonnee' id='rangee_"+x[tabPropID[type]]+"'>";
    strFlux += "<td><div id=\"id_cb_" + x[tabPropID[type]] + "\" class=\"checkbox\">\n" +
        "                    <label>\n" +
        "                        <input class='cbObjDef' id=\"cb_"+x[tabPropID[type]] +"\" type=\"checkbox\">\n" +
        "                        <em class=\"helper\"></em> </label>\n" +
        "                </div></td>"

        for(let prop in (new tabProto[type].constructor({}))){
            let idInput = '';
            if(prop === tabPropID[type]){
                idInput = 'tb_id_' + x[prop];
            }else{
                idInput = 'tb_'+prop+'_'+x[tabPropID[type]];
            }
            if(decideInputType(prop, tabDonnees[0][prop]) == 'checkbox'){
                strFlux += "<td><div class=\"checkbox\">\n" +
                    "                    <label>\n" +
                    "                        <input id='" + idInput + "' type='" + decideInputType(prop, tabDonnees[0][prop]) + "' value='true'"
                    + ((x[prop]) ? "checked" : "") + ">\n" +
                    "                        <em class=\"helper\"></em> </label>\n" +
                    "                </div></td>";
            }else {
                strFlux += "<td><input id='" + idInput + "' type='" + decideInputType(prop, tabDonnees[0][prop]) + "' value='" + x[prop] + "'></td>";
            }
            }
    });

    refTable.innerHTML += strFlux;

}

getModel();
construireTH();
construireRangees();

function decortiquerTableauEnJS(state){
    let tbRangees = [];
    switch(state){
        case 0:
            tbRangees = [document.getElementById('idRangeeNouv')];
            break;
        case 2:
            tbRangees = Array.from(document.getElementsByClassName('sRangeeDonnee'));
            break;
        default:
            tbRangees = Array.from(document.getElementsByClassName('sRangeeDonnee'));
            break;
    }

    let tbObjets = [];

    tbRangees.forEach((x, i) => {
        let obj = {};
        obj["modelState"]=state;
        if(state==0){
            obj[tabPropID[type]] = document.getElementById("tb_"+tabPropID[type]+"_nouv").value;
        }else{
            obj[tabPropID[type]] = x.id.split('_')[1];
        }
        Array.from(x.children).forEach((y,j)=>{
            let input = y.children.item(0);
            if(!input.id.includes('cb')) {
                if(input.className == 'checkbox'){
                    input = input.children.item(0).children.item(0);
                    obj[input.id.split('_')[1]] = input.checked ? 1 : 0;
                }else {
                    obj[input.id.split('_')[1]] = input.value;
                }
            }
        });
        tbObjets.push(obj);
    });

    console.log(tbObjets);
    return tbObjets;
}

function POST(obj){
    let strJSON = '';
    strJSON += (type+'\n');
    strJSON += JSON.stringify(obj);
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {console.log(this.responseText);};
    xhttp.open("POST", "index.php?controller=EditReferences&action=Confirmer&strType="+type, true);
    xhttp.setRequestHeader("Content-type", "application/json");
    xhttp.send(strJSON);
}

function DELETE(){

}

function btnAjouter(){
    POST(decortiquerTableauEnJS(0));
}

function btnSauvgarder(){
    POST(decortiquerTableauEnJS(2));
}

function btnSupprimer(){
    DELETE()
}

