<?php
declare(strict_types=1);

namespace CustomerManagement\Repositories;

use CustomerManagement\Models\AddressModel;
use CustomerManagement\Models\ClientModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ClientRepository
{
    protected $client;

    protected $address;

    protected $fields = [
        'clie_company_name',
        'clie_cnpj',
        'clie_telephone',
        'clie_responsible_name',
        'clie_email',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected $fieldsAddress = [
        'addr_zipcode',
        'addr_public_place',
        'addr_neighbordhood',
        'addr_complement',
        'addr_number',
        'addr_city',
        'addr_state',
        'addr_main'
    ];

    public function __construct(ClientModel $clientModel, AddressModel $addressModel)
    {
        $this->client = $clientModel;
        $this->address = $addressModel;
    }

    public function save(array $input): Model
    {
        return DB::transaction(function () use ($input) {

            foreach ($this->fields as $field) {
                if (isset($input[$field])) {
                    $this->client->{$field} = $input[$field];
                }
            }
            $this->client->save();

            if (isset($input['address'])) {

                foreach ($input['address'] as $addressOnly) {

                    foreach ($this->fieldsAddress as $fieldAddress){

                        if (isset($addressOnly[$fieldAddress])){

                            $this->address->{$fieldAddress} = $addressOnly[$fieldAddress];
                        }
                    }

                    $this->address->save();

                    $this->client->address()->attach($this->address->addr_id);
                }
            }
            return $this->client;
        });
    }
}
