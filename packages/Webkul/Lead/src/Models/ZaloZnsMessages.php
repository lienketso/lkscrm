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
}
