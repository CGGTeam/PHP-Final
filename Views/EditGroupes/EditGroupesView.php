<link href="Style/groupesStyles.css" rel="stylesheet" type="text/css">
<div class="container">
    <div>

        <form method="post" enctype="multipart/form-data" class="fichierSelect">
            <label for="fileToUpload">Choisir un fichier CSV</label>
            <input type="file" style="" name="fileToUpload" id="fileToUpload">
        </form>

        <div class="sessionSelect">
            <select style="width: 100%">
                <option value="" disabled selected>Choisir session</option>
                <option>A-2016</option>
                <option>H-2016</option>
                <option>A-2017</option>
                <option>H-2016</option>
                <option>A-2018</option>
                <option>H-2016</option>
            </select>
        </div>
        <form>
            <table border="1" cellspacing="5" cellpadding="5">
                <tbody>
                <tr>
                    <th>NomUtilisateur</th>
                    <th>MotDePasse</th>
                    <th>NomComplet</th>
                    <th>Courriel</th>
                    <th>Sigle1</th>
                    <th>Sigle2</th>
                    <th>Sigle3</th>
                    <th>Sigle4</th>
                    <th>Sigle5</th>
                    <th>Verdict</th>
                </tr>
                <tr>
                    <td>n.laliberte</td>
                    <td>Secret12345</td>
                    <td>Laliberte, Nicole</td>
                    <td>nico.laliberte@gmail.com</td>
                    <td>420-4W5</td>
                    <td>ADM-H18</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>OK</td>
                </tr>
                <tr>
                    <td>n.laliberte</td>
                    <td>Secret12345</td>
                    <td>Laliberte, Nicole</td>
                    <td>nico.laliberte@gmail.com</td>
                    <td>420-4W5</td>
                    <td>ADM-H18</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>OK</td>
                </tr>
                <tr>
                    <td>n.laliberte</td>
                    <td>Secret12345</td>
                    <td>Laliberte, Nicole</td>
                    <td>nico.laliberte@gmail.com</td>
                    <td>420-4W5</td>
                    <td>ADM-H18</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>OK</td>
                </tr>
                <tr class="rouge">
                    <td>n.laliberte</td>
                    <td>Secret12345</td>
                    <td>Laliberte, Nicole</td>
                    <td>nico.laliberte@gmail.com</td>
                    <td>420-4W5</td>
                    <td>ADM-H18</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>OK</td>
                </tr>
                <tr>
                    <td>n.laliberte</td>
                    <td>Secret12345</td>
                    <td>Laliberte, Nicole</td>
                    <td>nico.laliberte@gmail.com</td>
                    <td>420-4W5</td>
                    <td>ADM-H18</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>OK</td>
                </tr>
                </tbody>
            </table>
            <button type="submit" name="submit" id="submit"
                        onclick="confirm('Êtes-vous certain de vouloir assigner ces informations?')">
                Confirmer
            </button>
            <button type="button" name="button" id="button"
                    onclick="window.location='?controller=AdminMenu&action=AdminMenu';">
                Retour
            </button>
        </form>
    </div>
</div>