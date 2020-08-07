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

    public function save(array $input)
    {
        $dataCustom = $this->inputCustom($input);

        $data = $this->client->save($dataCustom);

        return $this->outputCustom($data);
    }

    protected function inputCustom($input)
    {
        return [
            'clie_company_name' => $input['companyName'],
            'clie_cnpj' => $input['cnpj'],
            'clie_telephone' => $input['telephone'],
            'clie_responsible_name' => $input['responsibleName'],
            'clie_email' => $input['email'],
            'created_at' => $input['criadoEm'],
            'created_by' => 1
        ];
    }

    protected function outputCustom($output)
    {
        return [
            'idClient' => $output['clie_id'],
            'companyName' => $output['clie_company_name'],
            'cnpj' => $output['clie_cnpj'],
            'telephone' => $output['clie_telephone'],
            'responsibleName' => $output['clie_responsible_name'],
            'email' => $output['clie_email'],
            'criadoEm' => $output['created_at'],
            'criadoPor' => $output['created_by']
        ];
    }
}
