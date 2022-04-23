<?php

namespace Modules\Frontend\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Modules\Base\Models\Status;
use Modules\Frontend\Models\Frontend;
use Modules\Post\Models\Post;
use Modules\Product\Models\Product;

class PostController extends Controller {

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct() {
        # parent::__construct();
    }

    /**
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request) {
        $data = Post::query()->where('status', Status::STATUS_ACTIVE)
                    ->orderBy('created_at', 'desc')
                    ->paginate(3);

        $data_recent = Post::query()->where('status', Status::STATUS_ACTIVE)
                           ->orderBy('created_at', 'desc')
                           ->limit(3)->get();
        return view("Frontend::post.post_listing", compact('data', 'data_recent'));
    }


    /**
     * @param Request $request
     * @param $id
     * @param $slug
     * @return Factory|View
     */
    public function detail(Request $request, $id, $slug) {
        $query = Post::query();

        $data = clone $query;
        $data = $data->where('id', $id)
                     ->where('key_slug', $slug)
                     ->first();

        $old_post = clone $query;
        $old_post = $old_post->where('id', '<', $id)
                             ->where('status', Status::STATUS_ACTIVE)
                             ->orderBy('id', 'desc')
                             ->first();

        $new_post = clone $query;
        $new_post = $new_post->where('id', '>', $id)
                             ->where('status', Status::STATUS_ACTIVE)
                             ->first();

        $data_recent = Post::query()
                           ->where('id', '<>', $id)
                           ->where('status', Status::STATUS_ACTIVE)
                           ->orderBy('created_at', 'desc')
                           ->limit(3)->get();

        $products = Product::query()->where('status', Status::STATUS_ACTIVE)->take(4)->get();

        return view("Frontend::post.post_detail", compact('data', 'data_recent', 'old_post', 'new_post', 'products'));
    }
}
