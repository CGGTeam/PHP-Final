$scope.docTitreLien = {

    href: "{{doc.hyperLien}}",

};

configPost(Document);

function ConfirmerSuppressionBD() {

    postChanges('Document', "index.php?controller=EditArborescence&action=ConfirmerSuppressionBD");

}

function getNearestElementByQuery(element, tagName){
    //da wae
    let workingElement;
    let compteur = 0;
    do{
        compteur++;
        workingElement = element.parentElement;
        if(compteur > 256){
            break;
            return -1;
        }
    }while (workingElement.tagName.toLowerCase() !== tagName.toLowerCase());
    return workingElement;
}

function ck(e){

}