<?php
declare(strict_types=1);

namespace CustomerManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use CustomerManagement\Service\ClientService;
use CustomerManagement\Validation\ClientValidation;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    protected $client;

    public function __construct(ClientService $clientService)
    {
        $this->client = $clientService;
    }

    public function index(Request $request)
    {
        try {
            $input = $request->all();

            $data = $this->client->all($input);

            return response()->json($data, 200);

        } catch (\Exception $e) {

            return response()->json($e->getMessage(), 400);
        }
    }

    public function show(int $id)
    {
        try {
            $data = $this->client->find($id);

            return response()->json($data, 200);

        } catch (\Exception $e) {

            return response()->json($e->getMessage(), 400);
        }
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
