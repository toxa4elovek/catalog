<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;

/**
 * Контроллер должностей
 * Class PositionsController
 * @package App\Http\Controllers
 */
class PositionsController extends Controller
{
    /**
     * Поиск должности по названию
     * @param Request $request
     * @return int|string
     */
    public function positions_search(Request $request)
    {
        if($request->ajax() && !empty($request->get('q'))) {
            $q = $request->get('q');
            $positions = Position::where('name', 'like', "%$q%")->get();
            return json_encode($positions);
        }else return 0;
    }
}
