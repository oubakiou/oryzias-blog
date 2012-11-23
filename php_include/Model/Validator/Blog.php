<?php
class Model_Validator_Blog extends Model_Validator_Parent_Common
{
    protected $allowKeys = [
        'id',
        'title',
        'tags',
        'keyImageId',
        'description',
        'bodyMarkdown',
        'isPublic',
    ];
    
    protected $rules = [
        'title'=>[
            'required'=>['msg'=>'タイトルを入力してください'],
            'maxStrLen'=>[
                    'msg'=>'タイトルは85文字以内で入力してください',
                    'args'=>['max'=>85],
            ],
        ],
        'tags'=>[
            'maxStrLen'=>[
                'msg'=>'タグは255文字以内で入力してください',
                'args'=>['max'=>255],
            ],
        ],
        'description'=>[
            'maxStrLen'=>[
                'msg'=>'概要は85文字以内で入力してください',
                'args'=>['max'=>85],
            ],
        ],
        'bodyMarkdown'=>[
            'required'=>['msg'=>'本文を入力してください'],
        ],
        'csrfToken'=>[
            'required'=>['msg'=>'認証トークンがありません'],
            'checkCsrf'=>['msg'=>'認証に失敗しました'],
        ],
    ];
}
