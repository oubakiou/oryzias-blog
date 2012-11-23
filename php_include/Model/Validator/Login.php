<?php
class Model_Validator_Login extends Oryzias\Validator
{
    protected $allowKeys = [
        'name',
        'password',
    ];
    
    protected $rules = [
        'name'=>[
            'required'=>[
                'msg'=>'ユーザ名を入力してください',
            ],
            'alphaNumeric'=>[
                'msg'=>'ユーザ名は英数字で入力してください',
            ],
            'maxStrLen'=>[
                'msg'=>'ユーザ名は85文字以内で入力してください',
                'args'=>['max'=>85],
            ],
        ],
        'password'=>[
            'required'=>[
                'msg'=>'パスワードを入力してください',
            ],
            'maxStrLen'=>[
                'msg'=>'パスワードは85文字以内で入力してください',
                'args'=>['max'=>85],
            ],
        ],
        'login'=>[
            'auth'=>[
                'msg'=>'ユーザ名またはパスワードが間違っています',
            ],
        ],
    ];

    function auth($input){
        if (
            ($this->data['name'] == Oryzias\Config::get('admin.name')) && 
            ($this->data['password'] == Oryzias\Config::get('admin.password'))
        ) {
            return true;
        } else {
            return false;
        }
    }
}
