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
    public function index(Request $request)
    {
        $sort_field = "id";
        $sort_order = "asc";
        $sort_id = 0;

        if($request->has("sortField")){
            $input_sort_field = strtolower($request->get("sortField"));
            if($input_sort_field === "value"){
                $sort_field = $input_sort_field;
                $sort_id = 2;
            }
        }
        if($request->has("sortOrder")){
            $input_sort_order = strtolower($request->get("sortOrder"));
            if($input_sort_order === "desc"){
                $sort_order = $input_sort_order;
                $sort_id += 1;
            }
        }

        $radioBoxList = [
            0 => ["name" => "По возрастанию номера", "checked" => false],
            1 => ["name" => "По убыванию номера", "checked" => false],
            2 => ["name" => "По алфавиту", "checked" => false],
            3 => ["name" => "В обратном алфавитном порядке", "checked" => false]
        ];

        $radioBoxList[$sort_id]["checked"] = true;


        $user_id = Auth::user()->id;

        $listEntry = Entry::where('user_id', $user_id)->orderBy($sort_field, $sort_order)->get();
        return view('list', compact('listEntry', 'radioBoxList'));
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
