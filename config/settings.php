<?php
/**
 * Created by PhpStorm.
 * User: nguyen_cong_chinh
 * Date: 2017/11/30
 * Time: 17:53
 */

return [
    'items' => [
        'status' => [
            'pending'   => '判定中',
            'approval'  => '有効',
            'reject'    => '無効',
        ],
        'paginate' => [
            'perPage' => 9,
        ],
        'autocomplete' => [
            'termCount' => 10,
            'stringLimit' => 40,
        ]
    ],
    'users' => [
        'passbook' => [
            'paginate' => [
                'perPage' => 15,
            ]
        ],
    ],
    'cache' => [
        'cache_minutes' => 1440,
    ],
    'news' => [
        'paginate' => [
            'perPage' => 15,
        ],
        'home' => [
            'limit' => 3,
        ],
    ],
];