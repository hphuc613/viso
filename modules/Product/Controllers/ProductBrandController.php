<?php

namespace Modules\Product\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Base\Models\Status;
use Modules\Product\Models\ProductBrand;
use Modules\Product\Requests\ProductBrandRequest;

class ProductBrandController extends Controller{

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
        $data   = ProductBrand::query();
        if(isset($request->name)){
            $data = $data->where('name', 'LIKE', '%' . $request->name . '%');
        }
        $data = $data->orderBy("name")->paginate(20);

        return view("Product::backend.product_brand.index", compact("data", 'filter'));
    }

    /**
     * @param Request $request
     * @return Factory|View
     */
    public function getCreate(Request $request){
        $statuses = Status::getStatuses();

        return view("Product::backend.product_brand.form", compact("statuses"));
    }

    /**
     * @param ProductBrandRequest $request
     * @return RedirectResponse
     */
    public function postCreate(ProductBrandRequest $request){
        ProductBrand::query()->create($request->all());
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
        $data     = ProductBrand::query()->find($id);
        return view("Product::backend.product_brand.form", compact("data", "statuses"));
    }

    /**
     * @param ProductBrandRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function postUpdate(ProductBrandRequest $request, $id){
        ProductBrand::query()->find($id)->update($request->all());
        $request->session()->flash('success', trans('Updated successfully.'));

        return back();
    }

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function delete(Request $request, $id){
        ProductBrand::query()->find($id)->delete();
        $request->session()->flash('success', trans('Deleted successfully.'));

        return back();
    }

    /**
     * @param Request $request
     * @return Factory|View
     */
    public function getCreateRealtime(Request $request){
        $statuses = Status::getStatuses();

        return view("Product::backend.product_brand.form", compact("statuses"));
    }

    /**
     * @param ProductBrandRequest $request
     * @return array
     */
    public function postCreateRealtime(ProductBrandRequest $request){
        try{
            ProductBrand::query()->create($request->all());
        }catch(Exception $e){
            return [
                'status' => 400,
                'msg'    => trans('Something went wrong.'),
                'data'   => null
            ];
        }
        $data  = ProductBrand::query()->where('status', Status::STATUS_ACTIVE)->orderBy('name')->get();
        $array = [
            [
                'id'   => '',
                'text' => trans('Select')
            ]
        ];

        foreach($data as $item){
            $array[] = ['id' => $item->id, 'text' => $item->name];
        }

        return [
            'status' => 200,
            'msg'    => trans('Created successfully.'),
            'data'   => json_encode($array)
        ];
    }
}
