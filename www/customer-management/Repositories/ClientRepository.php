<?php
declare(strict_types=1);

namespace CustomerManagement\Repositories;

use CustomerManagement\Models\ClientModel;

class ClientRepository
{
    protected $client;

    protected $fields = [
        'clie_company_name',
        'clie_cnpj',
        'clie_telephone',
        'clie_responsible_name',
        'clie_email',
        'created_by',
        'updated_by',
        'deleted_by',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function __construct(ClientModel $clientModel)
    {
        $this->client = $clientModel;
    }

    public function save(array $input)
    {
        foreach ($this->fields as $field) {
            if (isset($input[$field])) {
                $this->client->{$field};
            }
        }

        $this->client->save();

        return $this->client;
    }
}
