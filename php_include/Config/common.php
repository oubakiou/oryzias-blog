<?php

return [
    'debug'     => false,
    'salt'      => 'qi0KbV^y=)j&$T;(VytxFT2kCU%0~rQ4',
    'timeZone'  => 'Asia/Tokyo',
    'baseDir'   => realpath(dirname(__FILE__).'/../../'),
    'publicDir' => realpath(dirname(__FILE__).'/../../') . '/public',
    'logDir' => realpath(dirname(__FILE__).'/../../') . '/php_include/Var/Log',
    'internalCharset'     => 'UTF-8',
    'template'=>[
        'outputCharset'       => 'UTF-8',
        'templateCharset'     => 'UTF-8',
        'templateDir'         => realpath(dirname(__FILE__).'/../../') . '/php_include/Template/Default',
        'templateCacheDir'    => realpath(dirname(__FILE__).'/../../') . '/Var/Cache/Template/Default',
        'templateCacheDisable'=> true,
    ],
    'templateFp'=>false,
    'templateSp'=>false,
    'image'=>[
        'uploadImgMaxSize' => 100000000,
        'uploadImgUrl'     => '/img/up/',
        'uploadImgPath'    => realpath(dirname(__FILE__).'/../../') . '/public/img/up/',
    ],
    'routingRules'=>[
        ['pathPattern'=>'/calendar\/(.*)\//', 'controllerName'=>'Calendar_Index', 'paramsName'=>['date']],
        ['pathPattern'=>'/calendar\/(.*)/', 'controllerName'=>'Calendar_BlogList', 'paramsName'=>['currentPage']],
        ['pathPattern'=>'/tag\/([0-9]+)\//', 'controllerName'=>'Tag_BlogList', 'paramsName'=>['tagId']],
        ['pathPattern'=>'/tag\/([0-9]+)/', 'controllerName'=>'Tag_Index', 'paramsName'=>['currentPage']],
        ['pathPattern'=>'/([0-9]+)/', 'controllerName'=>'Detail', 'paramsName'=>array('id')],
    ],
];
