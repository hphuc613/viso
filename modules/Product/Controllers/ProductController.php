<?php

namespace Modules\Product\Controllers;

use App\AppHelpers\Helper;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Base\Models\Status;
use Modules\Product\Models\Attribute;
use Modules\Product\Models\AttributeOption;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductBrand;
use Modules\Product\Models\ProductCategory;
use Modules\Product\Requests\ProductRequest;
use Modules\Store\Models\Store;

class ProductController extends Controller{

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
        $categories = ProductCategory::getArray();
        $brands     = ProductBrand::getArray();
        $statuses   = Status::getStatuses();
        $data       = Product::filter($request->all())->orderBy("name")->paginate(20);
        $stores     = Store::getArray();

        return view("Product::backend.product.index", compact("data", "stores", "categories", "brands", "statuses"));
    }

    /**
     * @param Request $request
     * @return Factory|View
     */
    public function getCreate(Request $request){
        $categories = ProductCategory::getArray();
        $brands     = ProductBrand::getArray();
        $statuses   = Status::getStatuses();
        $attributes = Attribute::query()->get();
        $stores     = Store::getArray();

        return view("Product::backend.product.create", compact("categories", "stores", "brands", "statuses", "attributes"));
    }

    /**
     * @param ProductRequest $request
     * @return RedirectResponse
     */
    public function postCreate(ProductRequest $request){
        $data = $request->all();
        unset($data['image']);
        unset($data['attr_option']);
        try{
            $attr_option = $request->attr_option;
            $product     = new Product($data);
            $product->save();
            if($request->hasFile('image')){
                $image          = $request->image;
                $image_name     = time() . '_' . $image->getClientOriginalName();
                $upload_address = 'Product/' . $product->id . '-' . $product->sku;
                $product->image = Helper::storageFile($image, $image_name, $upload_address);
            }
            $product->save();
            $product->attributeOptions()->sync($attr_option);
            $request->session()->flash('success', trans('Created successfully.'));

        }catch(Exception $exception){
            $request->session()->flash('danger', trans('Created Fail.'));
        }

        return redirect()->route('get.product.list');
    }

    /**
     * @param Request $request
     * @return Factory|View
     */
    public function getUpdate(Request $request, $id){
        $data       = Product::query()->find($id);
        $categories = ProductCategory::getArray();
        $brands     = ProductBrand::getArray();
        $statuses   = Status::getStatuses();
        $attributes = Attribute::query()->get();
        $stores     = Store::getArray();

        return view("Product::backend.product.update", compact("data", "stores", "categories", "brands", "statuses", "attributes"));
    }

    /**
     * @param ProductRequest $request
     * @return RedirectResponse
     */
    public function postUpdate(ProductRequest $request, $id){
        $data        = $request->all();
        $attr_option = $request->attr_option;
        unset($data['attr_option']);
        $product       = Product::query()->find($id);
        $data['image'] = str_replace($product->sku, $request->sku, $product->image);

        $upload_address     = 'Product/' . $product->id . '-' . $request->sku;
        $upload_address_old = 'Product/' . $product->id . '-' . $product->sku;
        if($upload_address !== $upload_address_old && file_exists($upload_address_old)){
            rename('storage/upload/' . $upload_address_old, 'storage/upload/' . $upload_address); //Change file name when update sku
        }
        if($request->hasFile('image')){
            $image = $request->image;
            if(file_exists('storage/upload/' . $upload_address_old)){
                unlink($product->image);
            }
            $image_name    = time() . '_' . $image->getClientOriginalName();
            $data['image'] = Helper::storageFile($image, $image_name, $upload_address);
        }
        $product->update($data);
        $product->attributeOptions()->sync($attr_option);
        $request->session()->flash('success', trans('Updated successfully.'));

        return redirect()->route('get.product.update', $product->id);
    }

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function delete(Request $request, $id){
        $data = Product::query()->find($id)->delete();
        $data->delete();
        $request->session()->flash('success', trans('Deleted successfully.'));

        return back();
    }

    /**
     * @param Request $request
     * @return string
     */
    public function addAttributeOption(Request $request){
        $option_ids      = explode(',', $request->option_ids);
        $options         = AttributeOption::query()->whereIn('id', $option_ids)->get();
        $option_selected = AttributeOption::query()->whereNotIn('id', $option_ids)->get();

        return view('Product::backend.product.add_attribute_option', compact('options'))->render();
    }
}
