<?php
declare(strict_types=1);

namespace CustomerManagement\Repositories;

use CustomerManagement\Models\AddressModel;
use CustomerManagement\Models\ClientModel;
use Illuminate\Database\Eloquent\Collection;
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

    public function find(int $id): Model
    {
        $data = $this->client
            ->where('clie_id', '=', $id)
            ->orderBy('clie_company_name', 'ASC')->first();

        if (!$data) {
            throw new \Exception('Data not found!');
        }

        return $data;
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

                    foreach ($this->fieldsAddress as $fieldAddress) {

                        if (isset($addressOnly[$fieldAddress])) {

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

    public function update(array $input, int $id): Model
    {
        $this->client = $this->find($id);

        foreach ($this->fields as $field) {
            if (isset($input[$field])) {
                $this->client->{$field} = $input[$field];
            }
        }
        $this->client->save();

        return $this->client;
    }

    public function delete(int $id, int $user): bool
    {
        $this->client = $this->find($id);
        $this->client->deleted_by = $user;
        $this->client->save();

        return $this->client->delete();
    }

    public function getWhere(array $input = null): Collection
    {
        $this->client = $this->client->orderBy('clie_company_name', 'ASC');

        if (isset($input['clie_company_name'])) {
            $this->client = $this->client->where('clie_company_name', '=', $input['clie_company_name']);
        }

        return $this->client->get();
    }
}
