<?php

namespace splattner\myvbc\models;
use splattner\framework\Model;

// no direct access
defined( '_MYVBC' ) or die( 'Restricted access' );


/**
 * Created by PhpStorm.
 * User: sebastianplattner
 * Date: 25.08.16
 * Time: 22:46
 */
class MOrderitem extends Model {
    public $table = 'orderitem';
    public $pk = 'orderitemid';
}