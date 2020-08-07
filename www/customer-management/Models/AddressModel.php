<?php

namespace CustomerManagement\Models;

use Illuminate\Database\Eloquent\Model;

class AddressModel extends Model
{
    protected $table = 'address';

    protected $primaryKey = 'addr_id';

    public $timestamps;

    public function client()
    {
        $this->belongsToMany(ClientModel::class);
    }
}
