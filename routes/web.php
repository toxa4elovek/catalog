<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'MainController@collaborator');
Route::post('/more-child', 'MainController@more_child');

Route::get('blade', function () {
    $file = json_decode(file_get_contents(public_path('collaborators3.json')), true);
    $id = [];
    $i = 1;
    $positions =[
        /*1 => [1],
        2 => [2,3,4,5,6,7,8,9,10,11,12,13,14,34,35,36,37],*/
            1 => [2,3,4,5,6,7,8,9,10,11,12,13,14,34,35,36,37],
            2 => [41,17,15],
            3 => [76, 38, 18, 22],
            4 => [33],
            5 => [16, 57],
            6 => [25,27],
            7 => [66],
            8 => [55, 51, 31],
            9 => [56, 40, 46, 61, 39, ],
            12 => [28],
            14 => [20, 21, 26, 50, 58,68,71],
            34 => [60],
            35 => [70, 43, 44],
            36 => [45],
            37 => [42, 59],
            41 => [73],
            18 => [19, 24],
            22 => [29,30,32],
            33 => [62, 63],
            51 => [75, 54],
            46 => [47, 48, 49],
            40 => [79],
            28 => [77],
            45 => [72],
            42 => [65,52,53],
            19 => [23],
            62 => [64],
            54 => [61],
            48 => [78],
            52 => [69],
            53 => [74],
            64 => [80],
            61 => [67],
    ];

    $result = $file;

        foreach ($positions as $boss_position =>  $position) {

            $boss_id = array_column(array_filter($result, function ($item) use ($boss_position){
                if($item['position_id'] == $boss_position) {
                    return true;
                }return false;
            }), 'id');

            $result = array_map(function ($item) use ($position, $boss_id) {
                if(in_array($item['position_id'], $position)) {
                    $key = rand(0, count($boss_id) - 1);

                    //dump($boss_id, $key);
                    $item['boss_id'] = $boss_id[$key];
                    if(!isset($item['pay'])){
                        $item['pay'] = rand(50000, 100000);
                    }
                    return $item;
                }else{
                    //dd($boss_id, $position);
                    return $item;
                }
            }, $result);
        }

       // dd($file);

        $result = array_map(function ($item) {
            if($item['boss_id'] == 1) {
                dump($item);
            }
        }, $file);

        //dd($result);
        /*if($key > 13 && $key < 18) {

            $boss_id = 1;
            $position_id = 33 + $i;
            $i++;
            $position = [
                'id' => $position['id'],
                'name' => $position['name'],
                'created_at' => $position['created_at'],
                'boss_id' => $boss_id,
                'position_id' => $position_id
            ];
        }*/

        /*if ($key < 14) {
            $position['position_id'] = $key + 1;
        }*/
        /*if(in_array($position['position_id'], [56,39,40,46,61])){
            $boss_id = rand(0, count($arr) - 1);
            $position['boss_id'] = $arr[$boss_id];
            $id[] = $position['id'];
            $position['boss_id'] = 9;
            dump($position);
        }*/

        /*if(in_array($position['position_id'], [29,30,32])){
            $position['boss_id'] = 22;
            //dump($position);
        }*/
        /*if($key < 15000){
            $position['position_id'] = rand(14, 33);
        }else $position['position_id'] = rand(37, 80);*/

        //dd($position);
    //dd($id);
    //$a = implode(', ', $id);dd($a);
    //die();
    //file_put_contents(public_path('collaborators3.json'), json_encode($result));
    //dd($file);
    return 'Hello';
});

Route::get('test', function(){
   $data = json_decode(file_get_contents(public_path('collaborators3.json')), true);

    //$arr = array_slice( $data, 0, 10000);
    $collect = collect($data);
    $sorted = $collect->sortBy('boss_id');
    $sorted->values()->all();
    $start = microtime(true);
    //$result = \App\Models\Collaborator::getTree($sorted);
    echo "Время выполнения скрипта - ". microtime(true) - $start;;
    return view('main.index', ['collaborators' => $result]);

});

Route::get('blade2', function () {
    $file = json_decode(file_get_contents(public_path('positions.json')), true);
    $result = [];
    foreach ($file as $key => &$position) {
        echo $position['id'] . ' = ' . $position['name'] . '<br>';
    }
    //dd($id);
    die();
    //file_put_contents(public_path('collaborators.json'), json_encode($file));
    //dd($file);
    return 'Hello';
});

Route::get('positions', function() {
    $data = json_decode(file_get_contents(public_path('positions.json')), true);

    foreach ($data as $key => $item) {
        echo $item['id'] . ' = ' . $item['name'] . '<br>';
    }
});