<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SystemController extends Controller
{
    public function update()
    {
        // Your system update logic here

        return redirect()->route('home')->with('success', 'System updated successfully');
    }
}
