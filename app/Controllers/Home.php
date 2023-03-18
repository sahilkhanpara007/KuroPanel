<?php

namespace App\Controllers;

use App\Models\Server;
use App\Models\Status;
use CodeIgniter\Controller;



class Home extends BaseController
{

	public function index()
	{
	    echo view('New');
	}
}
