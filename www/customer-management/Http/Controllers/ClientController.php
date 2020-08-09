<?php
declare(strict_types=1);

namespace CustomerManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use CustomerManagement\Service\ClientService;
use CustomerManagement\Validation\ClientValidation;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ClientController extends Controller
{
    protected $client;

    public function __construct(ClientService $clientService)
    {
        $this->client = $clientService;

//        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $input = $request->all();

        $clients = $this->client->all($input);

//        $dataTable = DataTables::of($data)->make(true);

        return view('home', compact('clients'));
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

    public function edit(int $id)
    {
        $client = $this->client->find($id);

        return view('client.edit', compact('client'));
    }

    public function update(ClientValidation $request, int $id)
    {
        $input = $request->all();

        $this->client->update($input, $id);

        return redirect()->route('clients.index');
    }

    public function destroy(int $id)
    {
        try {
            $data = $this->client->delete($id);

            return response()->json($data, 200);

        } catch (\Exception $e) {

            return response()->json($e->getMessage(), 400);
        }
    }
}
