<?php

namespace Modules\Store\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Base\Models\Status;
use Modules\Store\Requests\StoreRequest;
use Modules\Store\Models\Store;

class StoreController extends Controller{

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(){
        # parent::__construct();
    }


    /**
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request){
        $data   = Store::query();
        if(isset($request->name)){
            $data = $data->where('name', 'LIKE', '%' . $request->name . '%');
        }
        $data = $data->orderBy("name")->paginate(20);

        return view("Store::index", compact("data"));
    }

    /**
     * @param Request $request
     * @return Factory|View
     */
    public function getCreate(Request $request){
        $statuses = Status::getStatuses();

        return view("Store::form", compact("statuses"));
    }

    /**
     * @param StoreRequest $request
     * @return RedirectResponse
     */
    public function postCreate(StoreRequest $request){
        Store::query()->create($request->all());
        $request->session()->flash('success', trans('Created successfully.'));

        return back();
    }

    /**
     * @param Request $request
     * @param $id
     * @return Factory|View
     */
    public function getUpdate(Request $request, $id){
        $statuses = Status::getStatuses();
        $data     = Store::query()->find($id);
        return view("Store::form", compact("data", "statuses"));
    }

    /**
     * @param StoreRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function postUpdate(StoreRequest $request, $id){
        Store::query()->find($id)->update($request->all());
        $request->session()->flash('success', trans('Updated successfully.'));

        return back();
    }

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function delete(Request $request, $id){
        Store::query()->find($id)->delete();
        $request->session()->flash('success', trans('Deleted successfully.'));

        return back();
    }
}
