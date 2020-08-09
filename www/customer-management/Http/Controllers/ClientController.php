<?php
declare(strict_types=1);

namespace CustomerManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use CustomerManagement\Service\AddressService;
use CustomerManagement\Service\ClientService;
use CustomerManagement\Validation\ClientValidation;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ClientController extends Controller
{
    protected $client;

    protected $address;

    public function __construct(ClientService $clientService, AddressService $addressService)
    {
        $this->client = $clientService;

        $this->address = $addressService;

        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $input = $request->all();

        $clients = $this->client->all($input);

        if ($request->ajax()) {

            return Datatables::of($clients)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . url('client/' . $row['idClient']) . '" class="view btn btn-info btn-sm">View</a>';

                    $btn = $btn . '<a href="' . url('client/edit/' . $row['idClient']) . '" class="edit btn btn-primary btn-sm">Edit</a>';

                    $btn = $btn . '<a href="' . url('client/delete', $row['idClient']) . '" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('home', compact([
            'clients',
        ]));
    }

    public function show(int $id)
    {
        $client = $this->client->find($id);

        $addresses = $this->address->all($client['idClient']);

        return view('client.show', compact([
            'client',
            'addresses'
        ]));
    }

    public function create()
    {
        return view('client.create');
    }

    public function store(ClientValidation $request)
    {
        try {
            $input = $request->all();

            $this->client->save($input);

            return redirect()->route('clients.index');

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
        try {
            $input = $request->all();

            $this->client->update($input, $id);

            return redirect()->route('clients.index');

        } catch (\Exception $e) {

            return response()->json($e->getMessage(), 400);
        }
    }

    public function destroy(int $id)
    {
        try {
            $this->client->delete($id);

            return redirect()->route('clients.index');

        } catch (\Exception $e) {

            return response()->json($e->getMessage(), 400);
        }
    }
}
