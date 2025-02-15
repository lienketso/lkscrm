<?php

namespace Webkul\Lead\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ZaloZnsMessages extends Model
{
    use SoftDeletes;

    protected $table = 'zalo_zns_messages';
    public $timestamps = true;

    const NOT_SEND = 1;
    const SENT = 2;
    const SEND_FALSE = 3;

    const EVENT_NAME_USER_RECEIVED_MESSAGE = 'user_received_message'; // Sự kiện người dùng nhận thông báo ZNS
    
}
