<?php
/**
 * Created by PhpStorm.
 * User: Simon Boyer
 * Date: 05/04/18
 * Time: 00:28
 */

abstract class ModelState{
    const Added = 0;
    const Deleted = 1;
    const Modified = 2;
    const Same = 3;
    const Invalid = 4;
}