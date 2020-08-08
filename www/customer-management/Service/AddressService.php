<?php
declare(strict_types=1);

namespace CustomerManagement\Service;

use CustomerManagement\Repositories\AddressRepository;

class AddressService
{
    protected $address;

    public function __construct(AddressRepository $addressRepository)
    {
        $this->address = $addressRepository;
    }

    public function all(int $idClient)
    {
        $data = $this->address->all($idClient);

        return $data;
    }

    public function delete(int $id, int $idClient)
    {
        return $this->address->delete($id, $idClient);
    }

    protected function inputCustom($input): array
    {
        $data = [
            'addr_zipcode' => $input['zipcode'],
            'addr_public_place' => $input['publicPlace'],
            'addr_neighbordhood' => $input['neighbordhood'],
            'addr_complement' => $input['complement'],
            'addr_number' => $input['number'],
            'addr_city' => $input['city'],
            'addr_state' => $input['state'],
            'addr_main' => false,
        ];

        return $data;
    }

    protected function outputCustom($output): array
    {
        return [
            'zipcode' => $output['addr_zipcode'],
            'publicPlace' => $output['addr_public_place'],
            'neighbordhood' => $output['addr_neighbordhood'],
            'complement' => $output['addr_complement'],
            'number' => $output['addr_number'],
            'city' => $output['addr_city'],
            'state' => $output['addr_state'],
            'main' => $output['addr_main'],
        ];
    }
}
