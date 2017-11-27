<?php

namespace App\Http\Controllers;

use App\Models\Collaborator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

/**
 * Class MainController
 * @package App\Http\Controllers
 */
class MainController extends Controller
{
    /**
     * Список всех сотрудников
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function collaborator()
    {
        $collaborators = Collaborator::with('position')->whereIn('boss_id', [0, 1])->get();
        $collaborators = Collaborator::getTree($collaborators);

        return view('main/index', ['collaborators' => $collaborators]);
    }

    /**
     * Подгрузка подчиненных
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|int
     */
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
