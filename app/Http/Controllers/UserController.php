<?php

namespace App\Http\Controllers;

class UserController
{
    public function get_dashboard_user()
    {
        return view('user.dashboard');
    }
}
