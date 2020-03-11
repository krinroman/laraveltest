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

        $listEntry = Entry::where('user_id', $user_id)->orderBy('id', 'asc')->get();
        return view('list', compact('listEntry'));
    }

    public function post(Request $request){
        $value = $request->value;

        $user_id = Auth::user()->id;

        $entry = new Entry;
        $entry->value = $value;
        $entry->user_id = $user_id;
        $entry->save();

        return "ok";
    }

    public function put(Request $request){
        $id = $request->id;
        $value = $request->value;

        $user_id = Auth::user()->id;

        $entry = Entry::find($id);
        if($entry->user_id !== $user_id){
            return "Error: Доступ запрещен";
        }
        $entry->value = $value;
        $entry->save();

        return "ok";
    }

    public function delete(Request $request){
        $id = $request->id;

        $user_id = Auth::user()->id;

        $entry = Entry::find($id);
        if($entry->user_id !== $user_id){
            return "Error: Доступ запрещен";
        }
        $entry->delete();
        

        return "ok";
    }
   
}
