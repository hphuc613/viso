<?php

namespace Modules\Product\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Translation\Translator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Base\Models\Status;
use Modules\Product\Models\Attribute;
use Modules\Product\Models\AttributeOption;
use Modules\Product\Requests\AttributeOptionRequest;
use Modules\Product\Requests\AttributeRequest;

class AttributeController extends Controller{

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
        $filter = $request->all();
        $data   = Attribute::query();
        if(isset($request->name)){
            $data = $data->where('name', 'LIKE', '%' . $request->name . '%');
        }
        $data = $data->orderBy("name")->paginate(20);

        return view("Product::backend.attribute.index", compact("data", 'filter'));
    }

    /**
     * @param Request $request
     * @return Factory|View
     */
    public function getCreate(Request $request){
        $statuses = Status::getStatuses();

        return view("Product::backend.attribute.form", compact("statuses"));
    }

    /**
     * @param AttributeRequest $request
     * @return RedirectResponse
     */
    public function postCreate(AttributeRequest $request){
        Attribute::query()->create($request->all());
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
        $data     = Attribute::query()->find($id);
        $options  = AttributeOption::query()->where('attribute_id', $id)->paginate(10);

        return view("Product::backend.attribute.update", compact("data", "options", "statuses"));
    }

    /**
     * @param AttributeRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function postUpdate(AttributeRequest $request, $id){
        Attribute::query()->find($id)->update($request->all());
        $request->session()->flash('success', trans('Updated successfully.'));

        return back();
    }

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function delete(Request $request, $id){
        Attribute::query()->find($id)->delete();
        $request->session()->flash('success', trans('Deleted successfully.'));

        return back();
    }

    /**
     * @param Request $request
     * @param $attribute_id
     * @return array|Translator|Factory|View|string|null
     */
    public function getCreateOption(Request $request, $attribute_id){
        $statuses  = Status::getStatuses();
        $attribute = Attribute::query()->find($attribute_id);
        if(empty($attribute)){
            return trans('Something went wrong');
        }

        return view("Product::backend.attribute.form_option", compact("attribute", "statuses"));
    }

    /**
     * @param AttributeOptionRequest $request
     * @param $attribute_id
     * @return RedirectResponse
     */
    public function postCreateOption(AttributeOptionRequest $request, $attribute_id){
        AttributeOption::query()->create($request->all());
        $request->session()->flash('success', trans('Created successfully.'));

        return back();
    }

    /**
     * @param Request $request
     * @param $id
     * @return array|Translator|Factory|View|string|null
     */
    public function getUpdateOption(Request $request, $id){
        $statuses = Status::getStatuses();
        $data     = AttributeOption::query()->find($id);
        if(empty($data)){
            return trans('Something went wrong');
        }

        return view("Product::backend.attribute.form_option", compact("data", "statuses"));
    }

    /**
     * @param AttributeOptionRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function postUpdateOption(AttributeOptionRequest $request, $id){
        AttributeOption::query()->find($id)->update($request->all());
        $request->session()->flash('success', trans('Updated successfully.'));

        return back();
    }

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function deleteOption(Request $request, $id){
        AttributeOption::query()->find($id)->delete();
        $request->session()->flash('success', trans('Deleted successfully.'));

        return back();
    }
}
