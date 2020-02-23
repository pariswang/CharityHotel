<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Subscribe extends Model
{
    protected $table = 'wh_subscribe';

    protected $fillable = [
        'user_id', 'conn_person', 'conn_phone', 'checkin_num', 'date_begin', 'date_end', 'createdate', 'hotel_id', 'conn_position', 'conn_company', 'room_count', 'can_pay', 'has_letter', 'status'
    ];

    public $timestamps = false;
}
