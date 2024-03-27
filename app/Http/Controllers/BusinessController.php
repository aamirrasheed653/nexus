<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Business;

class BusinessController extends Controller
{
    public function index()
    {
        return Business::with('users')->get();
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'type' => 'required'

        ]);

        return Business::create([...$data, 'user_id' => auth()->id()]);

    }
}
