<?php
    /**
     * Created by PhpStorm.
     * User: antoi
     * Date: 2018-04-04
     * Time: 12:45 AM
     */
    
    class EditDocumentsController
    {
        function editDocuments()
        {
            return new View();
        }
        function selection()
        {
            return new View(null, "Views/EditDocuments/EditDocumentsView.php");
        }
    }