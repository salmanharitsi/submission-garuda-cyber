<?php

namespace App\Http\Controllers;

class AdminController
{
    public function get_dashboard_admin()
    {
        return view('admin.dashboard');
    }
}
