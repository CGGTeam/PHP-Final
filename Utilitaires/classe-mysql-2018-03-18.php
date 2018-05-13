<?php
   /*
   |----------------------------------------------------------------------------------------|
   | class mysql
   |----------------------------------------------------------------------------------------|
   */
   class mysql {
       /** @var mysqli $cBD */
       public $cBD = null;
       /** @var array $listeEnregistrements */
       public $listeEnregistrements = null;
       /** @var string $nomFichierInfosSensibles */
       public $nomFichierInfosSensibles = "";
       /**@var string $nomBD */
       public $nomBD = "";
       /** @var mysqli_result | bool $OK */
       public $OK = false;
       /**@var string $requete dernière requête executée */
       public $requete = "";
       /** @var mysql $BD */
      private static $BD = null;
      function __construct($strNomBD, $strNomFichierInfosSensibles) {
          $this->nomBD = $strNomBD;
          $this->nomFichierInfosSensibles = $strNomFichierInfosSensibles;
          $this->connexion();
      }
    
       /**
        * @return mysqli|null retourne le link si succès ou null autrement
        */
      function connexion() {
          $strNomAdmin = "";
          $strMotPasseAdmin = "";
          require($this->nomFichierInfosSensibles);
          $this->cBD = mysqli_connect("p:localhost", $strNomAdmin, $strMotPasseAdmin, $this->nomBD);
          if (mysqli_connect_errno()) {
              echo "<br />";
              echo "Problème de connexion... " . "Erreur no " . mysqli_connect_errno() . " (" . mysqli_connect_error() .")";
              die();
          };
          mysql::$BD = $this;
          $this->cBD->set_charset("utf8");
          return $this->cBD;
      }
    
       /**
        * Copie les enregistrements qui correspondent à des critères d'une table à une autre.
        * @param string $strNomTableSource Nom de la table à partir de laquelle les enregistrements seront copiés
        * @param string $strListeChampsSource Liste de champs à copier
        * @param string $strNomTableCible Nom de la table où seront copié les enregistrements
        * @param string | null $strListeChampsCible spécifie optionnellement des champs cibles. Par défaut = champs sources
        * @param string $strListeConditions Conditions pour la clause WHERE
        * @return bool retourne un booléen selon la réussite ou l'échec de la requête
        */
      function copieEnregistrements($strNomTableSource, $strListeChampsSource, $strNomTableCible, $strListeChampsCible, $strListeConditions="") {
         /* Réf.: www.lecoindunet.com/dupliquer-ou-copier-des-lignes-d-une-table-vers-une-autre-avec-mysql-175 */
         if($strListeChampsCible == ""){
             $strListeChampsCible = $strListeChampsSource;
         }

         $this->requete = "INSERT INTO $strNomTableCible ($strListeChampsCible) SELECT $strListeChampsSource FROM $strNomTableSource";
         if($strListeConditions != ""){
             $this->requete .= " WHERE $strListeConditions";
         }
          $this->OK = mysqli_query($this->cBD, $this->requete);
          return $this->OK;
      }
    
       /**
        * Créé une table vide
        * @param $strNomTable Nom de la table à créer
        * @return bool Succès ou non de la requête
        */
      function creeTable($strNomTable) {
          $this->requete = "CREATE TABLE $strNomTable (";
          for($i = 1; $i < func_num_args()-1; $i+=2){
              $this->requete .= func_get_arg($i) . " " . func_get_arg($i+1) . ", ";
          }
          $this->requete .= func_get_arg(func_num_args()-1) . ") Engine=InnoDB";
          $this->OK = mysqli_query($this->cBD, $this->requete);
          return $this->OK;
      }
    
       /**
        * Créé une table avec des colonnes.
        * @param string $strNomTable Nom de la table
        * @param string $strDefinitions Liste de colonnes avec des types
        * @param string $strCles Colonne(s) qui servira de clé primaire
        * @return bool succès ou non de la requête
        */
       function creeTableGenerique($strNomTable, $strDefinitions, $strCles, $binAccumuler = false) {
           if (!$binAccumuler) {
               $this->requete = "";
           }
          $tType = [
              "B" => "Bit(1)",
              "C" => "DECIMAL(%s,%s)",
              "D" => "DATE",
              "E" => "INT",
              "I" => "INT(11) AUTO_INCREMENT",
              "J" => "INT(11)",
              "F" => "CHAR(%s)",
              "M" => "DECIMAL(10,2)",
              "N" => "INT NOT NULL",
              "V" => "VARCHAR(%s)"
          ];
        
           $this->requete .= "CREATE TABLE $strNomTable (";

          $tDefinitions = explode(';',$strDefinitions);
          foreach ($tDefinitions as $strDefinition){
              $tTempoDef = explode(',',$strDefinition);
              if(array_key_exists(substr($tTempoDef[0],0,1),$tType)){
                  $tNbs = explode(".",substr($tTempoDef[0],1));
                  $nb1 = isset($tNbs[0]) ? $tNbs[0] : "";
                  $nb2 = isset($tNbs[1]) ? $tNbs[1] : "";
                  $type = sprintf($tType[substr($tTempoDef[0],0,1)],$nb1,$nb2);
                  $this->requete .= $tTempoDef[1] . " " . $type . ", ";
              }
          }
          $this->requete .= "PRIMARY KEY($strCles)) ENGINE=InnoDB";
           if ($binAccumuler) {
               $this->requete .= ";";
           } else {
               $this->OK = mysqli_query($this->cBD, $this->requete);
           }
          return $this->OK;
      }
    
       /**
        * Ferme la connexion avec la base de données
        */
      function deconnexion() {
          //$this->cBD = mysqli_close($this->cBD);
      }

       /**
        * @return mysql
        */
      static function getBD(){
          return mysql::$BD;
      }

       /**
        * Insère une série d'arguments à une table
        * @param string $strNomTable Nom de la table
        * @return bool succès ou échec de la requête
        */
      function insereEnregistrement($strNomTable) {
          $this->requete = "INSERT INTO $strNomTable VALUES (" . func_get_arg(1);
          for($i = 2; $i < func_num_args(); $i++) {
              $tempo = func_get_arg($i);
              $this->requete .= ",";
              if(is_bool($tempo) || $tempo == "true" || $tempo == "false"){
                  $this->requete .= $tempo ? 1 : 0;
              }elseif (!estNumerique($tempo) && $tempo != ""){
                  $tempo = str_replace("'","''",$tempo);
                  $this->requete .= "'$tempo'";
              }elseif($tempo != ""){
                  $this->requete .= $tempo;
              }else{
                  $this->requete .= '1';
              }
          }
          $this->requete .= ")";
          $this->OK = mysqli_query($this->cBD, $this->requete);
          return $this->OK;

      }

       /**
        * Insère une série d'arguments à une table
        * @param string $strNomTable Nom de la table
        * @param array $tbValeurs Association key-valeurs a inserer
        * @return bool succès ou échec de la requête
        */
       function insereEnregistrementTb($strNomTable, $tbValeurs) {
           $this->requete = "INSERT INTO $strNomTable (";
           foreach ($tbValeurs as $key => $value) {
               $this->requete .= $key . ", ";
           }
           $this->requete = substr($this->requete,0, -2) . ") VALUES ('";
           foreach ($tbValeurs as $key => $value) {
               $this->requete .= $value . "', '";
           }
           $this->requete = substr($this->requete,0, -3) . ")";
           //echo "<br/>$this->requete";
           $this->OK = mysqli_query($this->cBD, $this->requete);
           return $this->OK;

       }
    
       /**
        * Modifie un champ d'une table
        * @param string $strNomTable Nom de la table cible
        * @param string $strNomChamp Nom du champ cible
        * @param string $strNouvelleDefinition Nouvelle définition de colonne
        * @return bool Succès ou Échec de la requête
        */
      function modifieChamp($strNomTable, $strNomChamp, $strNouvelleDefinition) {
          $this->requete = "ALTER TABLE $strNomTable CHANGE $strNomChamp $strNouvelleDefinition";
          $this->OK = mysqli_query($this->cBD, $this->requete);
          return $this->OK;
      }
    
       /**
        * @param string $strNomTable nom de la table
        * @param string $strListeRows liste de colonnes à afficher
        * @param string $strConditions liste de conditions pour la clause WHERE
        * @param string $strORDERBY conditions de la clause ORDER BY
        * @param string $strORDERBY conditions de la clause GROUP BY
        * @return bool|mysqli_result faux si échec, mysqli_result si succès
        */
       function selectionneRow($strNomTable, $strListeRows = "*", $strConditions = "", $strORDERBY = null, $strGROUPBY = null) {
           $this->requete = "SELECT $strListeRows FROM $strNomTable";
           if ($strConditions != "") {
               $this->requete .= " WHERE $strConditions";
           }
        
           if ($strORDERBY) {
               $this->requete .= " ORDER BY $strORDERBY";
           }
        
           if ($strGROUPBY) {
               $this->requete .= " GROUP BY $strGROUPBY";
           }
           $this->OK = mysqli_query($this->cBD, $this->requete);
           return $this->OK;
       }
    
       /**
        * @param string $strNomTable nom de la table
        * @param string $strListeRows liste de colonnes à afficher
        * @param string $strConditions liste de conditions pour la clause WHERE
        * @param string $strTableJoin Table de jointure
        * @param string $strON clause ON
        * @return bool|mysqli_result faux si échec, mysqli_result si succès
        */
       function selectionneRowLJ($strNomTable, $strListeRows, $strTableJoin, $strON, $strConditions = null) {
           $this->requete = "SELECT $strListeRows FROM $strNomTable LEFT JOIN $strTableJoin ON $strON";
        
           if ($strConditions) {
               $this->requete .= " WHERE $strConditions";
           }
        
           $this->OK = mysqli_query($this->cBD, $this->requete);
           return $this->OK;
       }
    
       /**
        * @param string $strNomTable nom de la table
        * @param string $strListeRows liste de colonnes à afficher
        * @param string $strConditions liste de conditions pour la clause WHERE
        * @param string $strTableJoin Table de jointure
        * @param string $strON clause ON
        * @return bool|mysqli_result faux si échec, mysqli_result si succès
        */
       function selectionneRowRJ($strNomTable, $strListeRows, $strTableJoin, $strON, $strConditions = null) {
           $this->requete = "SELECT $strListeRows FROM $strNomTable RIGHT JOIN $strTableJoin ON $strON";
        
           if ($strConditions) {
               $this->requete .= " WHERE $strConditions";
           }
        
           $this->OK = mysqli_query($this->cBD, $this->requete);
           return $this->OK;
       }
       
       /**
        * @param string $strNomTable nom de la table
        * @param string $strListeRows liste de colonnes à afficher
        * @param string $strTableJoin Table de jointure
        * @param string $strON clause ON
        * @param string $strConditions liste de conditions pour la clause WHERE
        * @return bool|mysqli_result faux si échec, mysqli_result si succès
        */
       function selectionneRowIJ($strNomTable, $strListeRows, $strTableJoin, $strON, $strConditions = null) {
           $this->requete = "SELECT $strListeRows FROM $strNomTable INNER JOIN $strTableJoin ON $strON";
        
           if ($strConditions) {
              $this->requete .= " WHERE $strConditions";
          }
        
           $this->OK = mysqli_query($this->cBD, $this->requete);
          return $this->OK;
      }
    
       /**
        * Sélectionne la base de données this->nomBD
        * @return bool échec ou succès de la sélection
        */
      function selectionneBD() {
          $this->OK = mysqli_select_db($this->cBD, $this->nomBD);
          return $this->OK;
      }
    
       /**
        * Supprime les enregistrements de la table qui correspondent à la liste de conditions
        * @param string $strNomTable Nom de la table cible
        * @param string $strListeConditions Liste de condition pour la cause WHEREs
        * @return bool échec ou succès de la requêtes
        */
      function supprimeEnregistrements($strNomTable, $strListeConditions="") {
          $this->requete = "DELETE FROM $strNomTable";
          if($strListeConditions != ""){
              $this->requete .= " WHERE $strListeConditions";
          }
          //echo "<br/><br/>$this->requete";
          $this->OK = mysqli_query($this->cBD, $this->requete);
    
          return $this->OK;
      }
    
       /**
        * supprime une table
        * @param $strNomTable Nom de la table à supprimer
        */
      function supprimeTable($strNomTable) {
          $strRequete = "DROP TABLE $strNomTable";
          $binOK = mysqli_query($this->cBD, $strRequete);
      }
    
    
       function afficheInformationsSurBD()
      {
          /* Si applicable, récupération du nom de la table recherchée */
          $strNomTableRecherchee = "";
          if (func_num_args() == 1) {
              $strNomTableRecherchee = func_get_arg(0);
          }

          /* Variables de base pour les styles */
          $strTable = "border-collapse:collapse;";
          $strCommande = "font-family:verdana; font-size:12pt; font-weight:bold; color:black; border:solid 1px black; padding:3px;";
          $strMessage = "font-family:verdana; font-size:10pt; font-weight:bold; color:red;";
          $strBorduresMessage = "border:solid 1px red; padding:3px;";
          $strContenu = "font-family:verdana; font-size:10pt; color:blue;";
          $strBorduresContenu = "border:solid 1px red; padding:3px;";
          $strTypeADefinir = "color:red;font-weight:bold;";
          $strDetails = "color:magenta;";

          /* Application des styles */
          $sTable = "style=\"$strTable\"";
          $sCommande = "style=\"$strCommande\"";
          $sMessage = "style=\"$strMessage\"";
          $sMessageAvecBordures = "style=\"$strMessage $strBorduresMessage\"";
          $sContenu = "style=\"$strContenu\"";
          $sContenuAvecBordures = "style=\"$strContenu $strBorduresContenu\"";
          $sTypeADefinir = "style=\"$strTypeADefinir\"";
          $sDetails = "style=\"$strDetails\"";

          /* --- Entreposage des noms de table --- */
          $ListeTablesBD = array_column(mysqli_fetch_all(mysqli_query($this->cBD, 'SHOW TABLES')),0);
          $intNbTables = count($ListeTablesBD);

          /* --- Parcours de chacune des tables --- */
          echo "<span $sCommande>Informations sur " . (!empty($strNomTableRecherchee) ? "la table '$strNomTableRecherchee' de " : "") . "la base de données '$this->nomBD'</span><br />";
          $binTablePresente = false;
          for ($i=0; $i<$intNbTables; $i++)
          {
              /* Récupération du nom de la table courante */
              $strNomTable = $ListeTablesBD[$i];
              if (empty($strNomTableRecherchee) || strtolower($strNomTable) == strtolower($strNomTableRecherchee)) {
                  $binTablePresente = true;
                  echo "<p $sMessage>Table no ".strval($i+1)." : ".$strNomTable."</p>";

                  /* Récupération des enregistrements de la table courante */
                  $ListeEnregistrements = mysqli_query($this->cBD, "SELECT * FROM $strNomTable");

                  /* Décompte du nombre de champs et d'enregistrements de la table courante */
                  $NbChamps = mysqli_field_count($this->cBD);
                  $NbEnregistrements = mysqli_num_rows($ListeEnregistrements);
                  echo "<p $sContenu>$NbChamps champs ont été détectés dans la table.<br />";
                  echo "    $NbEnregistrements enregistrements ont été détectés dans la table.</p>";

                  /* Affichage de la structure de table courante */
                  echo "<p $sContenu>";
                  $j=0;
                  $tabNomChamp = array();
                  while ($champCourant = $ListeEnregistrements->fetch_field()) {
                      $intDivAjustement = 1;
                      $tabNomChamp[$j] = $champCourant->name;
                      $strType = $champCourant->type;
                      switch ($strType) {
                          case 1   : $strType = "BOOL"; break;
                          case 3   : $strType = "INTEGER"; break;
                          case 10  : $strType = "DATE"; break;
                          case 12  : $strType = "DATETIME"; break;
                          case 246 : $strType = "DECIMAL"; break;
                          case 253 : $strType = "VARCHAR"; break;
                          case 254 : $strType = "CHAR"; break;
                          default  : $strType = "<span $sTypeADefinir>$strType à définir</span>"; break;
                      }
                      $strLongueur = intval($champCourant->length) / $intDivAjustement;
                      $intDetails = $champCourant->flags;
                      $strDetails = "";
                      if ($intDetails & 1     ) $strDetails .= "[NOT_NULL] ";
                      if ($intDetails & 2     ) $strDetails .= "<span style=\"font-weight:bold;\">[PRI_KEY]</span> ";
                      if ($intDetails & 4     ) $strDetails .= "[UNIQUE_KEY] ";
                      if ($intDetails & 16    ) $strDetails .= "[BLOB] ";
                      if ($intDetails & 32    ) $strDetails .= "[UNSIGNED] ";
                      if ($intDetails & 64    ) $strDetails .= "[ZEROFILL] ";
                      if ($intDetails & 128   ) $strDetails .= "[BINARY] ";
                      if ($intDetails & 256   ) $strDetails .= "[ENUM] ";
                      if ($intDetails & 512   ) $strDetails .= "[AUTO_INCREMENT] ";
                      if ($intDetails & 1024  ) $strDetails .= "[TIMESTAMP] ";
                      if ($intDetails & 2048  ) $strDetails .= "[SET] ";
                      if ($intDetails & 32768 ) $strDetails .= "[NUM] ";
                      if ($intDetails & 16384 ) $strDetails .= "[PART_KEY] ";
                      if ($intDetails & 32768 ) $strDetails .= "[GROUP] ";
                      if ($intDetails & 65536 ) $strDetails .= "[UNIQUE] ";
                      echo ($j+1).". $tabNomChamp[$j], $strType($strLongueur) <span $sDetails>$strDetails</span><br />";
                      $j++;
                  }
                  echo "</p>";

                  /* Affichage des enregistrements composant la table courante */
                  echo "<table $sTable>";
                  echo "<tr>";
                  for ($k=0; $k<$NbChamps; $k++)
                      echo "<td $sMessageAvecBordures>" . $tabNomChamp[$k] . "</td>";
                  echo "</tr>";
                  if (empty($NbEnregistrements)) {
                      echo "<tr>";
                      echo "<td $sContenuAvecBordures colspan=\"$NbChamps\">";
                      echo " Aucun enregistrement";
                      echo "</td>";
                      echo "</tr>";
                  }
                  while ($listeChampsEnregistrement = $ListeEnregistrements->fetch_row()) {
                      echo "<tr>";
                      echo "<tr>";
                      for ($j=0; $j<count($listeChampsEnregistrement); $j++)
                          echo "      <td $sContenuAvecBordures>" . $listeChampsEnregistrement[$j] . "</td>";
                      echo "   </tr>";
                  }
                  echo "</table>";
                  $ListeEnregistrements->free();
              }
          }
          if (!$binTablePresente)
              echo "<p $sMessage>Aucune table !</p>";
      }
    
       /**
        * @param $strNomTable
        * @param $strUpdates
        * @param $strCondition
        * @return bool|mysqli_result
        */
       function modifieEnregistrements($strNomTable, $strUpdates, $strCondition) {
           $this->requete = "UPDATE $strNomTable SET $strUpdates WHERE $strCondition";
           $this->OK = mysqli_query($this->cBD, $this->requete);
           log_fichier($this->requete);
           return $this->OK;
       }
    
       /**
        * @param $strNomTable
        * @return bool|mysqli_result
        */
       function retourneClesPrimaires($strNomTable) {
           $this->requete = "SHOW KEYS FROM $strNomTable WHERE Key_name = 'PRIMARY'";
           $this->OK = mysqli_query($this->cBD, $this->requete);
           return $this->OK;
       }
    
       function ajouteFK($strNomTablePrimaire, $strColonnePrimaire, $strNomTableRef, $strColonneRef, $binAccumuler = false) {
           if (!$binAccumuler) {
               $this->requete = "";
           }
           $this->requete .= "ALTER TABLE $strNomTablePrimaire " .
               "ADD CONSTRAINT FK_$strNomTablePrimaire" . "_" . "$strNomTableRef " .
               "FOREIGN KEY($strColonnePrimaire) " .
               "REFERENCES $strNomTableRef($strColonneRef)";
           if ($binAccumuler) {
               $this->requete .= ";";
           } else {
               $this->OK = $this->cBD->query($this->requete);
           }
        
           return $this->OK;
       }
    
       function ajouteFKCasc($strNomTablePrimaire, $strColonnePrimaire, $strNomTableRef, $strColonneRef, $binAccumuler = false) {
           if (!$binAccumuler) {
               $this->requete = "";
           }
           $this->requete .= "ALTER TABLE $strNomTablePrimaire " .
               "ADD CONSTRAINT FK_$strNomTablePrimaire" . "_" . "$strNomTableRef " .
               "FOREIGN KEY($strColonnePrimaire) " .
               "REFERENCES $strNomTableRef($strColonneRef) ON DELETE CASCADE";
           if ($binAccumuler) {
               $this->requete .= ";";
           } else {
               $this->OK = $this->cBD->query($this->requete);
           }
        
           return $this->OK;
       }
    
       function ajouteFKNull($strNomTablePrimaire, $strColonnePrimaire, $strNomTableRef, $strColonneRef, $binAccumuler = false) {
           if (!$binAccumuler) {
               $this->requete = "";
           }
           $this->requete .= "ALTER TABLE $strNomTablePrimaire " .
               "ADD CONSTRAINT FK_$strNomTablePrimaire" . "_" . "$strNomTableRef " .
               "FOREIGN KEY($strColonnePrimaire) " .
               "REFERENCES $strNomTableRef($strColonneRef) ON DELETE SET NULL";
           if ($binAccumuler) {
               $this->requete .= ";";
           } else {
               $this->OK = $this->cBD->query($this->requete);
           }
        
           return $this->OK;
       }
    
       function insereEnregistrementsTableau($strNomTable, $tenregistrements, $binAccumuler = false) {
           if (!$binAccumuler) {
               $this->requete = "";
           }
        
           $this->requete .= "INSERT INTO $strNomTable VALUES ";
           for ($i = 0; $i < sizeof($tenregistrements); $i++) {
               $this->requete .= "(";
               if (in_array($strNomTable, ["document", "utilisateur"]))
                   $this->requete .= "DEFAULT, ";
               for ($j = 0; $j < sizeof($tenregistrements[$i]); $j++) {
                   $tempo = $tenregistrements[$i][$j];
                   if (is_bool($tempo) || $tempo == "true" || $tempo == "false") {
                       $this->requete .= $tempo ? 1 : 0;
                   } elseif (!estNumerique($tempo) && $tempo != "") {
                       $tempo = str_replace("'", "''", $tempo);
                       $this->requete .= "'$tempo'";
                   } elseif ($tempo != "") {
                       $this->requete .= $tempo;
                   } else {
                       $this->requete .= '1';
                   }
                   $this->requete .= ",";
               }
               $this->requete = substr($this->requete, 0, strlen($this->requete) - 1);
               $this->requete .= "),";
           }
           $this->requete = substr($this->requete, 0, strlen($this->requete) - 1);
           if ($binAccumuler)
               $this->requete .= ";";
           else
               $this->OK = mysqli_query($this->cBD, $this->requete);
           return $this->OK;
       }
   }
?>