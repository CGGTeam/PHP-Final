<link href="Views/EditGroupes/groupesStyles.css" rel="stylesheet" type="text/css">
<div class="container">
    <form method="post" onsubmit="return valide();" action="?controller=EditGroupes&action=ValidationCSV"
          enctype="multipart/form-data">
        <h1>Choisir un fichier CSV</h1>
        <label id="lblFichier" class="fichierSelect" for="fichierCSV">
            <input type="file" accept=".csv" id="fichierCSV" name="fichierCSV" onchange="updateSoumis()"/>
            Choisir Fichier
            <br/>
            <br/>
            <span id="fichierSoumis"></span>
        </label><br/>
        <button type="submit" class="boutonsConfirm">
            Soumettre
        </button>
    </form>
</div>
<script>
    var elemFichier = document.getElementById('fichierCSV');
    var elemWrapper = document.getElementById('lblFichier');
    var events = ['change', 'blur', 'mouseover', 'click', 'focus'];
    events.forEach(e => {
        elemFichier.addEventListener(e, updateSoumis);
        elemWrapper.addEventListener(e, updateSoumis);
    });
    function valide() {
        let extension = document.getElementById('fichierCSV').value.split('.').pop();
        let accept = document.getElementById('fichierCSV').accept;
        if (accept.indexOf(extension) === -1) {
            alert("Le type de fichier est invalide: le fichier doit être un .csv!");
        }
        return accept.indexOf(extension) !== -1;
    }

    function updateSoumis() {
        console.log(elemFichier.value);
        document.getElementById('fichierSoumis').innerHTML = !elemFichier.value || elemFichier.value === '' ? '' : 'Fichier Soumis: ' + elemFichier.value.split(/[\\/]/).pop();
    }
</script>