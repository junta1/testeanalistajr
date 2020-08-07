<?php

namespace CustomerManagement\Models;

use Illuminate\Database\Eloquent\Model;

class AddressModel extends Model
{
    protected $table = 'address';

    protected $primaryKey = 'addr_id';

    protected $fillable = [
        'addr_zipcode',
        'addr_public_place',
        'addr_neighbordhood',
        'addr_complement',
        'addr_number',
        'addr_city',
        'addr_state',
        'addr_main'
    ];

    public $timestamps;

    public function client()
    {
        $this->belongsToMany(ClientModel::class);
    }
}
