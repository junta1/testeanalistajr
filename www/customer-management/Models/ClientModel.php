<?php

namespace CustomerManagement\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientModel extends Model
{
    protected $table = 'client';

    protected $primaryKey = 'clie_id';

    protected $fillable = [
        'clie_company_name',
        'clie_cnpj',
        'clie_telephone',
        'clie_responsible_name',
        'clie_email',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    use SoftDeletes;
}
