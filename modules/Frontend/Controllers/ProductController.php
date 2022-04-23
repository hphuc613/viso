<?php

namespace Modules\Frontend\Controllers;

use App\AppHelpers\Helper;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\Base\Controllers\BaseController;
use Modules\Feedback\Models\Feedback;
use Modules\Frontend\Models\Product;
use Modules\Order\Models\OrderDetail;

class ProductController extends BaseController {
    /**
     * @var Guard|StatefulGuard
     */
    private $auth;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct() {
        # parent::__construct();
        $this->auth = Auth::guard('web');
    }

    /**
     * @param Request $request
     * @return Factory|View
     */
    public function productListing(Request $request) {
        $data               = Product::query()->with('category');
        $product_recentlies = [];
        if ($request->session()->has('product_recently')) {
            $product_recentlies = $request->session()->get('product_recently');
        }

        if (isset($request->cate)) {
            if ($request->cate === "best-seller") {
                $ids = OrderDetail::query()
                                  ->select('product_id', DB::raw('SUM(quantity)  AS sum_qty'))
                                  ->groupBy('product_id')
                                  ->orderBy('sum_qty', 'desc')
                                  ->limit(8)
                                  ->pluck('product_id')->toArray();

                $data = $data->whereIn('id', $ids);
            } else {
                $data = $data->whereHas('category', function ($qc) use ($request) {
                    return $qc->where('key_slug', $request->cate);
                });
            }
        }

        if (isset($request->key_search)) {
            $data = $data->where('name', 'LIKE', '%' . $request->key_search . '%');
        }


        $data = $data->paginate(12);

        return view('Frontend::product.product_listing', compact('data', 'product_recentlies'));
    }

    /**
     * @param Request $request
     * @param $key_slug
     * @return Factory|View|RedirectResponse
     */
    public function productDetail(Request $request, $key_slug) {
        $data            = Product::query()->with(['feedback', 'category', 'capacities'])->where('key_slug', $key_slug)->first();
        $feedback_filter = Feedback::getFilter();
        if (!empty($data)) {
            Product::storeProductRecently($data);
            $product_recentlies = $request->session()->get('product_recently');
            $product_relate     = $data->category->products->where('id', '<>', $data->id)->take(4);

            $feedback = $data->feedback;
            if (isset($request->feedback_filter)) {
                if ($request->feedback_filter === Feedback::HIGH_STARS) {
                    $feedback = $feedback->sortByDesc('vote');
                } elseif ($request->feedback_filter === Feedback::TIME) {
                    $feedback = $feedback->sortByDesc('created_at');
                } else {
                    $feedback = $feedback->sortByDesc('image');
                }
            } else {
                $feedback = $feedback->sortByDesc('image');
            }
            $feedback = $this->paginate($feedback, 9);

            return view("Frontend::product.product_detail", compact('data', 'product_relate', 'product_recentlies', 'feedback', 'feedback_filter'));
        }
        return redirect()->back();
    }

    /**
     * @param Request $request
     * @param $key_slug
     * @return string
     */
    public function feedback(Request $request, $key_slug) {
        if ($request->post()) {
            $input   = $request->all();
            $product = Product::query()->where('key_slug', $key_slug)->first();
            $data    = new Feedback();
            if ($request->hasFile('image')) {
                $image          = $request->image;
                $image_name     = $this->auth->user()->email . '_' . time() . '.' . $image->getClientOriginalExtension();
                $input['image'] = Helper::storageFile($image, $image_name, 'Feedback');
            }
            $input['product_id'] = $product->id;
            $input['member_id']  = $this->auth->id();

            $data->create($input);

            return redirect()->route('get.product.productDetail', [$product->key_slug, 'feedback_filter' => Feedback::TIME]);
        }

        return view('Frontend::product._form_feedback')->render();
    }
}
