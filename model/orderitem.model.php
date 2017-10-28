<?php

namespace splattner\myvbc\models;

use splattner\framework\Model;

// no direct access
defined('_MYVBC') or die('Restricted access');


class MOrderitem extends Model
{
    public $table = 'orderitem';
    public $pk = 'orderitemid';
}
