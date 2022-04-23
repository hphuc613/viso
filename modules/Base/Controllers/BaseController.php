<?php

namespace Modules\Base\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;


class BaseController extends Controller{

    /**
     * @param Request $request
     * @param $key
     * @return RedirectResponse
     */
    public function changeLocale(Request $request, $key){
        $request->session()->put('locale', $key);
        return redirect()->back();
    }

    /**
     * @param $items
     * @param int $perPage
     * @param null $page
     * @return LengthAwarePaginator
     */
    public function paginate($items, $perPage = 20, $page = null){
        $page  = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);

        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, [
            'path' => Paginator::resolveCurrentPath()
        ]);
    }
}
