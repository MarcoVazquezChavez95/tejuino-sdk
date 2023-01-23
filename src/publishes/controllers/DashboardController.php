<?php

namespace App\Http\Controllers\Admin;

use AdminController;

class DashboardController extends AdminController
{

    public function __construct()
    {
        $this->middleware('admin');
        $this->section = 'Dashboard';
    }

    public function index()
    {
        return $this->view('dashboard.index');
    }

}
