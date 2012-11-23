<?php
class Model_Validator_ImageUpload extends Model_Validator_Parent_Common
{
    protected $allowKeys = [
        'name',
    ];
    
    protected $rules = [
        'name'=>[
            'maxStrLen'=>[
                    'msg'=>'画像名は85文字以内で入力してください',
                    'args'=>['max'=>85],
            ],
        ],
        'csrfToken'=>[
            'required'=>['msg'=>'認証トークンがありません'],
            'checkCsrf'=>['msg'=>'認証に失敗しました'],
        ]
    ];
}
