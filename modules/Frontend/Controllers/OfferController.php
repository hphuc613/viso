<?php

namespace Modules\Frontend\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Modules\Offer\Models\Offer;
use Modules\Offer\Models\OfferBundle;

class OfferController extends Controller
{

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        # parent::__construct();
    }

    public function index()
    {
        $month = formatDate(Carbon::now()->timestamp, 'm-Y');

        $data = Offer::query()->where('month', '=', $month)->get();

        return view("Frontend::offer.offer_listing", compact('data'));
    }

    public function bundle($id)
    {
        $data = OfferBundle::query()->where('offer_id', $id)->first();
        $data = OfferBundle::getProductList($data->product_ids);
        return view("Frontend::offer.offer_bundle", compact('data'));
    }
}
