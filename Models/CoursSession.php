<?php
/**
 * Created by PhpStorm.
 * User: Simon Boyer
 * Date: 05/04/18
 * Time: 18:21
 */

class CoursSession extends ModelBinding
{

    public $session;
    public $sigle;
    public $utilisateur;

    public function __construct(array $properties = array(), $binAjout = false)
    {
        parent::__construct($properties, $binAjout);
    }
}