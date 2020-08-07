<?php
declare(strict_types=1);

namespace CustomerManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use CustomerManagement\Service\ClientService;
use CustomerManagement\Validation\ClientValidation;

class ClientController extends Controller
{
    protected $client;

    public function __construct(ClientService $clientService)
    {
        $this->client = $clientService;
    }

    public function store(ClientValidation $request)
    {
        try {
            $input = $request->all();

            $data = $this->client->save($input);

            return response()->json($data, 200);

        } catch (\Exception $e) {

            return response()->json($e->getMessage(), 400);
        }
    }
}
