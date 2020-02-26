<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Encore\Admin\Auth\Database\Administrator;
class AdminUser extends Administrator
{
    public function hotels()
    {
        return $this->hasMany(Hotel::class,'user_id');
    }    
}
