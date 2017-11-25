<?php

namespace App\Http\Controllers;

use App\Models\Collaborator;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class MainController extends Controller
{
    public function collaborator()
    {
        $collaborators = Collaborator::with('position')->whereIn('boss_id', [0, 1])->get();
        $collaborators = Collaborator::getTree($collaborators);
//        dd($collaborators);
        return view('main/index', ['collaborators' => $collaborators]);
    }

    public function more_child(Request $request)
    {
        $collaborators = [];
        if ($request->isMethod('post')){
            $id = Input::get('id');
            $collaborators = Collaborator::with('position')->where('boss_id',$id)->get();

            if(count($collaborators) > 0){
                return view('main.partials.items', ['collaborators' => $collaborators]);
            }
        }return 0;

    }
}
