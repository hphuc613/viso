<?php
return [
    'name' => trans('User'),
    'route' => route('get.user.list'),
    'sort' => 8,
    'active'=> TRUE,
    'id'=> 'user',
    'icon' => '<i class="fa fa-users"></i>',
    'middleware' => ['user'],
    'group' => []
];
