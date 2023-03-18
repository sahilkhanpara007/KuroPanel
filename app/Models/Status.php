<?php

namespace App\Models;

use CodeIgniter\Model;

class Status extends Model
{
    /*=================================================================*/
    
    protected $table      = 'onoff';
    protected $allowedFields = ['modname','status','myinput'];
    
}