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
    toTypes(jsonResult);
}

function toTypes(tabObjets){
    tabObjets.forEach((x, i) => {
        let tempo = new tabProto[type].constructor(x);
        tempo.checked = x.checked ? x.checked : false;
        if(tempo.checked){
            tempo.modelState = (x.modelState === 0 || tabDonnees[i].modelState === 0) ? 0 : 2;
        }else{
            tempo.modelState = 3;
        }
        tabDonnees[i] = tempo;
    });
}

function cbSelTout(){
    console.log("cbSelTout();")
}

function check(toCheck) {
    let id = 'tb_checked_' + toCheck.id.split('_')[2];
    document.getElementById(id).checked = true;
}

function construireTH(){

    let strDebug = "";

    strDebug += "<tr>";
    strDebug += "<th></th><th>Supprimer/<br/>Sauvegarder</th>";
    /*strDebug += "<th><div id=\"cbSelTout\" class=\"checkbox\">\n" +
        "                    <label>\n" +
        "                        <input id=\"cbObjNouv\" type=\"checkbox\" onclick=\"cbSelTout();\">\n" +
        "                        <em class=\"helper\"></em> </label>\n" +
        "                </div></th>"; */

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
    strFlux += "<td name='ignore'>*</td><td><div id=\"cb_nouv\" class=\"checkbox\">\n" +
    "                    <label>\n" +
    "                        <input id=\"tb_checked_nouv\" type=\"checkbox\" value=\"true\" onclick='cbObjNouv();'>\n" +
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
    strFlux += "<td name='ignore'></td><td><div class=\"checkbox\" id='cb_select'>\n" +
        "                    <label>\n" +
        "                        <input id=\"tb_checked_" + x[tabPropID[type]] + "\" class=\"checkbox\" value='true' type='checkbox' " + (x.checked ? "checked" : "") + ">\n" +
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
                    + ((x[prop]) ? "checked" : "") + "'>\n" +
                    "                        <em class=\"helper\"></em> </label>\n" +
                    "                </div></td>";
            }else {
                strFlux += "<td><input id='" + idInput + "' type='" + decideInputType(prop, tabDonnees[0][prop]) + "' value='" + x[prop] + "' onchange='check(this)'></td>";
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
            tbRangees = tbRangees.concat(Array.from(document.getElementsByClassName('sRangeeDonnee')));
            break;
        case 1:
            tbRangees = Array.from(document.getElementsByClassName('sRangeeDonnee')).filter((x,i) => {
                return x.children.item(0).children.item(0).children.item(0).children.item(0).checked;
            });
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
        if(i === 0 && state === 0) {
            obj.modelState = 0;
        }
        if(obj.modelState === 0){
            obj[tabPropID[type]] = document.getElementById("tb_"+tabPropID[type]+"_nouv").value;
        }else{
            obj[tabPropID[type]] = x.id.split('_')[1];
        }
        Array.from(x.children).forEach((y,j)=>{
            if(!y.attributes["name"] || y.attributes["name"].nodeValue !== "ignore") {
                let input = y.children.item(0);
                if (!input.id.includes('cb')) {
                    if (input.className === 'checkbox') {
                        input = input.children.item(0).children.item(0);
                        obj[input.id.split('_')[1]] = input.checked ? 1 : 0;
                    } else {
                        obj[input.id.split('_')[1]] = input.value;
                    }
                }else{
                    input = input.children.item(0).children.item(0);
                    obj[input.id.split('_')[1]] = input.checked;
                }
            }
        });
        tbObjets.push(obj);
    });

    return tbObjets;
}

function POST(obj){
    obj.forEach((x)=>{
       delete x.checked;
    });
    let strJSON = '';
    strJSON += (type+'\n');
    strJSON += JSON.stringify(obj);
    strJSON = strJSON.replace(/true/g,'1').replace(/false/g,'0');
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {document.getElementById("frmSecret").submit();};
    xhttp.open("POST", "index.php?controller=BD&action=Confirmer&strType=" + type, true);
    xhttp.setRequestHeader("Content-type", "application/json");
    console.log(strJSON);
    xhttp.send(strJSON);
}

function DELETE(){

}

function btnAjouter(){
    let tabTempo = decortiquerTableauEnJS(0);
    tabTempo[0].checked = true;
    toTypes(tabTempo);
    refTable.children[1].remove();
    construireRangees();
}

function btnSauvgarder(){
    let tabTempo = decortiquerTableauEnJS(2);
    toTypes(tabTempo);
    refTable.children[1].remove();
    construireRangees();
    console.log(tabDonnees);
    POST(tabDonnees);
}

function btnSupprimer(){
    POST(decortiquerTableauEnJS(1));
}

