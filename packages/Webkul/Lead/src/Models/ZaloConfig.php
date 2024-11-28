<?php

namespace Webkul\Lead\Models;

use Illuminate\Database\Eloquent\Model;

class ZaloConfig extends Model
{
    
    public $timestamps = true;

    protected $table = 'zalo_configs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'template_offset',
        'template_limit',
        'access_token',
        'refresh_token',
        'token_expired_at',
    ];
}
