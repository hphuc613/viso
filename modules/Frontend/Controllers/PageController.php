<?php

namespace Modules\Frontend\Controllers;

use App\Http\Controllers\Controller;
use Modules\Page\Models\Page;
use Modules\Participate\Models\Participate;

class PageController extends Controller {

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct() {
        # parent::__construct();
    }

    public function getPage() {
        $page = str_replace('-','_',segmentUrl(0));
        $page_id = strtoupper($page);
        $data = Page::query()->where('page_id','=',$page_id)->first();
        return view("Frontend::pages.$page", compact('data'));
    }

    public function participate(){
        $data = Participate::all();
        return view("Frontend::pages.participate", compact('data'));
    }
}
