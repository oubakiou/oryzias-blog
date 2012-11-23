<?php

return [
    'debug' => true,
    'salt'  => 'QJ++j1]?kMAP(ZJ n2=4k|q?W\rZPcWM',
    'db'=>[
        'default'=>[
            'dsn'=>[
                'type'=>'mysql',
                'host'=>'localhost', 
                'dbname'=>'oryzias_blog',
                'charset'=>'utf8',
            ],
            'user'=>'demo',
            'password'=>'demo',
        ],
    ],
    'admin'=>[
        'name'=>'demo',
        'password'=>'demo',
    ],
    'blog'=>[
        'title'=>'デモブログ',
        'logoUrl'=>'',
    ],
];
