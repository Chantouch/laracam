<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Request;
use Laratrust\Traits\LaratrustUserTrait;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens, LaratrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @param $id == null
     * @return array
     */
    public static function rule($id = null)
    {

        switch (Request::method()) {
            case 'GET':
            case 'DELETE': {
                return [];
            }
            case 'POST': {
                return [
                    'name' => 'required',
                    'email' => 'required|email|unique:users,email',
                    'roles' => 'required',
                    'password_options' => 'required',
                    //'password' => 'required|same:confirm_password'
                ];
            }
            case 'PUT':
            case 'PATCH': {
                return [
                    'name' => 'required|max:255',
                    'email' => 'required|email|unique:users,email,' . $id,
                    'password' => 'same:confirm-password|min:6',
                    //'confirm-password' => 'same:password|min:6',
                    'roles' => 'required'

                ];
            }
            default:
                break;
        }
        return self::rule($id);
    }

    public static function messages()
    {
        return [
            'name.required' => 'Please input your name',
            'password.min' => 'លេខសំងាត់ត្រូវធំជាង​ ឬស្មើរ ៦ខ្ទង់។',
        ];
    }
}
