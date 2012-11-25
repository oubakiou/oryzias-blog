<?php

$baseDir = realpath(dirname(__FILE__).'/../../');

return [
    'debug'     => false,
    'salt'      => 'qi0KbV^y=)j&$T;(VytxFT2kCU%0~rQ4',
    'timeZone'  => 'Asia/Tokyo',
    'baseDir'   => $baseDir,
    'publicDir' => $baseDir . '/public',
    'logDir' => $baseDir . '/php_include/Var/Log',
    'internalCharset'     => 'UTF-8',
    'template'=>[
        'enabledGzip'         => true,
        'outputCharset'       => 'UTF-8',
        'templateCharset'     => 'UTF-8',
        'templateDir'         => $baseDir . '/php_include/Template/Default',
        'templateCacheDir'    => $baseDir . '/Var/Cache/Template/Default',
        'templateCacheDisable'=> true,
    ],
    'templateFp'=>false,
    'templateSp'=>false,
    'compressor'=>[
        'enabledGzip'=>true,
        'cacheDisable'=>true,
        'js'=>[
            'cacheDir'=>$baseDir . '/public/js',
        ],
        'css'=>[
            'cacheDir'=>$baseDir . '/public/css',
        ],
    ],
    'image'=>[
        'uploadImgMaxSize' => 10000000,
        'uploadImgUrl'     => '/img/up/',
        'uploadImgPath'    => $baseDir . '/public/img/up/',
    ],
    'routingRules'=>[
        ['pathPattern'=>'/calendar\/(.*)\//', 'controllerName'=>'Calendar_Index', 'paramsName'=>['date']],
        ['pathPattern'=>'/calendar\/(.*)/', 'controllerName'=>'Calendar_BlogList', 'paramsName'=>['currentPage']],
        ['pathPattern'=>'/tag\/([0-9]+)\//', 'controllerName'=>'Tag_BlogList', 'paramsName'=>['tagId']],
        ['pathPattern'=>'/tag\/([0-9]+)/', 'controllerName'=>'Tag_Index', 'paramsName'=>['currentPage']],
        ['pathPattern'=>'/([0-9]+)/', 'controllerName'=>'Detail', 'paramsName'=>array('id')],
    ],
];
