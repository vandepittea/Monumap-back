<?php
namespace App\Modules\Users\Services;

use App\Models\User;
use App\Modules\Core\Services\Service;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class UserService extends Service
{
    public function __construct(User $model) {
        Parent::__construct($model);
    }  

    protected array $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:6',
    ];

    public function registerUser($data)
    {
        $validator = $this->validate($data);
    
        if ($validator->fails()) {
            throw new \Exception($validator->errors()->first());
        }
    
        $data['password'] = Hash::make($data['password']);
    
        $user = $this->_model->create($data);
    
        return $user ? true : false;
    }
    
    
    
}