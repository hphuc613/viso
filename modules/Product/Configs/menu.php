<?php
return [
    'name' => trans('Product Management'),
    'route' => "#",
    'sort' => 5,
    'active'=> TRUE,
    'id'=> 'product',
    'icon' => '<i class="fa fa-shopping-cart"></i>',
    'middleware' => [],
    'group' => [
        [
            'name' => trans('Product'),
            'route' => route('get.product.list'),
            'id' => 'product',
            'middleware' => ['product']
        ],
        [
            'name' => trans('Product Category'),
            'route' => route('get.product_category.list'),
            'id' => 'product-category',
            'middleware' => ['product-category']
        ],
        [
            'name' => trans('Attribute'),
            'route' => route('get.attribute.list'),
            'id' => 'attribute',
            'middleware' => ['attribute']
        ],
        [
            'name' => trans('Product Brand'),
            'route' => route('get.product_brand.list'),
            'id' => 'product-brand',
            'middleware' => ['product-brand']
        ],
    ]
];
