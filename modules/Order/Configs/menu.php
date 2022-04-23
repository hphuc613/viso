<?php
return [
    'name' => trans('Invoice'),
    'route' => route('get.order.list'),
    'sort' => 6,
    'active'=> TRUE,
    'id'=> 'order',
    'icon' => '<i class="mdi mdi-file-document"></i>',
    'middleware' => ['order'],
    'group' => []
];
