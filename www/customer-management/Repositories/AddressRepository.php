<?php
declare(strict_types=1);

namespace CustomerManagement\Repositories;

use CustomerManagement\Models\AddressModel;
use CustomerManagement\Models\ClientModel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AddressRepository
{
    protected $address;

    protected $client;

    protected $fields = [
        'addr_zipcode',
        'addr_public_place',
        'addr_neighbordhood',
        'addr_complement',
        'addr_number',
        'addr_city',
        'addr_state',
        'addr_main'
    ];

    public function __construct(AddressModel $addressModel, ClientModel $clientModel)
    {
        $this->address = $addressModel;
        $this->client = $clientModel;
    }

    public function all(int $idClient): Collection
    {
        $address = $this->client->find($idClient)->address;

        return $address;
    }

    public function find(int $id): Model
    {
        $data = $this->address
            ->where('addr_id', '=', $id)
            ->orderBy('addr_zipcode', 'ASC')->first();

        if (!$data) {
            throw new \Exception('Data not found!');
        }

        return $data;
    }

    public function save(array $input, int $idClient): Model
    {
        return DB::transaction(function () use ($input, $idClient) {

            foreach ($this->fields as $field) {
                if (isset($input[$field])) {
                    $this->address->{$field} = $input[$field];
                }
            }
            $this->address->save();

            $this->address->client()->attach($idClient);

            return $this->address;

        });
    }

    public function update(array $input, int $id): Model
    {
        $this->address = $this->find($id);

        foreach ($this->fields as $field) {
            if (isset($input[$field])) {
                $this->address->{$field} = $input[$field];
            }
        }
        $this->address->save();

        return $this->address;
    }

    public function delete(int $id, int $idClient): bool
    {
        return DB::transaction(function () use ($id, $idClient) {

            $address = $this->client->find($idClient)->address;

            if (!$address) {
                throw new \Exception('Data not found');
            }

            $this->address = $this->find($id);

            $this->address->destroy($id);

            $this->address->client()->detach($idClient);

            return $this->address->delete();
        });
    }
}
