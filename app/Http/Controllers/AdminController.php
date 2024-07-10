<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Artisan;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function updateSystem()
    {
        Artisan::call('system:update');
        return redirect()->back()->with('success', 'System updated successfully');
    }
}
