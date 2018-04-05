<?php
/**
 * Created by PhpStorm.
 * User: Simon Boyer
 * Date: 05/04/18
 * Time: 00:28
 */

abstract class ModelState{
    const Added = 'Added';
    const Deleted = 'Deleted';
    const Modified = 'Modified';
    const Same = 'Same';
    const Invalid = 'Invalid';
}