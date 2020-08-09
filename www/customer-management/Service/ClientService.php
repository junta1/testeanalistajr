<?php
declare(strict_types=1);

namespace CustomerManagement\Service;

use CustomerManagement\Repositories\ClientRepository;

class ClientService
{
    protected $client;

    public function __construct(ClientRepository $clientRepository)
    {
        $this->client = $clientRepository;
    }

    public function all(array $input = null): array
    {
        $datas = $this->client->getWhere($input);

        $outputCustom = [];
        foreach ($datas as $data) {
            $outputCustom[] = $this->outputCustom($data);
        }

        return $outputCustom;
    }

    public function find(int $id): array
    {
        $data = $this->client->find($id);

        return $this->outputCustom($data);
    }

    public function save(array $input): array
    {
        $dataCustom = $this->inputCustom($input);
        $dataCustom['created_by'] = 1;

        $data = $this->client->save($dataCustom);

        return $this->outputCustom($data);
    }

    public function update(array $input, int $id): array
    {
        $dataCustom = $this->inputCustom($input);
        $dataCustom['updated_by'] = 1;

        $data = $this->client->update($dataCustom, $id);

        return $this->outputCustom($data);
    }

    public function delete($id): bool
    {
        $user = 1;
        return $this->client->delete($id, $user);
    }

    protected function inputCustom($input): array
    {
        $data = [
            'clie_company_name' => $input['companyName'],
            'clie_cnpj' => onlyNumber($input['cnpj']),
            'clie_telephone' => onlyNumber($input['telephone']),
            'clie_responsible_name' => $input['responsibleName'],
            'clie_email' => emailValidation($input['email']),
        ];

        if (isset($input['address'])) {

            foreach ($input['address'] as $address) {

                $data['address'][] = [
                    'addr_zipcode' => $address['zipcode'],
                    'addr_public_place' => $address['publicPlace'],
                    'addr_neighbordhood' => $address['neighbordhood'],
                    'addr_complement' => $address['complement'],
                    'addr_number' => $address['number'],
                    'addr_city' => $address['city'],
                    'addr_state' => $address['state'],
                    'addr_main' => false,
                ];
            }
        }

        return $data;
    }

    protected function outputCustom($output): array
    {
        return [
            'idClient' => $output['clie_id'],
            'companyName' => $output['clie_company_name'],
            'cnpj' => mask($output['clie_cnpj'], '##.###.###/####-##'),
            'telephone' => mask($output['clie_telephone'], '(###)####-#####'),
            'responsibleName' => $output['clie_responsible_name'],
            'email' => $output['clie_email'],
            'createdAt' => dateObjectUsToBr($output['created_at']),
            'createdBy' => $output['created_by']
        ];
    }
}
