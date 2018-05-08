<script>
    $scope.model.tDocuments.forEach((x,i) => $scope.model.tDocuments[i] = new DocumentBD(x));
    $scope.model.tDocuments.unshift(new DocumentBD());
    configPost(DocumentBD);

    function removeFirst(){
        delete $_postObj.tabObjToPost[0];
    }

    function nouvObj() {
        $scope.model.tDocuments[0].modelState = 0;
        $scope.model.tDocuments.unshift(new DocumentBD());
        //TODO reconstruire tableau + configPost
        reconstruirePost($scope.model.tDocuments);
    }

    function postDocuments() {
        let tabFichiers = document.getElementsByName("fichierInput");
        let formData = new FormData();
        tabFichiers.forEach(input => {
            if(input.value !== ""){
                formData.append(input.getAttribute("noFichier"),input.files[0]);
            }
        });
        console.log(formData);
        if(!formData.values().next().done) {
            let xhr = new XMLHttpRequest();
            xhr.open('POST', '?controller=EditDocuments&action=UploadDocuments, true', true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    postChanges('Document', removeFirst)
                }
            };
            xhr.send(formData);
        }else {
            postChanges('Document', removeFirst);
        }
    }
</script>

<link rel="stylesheet" href="Utilitaires/anguleux/AnguleuxStyle.css"/>
<link href="Style/editDocumentsStyle.css" rel="stylesheet" type="text/css">
<div class="container">
    <table border="1" cellspacing="5" cellpadding="5">
        <tbody>
        <tr>
            <th scope="col">Date cours</th>
            <th scope="col">No Sequence</th>
            <th scope="col">Date acces debut</th>
            <th scope="col">Date acces fin</th>
            <th scope="col">Titre</th>
            <th scope="col">Description</th>
            <th scope="col">NbPages</th>
            <th scope="col">Categorie</th>
            <th scope="col">No version</th>
            <th scope="col">Date version</th>
            <th scope="col">Fichier</th>
        </tr>
        <tr ag-for="doc in model.tDocuments">
            <td><input type="date" name="date5" id="date13" for-bind="true" for-bind-path="dateCours"></td>
            <td><select name="select4" id="select10">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                    <option>6</option>
                    <option>7</option>
                    <option>8</option>
                    <option>9</option>
                    <option>10</option>
                    <option>11</option>
                    <option>12</option>
                    <option>13</option>
                    <option>14</option>
                    <option>15</option>
                    <option>16</option>
                    <option>17</option>
                    <option>18</option>
                    <option>19</option>
                    <option>20</option>
                </select>
            </td>
            <td><input type="date" name="date5" id="date14" for-bind="true" for-bind-path="dateAccessDebut"></td>
            <td><input type="date" name="date5" id="date15" for-bind="true" for-bind-path="dateAccessFin"></td>
            <td><input type="text" name="textfield3" id="textfield7" placeholder="Entrez un titre" for-bind="true" for-bind-path="titre"></td>
            <td><input type="text" name="textfield3" id="textfield8" placeholder="Entrez une description" for-bind="true" for-bind-path="description"></td>
            <td><input type="number" name="number2" id="number4" for-bind="true" for-bind-path="nbPages"></td>
            <td><select name="select4" id="select11" for-bind="true">
                    <option ag-for="cat in model.tCategories" selected>{{cat.description}}</option>
                </select>
            </td>
            <td><select name="select4" id="select12">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                </select>
            </td>
            <td><input type="date" name="date5" id="date16" for-bind="true" for-bind-path="dateVersion"></td>
            <td><form method="post" action="?controller=EditDocuments&action=UploadDocuments&idDoc={{doc.id}}" onsubmit="return false" enctype="multipart/form-data">
                    <label for="fichierInput">Changer le document</label>
                    <input type="file" name="fichierInput" noFichier="{{doc.id}}">
                </form></td>
        </tr>
        </tbody>
    </table>
    <button type="button" name="submit" id="submit" class="boutonsConfirm" onclick="postDocuments()">
        Enregistrement
    </button>
    <button type="button" name="submit" id="submit" class="boutonsConfirm" onclick="nouvObj()">
        Ajouter
    </button>
    <button type="button" name="button" id="button" class="boutonsConfirm"
            onclick="window.location='?controller=AdminMenu&action=AdminMenu';">
        Retour
    </button>
</div>