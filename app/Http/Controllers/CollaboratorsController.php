<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCollaborator;
use App\Models\Collaborator;
use App\Models\FileUpload;
use Illuminate\Http\Request;

/**
 * Class CollaboratorsController
 * @package App\Http\Controllers
 */
class CollaboratorsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Метод вывода всех сотрудников с возможностью сортировки и поиска
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public function index(Request $request)
    {
        $data = Collaborator::prepareData($request->all());
        $collaborators = Collaborator::with('position');

        if(isset($data['created_at'])) {
            $collaborators = $collaborators->whereBetween('created_at', $data['created_at']);
            unset($data['created_at']);
        }

        if (isset($data['sort'])) {
            $collaborators = $collaborators->orderBy($data['sort'][0], $data['sort'][1]);
            unset($data['sort']);
        }

        $collaborators = $collaborators->where($data)->paginate(50);
        $pagination = $collaborators->links();

        if ($request->ajax())
        {
            $table = view('collaborators.partials.collaborators_table', ['collaborators' => $collaborators])->render();
            $pagination = view('collaborators.partials.pagination', ['pagination' => $pagination])->render();
            return json_encode(['table' => $table, 'pagination' => $pagination]);
        }

        return view('collaborators.index', [
            'collaborators' => $collaborators,
            'pagination' => $pagination,
            ]);
    }

    /**
     * Метод для создания сотрудника
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        return view('collaborators.create');
    }

    /**
     * Метод обновления данных сотрудника
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update(Request $request, $id)
    {
        $collaborator = Collaborator::with('position')->where(['id' => $id])->first();
        $collaborator->boss = $collaborator->getBoss();

        return view('collaborators.update', ['collaborator' => $collaborator]);
    }

    /**
     * Метод поиска начальника по имени
     * @param Request $request
     * @return int|string
     */
    public function boss_search(Request $request)
    {
        if($request->ajax() && !empty($request->get('q'))) {
            $q = $request->get('q');
            $collaborators = Collaborator::with('position')->where('name', 'like', "%$q%")->get();
            return json_encode($collaborators);
        }else return 0;
    }

    /**
     * Метод для сохранения сотрудника
     * @param StoreCollaborator $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function save(StoreCollaborator $request)
    {
        $data = $request->all();

        if(!empty($request->file('img'))) {
            $name = $request->file('img')->getClientOriginalName();
            $fileName = FileUpload::getFileName($name);
            $path = FileUpload::getPath($name);
            $request->file('img')->move(public_path($path), $fileName);
            $data['img'] = str_replace('\\', '/', $path . $fileName);
        }

        if($data['img'] === null) {
            unset($data['img']);
        }

        unset($data['_token']);
        $result = Collaborator::updateOrCreate(['id' => $data['id']], $data);

        if ($result)
            return redirect('collaborators/view/' . $result->id);
        else
            return redirect('404');
    }

    /**
     * Просмотр данных о сотруднике
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view($id)
    {
        $collaborator = Collaborator::find($id);

        if(!empty($collaborator)) {
            $collaborator->boss = $collaborator->getboss();

            return view('collaborators.view', ['collaborator' => $collaborator]);
        }return view('404');

    }

    /**
     * Удаление сотрудника
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete(Request $request, $id)
    {
        if ($collaborator = Collaborator::find($id)) {
            $collaborator->delete();
        }

        return redirect('/collaborators');
    }


}