<?php
    /**
     * Created by PhpStorm.
     * User: antoi
     * Date: 2018-04-06
     * Time: 11:04 AM
     */
    
    abstract class EnumEtatsLogin
    {
        const LOGIN_FAILED = 0;
        const UTILISATEUR_ET_MOT_DE_PASSE_VIDE = 1;
        const MOT_DE_PASSE_VIDE = 2;
        const UTILISATEUR_VIDE = 3;
        const AUCUN_POST = 4;
    }