<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Entry;

class EntryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application list.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;

        $listEntry = Entry::where('user_id', $user_id)->orderBy('id', 'desc')->get();
        return view('list', 'user');
    }

    public function post(Request $request){
        $value = $request->value;

        $user_id = Auth::user()->id;

        $entry = new Entry;
        $entry->value = $value;
        $entry->user_id = $user_id;
        $entry->save();


        $array = array(
            '1' => 'Значение 1', 
            '2' => 'Значение 2', 
            '3' => 'Значение 3', 
            '4' => 'Значение 4', 
            '5' => 'Значение 5',
            'value' => $request->value,
            'status' => 'ok',
            'id' => $entry->id 
        );
         
        $json = json_encode($array);
        return $json;
    }

    public function put(Request $request){
        $id = $request->id;
        $value = $request->value;
        
        $user_id = Auth::user()->id;

        $array = array(
            '1' => 'Значение 1', 
            '2' => 'Значение 2', 
            '3' => 'Значение 3', 
            '4' => 'Значение 4', 
            'user_id' => $user_id,
            'value' => $request->value,
            'status' => 'ok'
        );
         
        $json = json_encode($array);
        return $json;
    }

    public function delete(Request $request){
        $array = array(
            '1' => 'Значение 1', 
            '2' => 'Значение 2', 
            '3' => 'Значение 3', 
            '4' => 'Значение 4', 
            '5' => 'Значение 5',
            'value' => $request->value,
            'status' => 'ok'
        );
         
        $json = json_encode($array);
        return $json;
    }
   
}
