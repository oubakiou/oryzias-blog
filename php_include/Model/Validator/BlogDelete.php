<?php
class Model_Validator_BlogDelete extends Model_Validator_Parent_Common
{
    protected $rules = [
        'csrfToken'=>[
            'required'=>['msg'=>'認証トークンがありません'],
            'checkCsrf'=>['msg'=>'認証に失敗しました'],
        ]
    ];
}
