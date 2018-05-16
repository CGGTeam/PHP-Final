$scope.docTitreLien = {

    href: "{{doc.hyperLien}}",

};

configPost(Object);
configCouleurs();

$scope.state = 0;

function ConfirmerSuppressionBD() {

    $_postObj.tabObjToPost = [];

    $scope.model.forEach((x) => {
        if (x.toDelete !== true) {
            x.modelState = 3;
        }
        $_postObj.tabObjToPost.push(x);
    });

    postChanges('DocumentBD', "module-admin.php?controller=EditArborescence&action=ConfirmerSuppressionBD", null, false, afficherVerdictState, false);

}


function afficherVerdictState() {

    $scope.state = 1;

    let trParent = document.getElementById("tr_parent");
    let thEtat = document.getElementById("thEtat");

    //Remove Checkbox column
    trParent.querySelector(".colSupprCB").remove();

    console.log(trParent);

    //Change col heading
    thEtat.innerHTML = "Verdict";

    //Add verdict column
    trParent.innerHTML += "<td>{{x.verdict}}</td>";

    //remove other btns
    document.getElementById("btnEnregistrer").remove();
    document.getElementById("btnSupprimer").remove();

    //Show btnNettoyage
    document.getElementById("btnNettoyage").removeAttribute("style");

}

function getNearestElementByQuery(element, tagName) {
    //da wae
    let workingElement;
    let compteur = 0;
    do {
        compteur++;
        workingElement = element.parentElement;
        if (compteur > 256) {
            break;
            return -1;
        }
    } while (workingElement.tagName.toLowerCase() !== tagName.toLowerCase());
    return workingElement;
}

function ConfirmerSuppressionFichiers() {
    let lien = "?controller=EditArborescence&action=ConfirmerSuppressionFichiers";

    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState === XMLHttpRequest.DONE)
            finalState(xhttp);
    };
    xhttp.open("GET", lien, true);
    xhttp.send();
}


function finalState(xhttp) {
    $scope.model = JSON.parse(xhttp.responseText);

    let trTH = document.getElementById("trTH");
    let trParent = document.getElementById("tr_parent");

    let fluxTRTH = "";
    fluxTRTH += "<th scope=\"col\">#</th>";
    fluxTRTH += "<th scope=\"col\">Nom du fichier</th>";
    fluxTRTH += "<th scope=\"col\">Verdict</th>";
    trTH.innerHTML = fluxTRTH;

    let fluxTR_PARENT = "";
    fluxTR_PARENT += "<td index-offset='1'>{{_index}}</td>";
    fluxTR_PARENT += "<td>{{doc.nomFichier}}</td>";
    fluxTR_PARENT += "<td>{{doc.verdict}}</td>";
    trParent.innerHTML = fluxTR_PARENT;

    $_anguleuxInterne.updateAgFor(document.getElementById("tr_parent"));

    document.getElementById("btnNettoyage").remove();
}