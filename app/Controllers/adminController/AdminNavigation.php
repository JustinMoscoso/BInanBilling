<?php

namespace App\Controllers\adminController;

use App\Controllers\BaseController;


class AdminNavigation extends BaseController
{
    public function index()
    {
        return view('adminUI/addEmployee');
    }


}