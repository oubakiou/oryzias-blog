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
        'uploadImgMaxSize'    => 1048576,
        'uploadImgPath'       => realpath(dirname(__FILE__).'/../../') . '/public/img',
    ],
    'routingRules'=>[],
];
