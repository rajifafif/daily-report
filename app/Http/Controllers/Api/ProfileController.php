<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return null;
    }

    public function update(Request $request)
    {
        return UserRequest::make($user);
    }
}
