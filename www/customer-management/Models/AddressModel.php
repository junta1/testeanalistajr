<?php

namespace CustomerManagement\Models;

use Illuminate\Database\Eloquent\Model;

class AddressModel extends Model
{
    protected $primaryKey = 'addr_id';

    protected $table = 'address';

    public $timestamps;

    public function client()
    {
        $this->belongsToMany(ClientModel::class);
    }
}
