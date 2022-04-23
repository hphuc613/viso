<?php
return [
    'name' => trans('Page'),
    'route' => '#',
    'sort' => 3,
    'active' => TRUE,
    'id' => 'page',
    'icon' => '<i class="fa fa-window-maximize" style="display: inline-flex; align-items: center"></i>',
    'middleware' => [],
    'group' => [
        [
            'name' => trans('Page'),
            'route' => route('get.page.list'),
            'id' => 'page',
            'middleware' => ['page']
        ],
        [
            'name' => trans('Home'),
            'route' => route('get.home.list'),
            'id' => 'home',
            'middleware' => ['home']
        ],
    ]
];
