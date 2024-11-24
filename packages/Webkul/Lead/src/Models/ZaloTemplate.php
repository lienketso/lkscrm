<?php

namespace Webkul\Lead\Models;

use Illuminate\Database\Eloquent\Model;

class ZaloTemplate extends Model
{
    protected $table = 'zalo_templates';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        
    ];

    const ENABLE = 1;
    const PENDING_REVIEW = 2;
    const REJECT = 3;
    const DISABLE = 4;
    const STATUS = [
        'ENABLE' => self::ENABLE,
        'PENDING_REVIEW' => self::PENDING_REVIEW,
        'REJECT' => self::REJECT,
        'DISABLE' => self::DISABLE,
    ];
    const STATUS_TITLE = [
        self::ENABLE => 'Enable',
        self::PENDING_REVIEW => 'Pending review',
        self::REJECT => 'Reject',
        self::DISABLE => 'Disable',
    ];


    const HIGH = 1;
    const MEDIUM = 2;
    const LOW = 3;
    const UNDEFINED = 4;
    const QUALITY = [
        'HIGH' => self::HIGH,
        'MEDIUM' => self::MEDIUM,
        'LOW' => self::LOW,
        'UNDEFINED' => self::UNDEFINED,
    ];
    const QUALITY_TITLE = [
        self::HIGH => 'Hight',
        self::MEDIUM => 'Medium',
        self::LOW => 'Low',
        self::UNDEFINED => 'Undefined',
    ];

    const OTP = 1;
    const IN_TRANSACTION = 2;
    const POST_TRANSACTION = 3;
    const ACCOUNT_UPDATE = 4;
    const GENERAL_UPDATE = 5;
    const FOLLOW_UP = 6;

    const TAG = [
        'OTP' => self::OTP,
        'IN_TRANSACTION' => self::IN_TRANSACTION,
        'POST_TRANSACTION' => self::POST_TRANSACTION,
        'ACCOUNT_UPDATE' => self::ACCOUNT_UPDATE,
        'GENERAL_UPDATE' => self::GENERAL_UPDATE,
        'FOLLOW_UP' => self::FOLLOW_UP,
    ];

    const TAG_TITLE = [
        self::OTP => 'Otp',
        self::IN_TRANSACTION => 'In transaction',
        self::POST_TRANSACTION => 'Post transaction',
        self::ACCOUNT_UPDATE => 'Account update',
        self::GENERAL_UPDATE => 'General update',
        self::FOLLOW_UP => 'Follow up',
    ];
}
