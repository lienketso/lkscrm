<?php

namespace Webkul\Lead\Models;

use Illuminate\Database\Eloquent\Model;

class TmpCustomer extends Model
{
    protected $table = 'tmp_customers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_kiotviet',
        'code',
        'name',
        'contactNumber',
        'address',
        'retailerId',
        'branchId',
        'locationName',
        'wardName',
        'type',
        'organization',
        'debt',
        'totalInvoiced',
        'totalRevenue',
        'totalPoint',
    ];
}
