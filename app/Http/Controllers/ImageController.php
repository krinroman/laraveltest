<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImageController extends Controller
{
    public function upload(Request $request){
        $user_id = Auth::user()->id;
        $path = $request->file('image')->storeAs('images', "avatar_user_{$user_id}.jpg", 'public');    
        return "ok";
    }
}
