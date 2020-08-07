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
            'clie_cnpj' => onlyNumber($input['cnpj']),
            'clie_telephone' => onlyNumber($input['telephone']),
            'clie_responsible_name' => $input['responsibleName'],
            'clie_email' => $input['email'],
            'created_by' => 1
        ];
    }

    protected function outputCustom($output)
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
