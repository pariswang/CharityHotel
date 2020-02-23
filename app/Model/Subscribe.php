<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Subscribe extends Model
{
    protected $table = 'wh_subscribe';

    public $timestamps = false;

	public function region()
    {
        return $this->belongsTo(Region::class, 'region_id');
    }

	public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
