<?php

namespace CustomerManagement\Test\Service;

use CustomerManagement\Repositories\ClientRepository;
use CustomerManagement\Service\ClientService;
use PHPUnit\Framework\TestCase;

class ClientServiceTest extends TestCase
{
    private $clientRepository;
    private $clientService;

    public function setUp(): void
    {
        parent::setUp();

        $this->clientRepository = $this->createMock(ClientRepository::class);
        $this->clientService = new ClientService($this->clientRepository);
    }

    /**
     * @test
     */
    public function shouldSaveClientNotAddress()
    {
        $inputRepository = [
            'clie_company_name' => 'Alimentos LTDA',
            'clie_cnpj' => '156161651',
            'clie_telephone' => '21213',
            'clie_responsible_name' => 'Rafael Mattos',
            'clie_email' => 'rafael_xuvisco@yahoo.com.br',
            'created_by' => 1,
            'created_at' => '2020-09-02'
        ];
        $outputRepository = [
            'clie_id' => 1,
            'clie_company_name' => 'Alimentos LTDA',
            'clie_cnpj' => '156161651',
            'clie_telephone' => '21213',
            'clie_responsible_name' => 'Rafael Mattos',
            'clie_email' => 'rafael_xuvisco@yahoo.com.br',
            'created_by' => 1,
            'created_at' => '2020-09-02'
        ];

        $inputCustom = [
            'companyName' => 'Alimentos LTDA',
            'cnpj' => '156161651',
            'telephone' => '21213',
            'responsibleName' => 'Rafael Mattos',
            'email' => 'rafael_xuvisco@yahoo.com.br',
            'criadoEm' => '2020-09-02',
            'criadoPor' => 1,
        ];
        $outputCustom = [
            'idClient' => 1,
            'companyName' => 'Alimentos LTDA',
            'cnpj' => '156161651',
            'telephone' => '21213',
            'responsibleName' => 'Rafael Mattos',
            'email' => 'rafael_xuvisco@yahoo.com.br',
            'criadoPor' => 1,
            'criadoEm' => '2020-09-02'
        ];

        $this->clientRepository
            ->expects($this->once())
            ->method('save')
            ->with($inputRepository)
            ->willReturn($outputRepository);

        $service = $this->clientService->save($inputCustom);

        $this->assertEquals($outputCustom, $service);
    }

    /**
     * @test
     */
    public function shouldSaveClientOutputNotEquals()
    {
        $inputRepository = [
            'clie_company_name' => 'Alimentos LTDA',
            'clie_cnpj' => '156161651',
            'clie_telephone' => '21213',
            'clie_responsible_name' => 'Rafael Mattos',
            'clie_email' => 'rafael_xuvisco@yahoo.com.br',
            'created_by' => 1,
            'created_at' => '2020-09-02'
        ];
        $outputRepository = [
            'clie_id' => 1,
            'clie_company_name' => 'Alimentos LTDA',
            'clie_cnpj' => '156161651',
            'clie_telephone' => '21213',
            'clie_responsible_name' => 'Rafael Mattos',
            'clie_email' => 'rafael_xuvisco@yahoo.com.br',
            'created_by' => 1,
            'created_at' => '2020-09-02'
        ];

        $inputCustom = [
            'companyName' => 'Alimentos LTDA',
            'cnpj' => '156161651',
            'telephone' => '21213',
            'responsibleName' => 'Rafael Mattos',
            'email' => 'rafael_xuvisco@yahoo.com.br',
            'criadoEm' => '2020-09-02',
            'criadoPor' => 1,
        ];
        $outputCustom = [
            'idClient' => 1,
            'companyName' => 'Alimentos LTDA',
            'cnpj' => '156161651',
            'telephone' => '21213',
            'responsibleName' => 'Rafael Mattos',
            'email' => 'rafael_xuvisco@yahoo.com.br',
            'criadoPor' => 1,
            'criadoEm' => '2021-08-04'
        ];

        $this->clientRepository
            ->expects($this->once())
            ->method('save')
            ->with($inputRepository)
            ->willReturn($outputRepository);

        $service = $this->clientService->save($inputCustom);

        $this->assertNotEquals($outputCustom, $service);
    }
}
