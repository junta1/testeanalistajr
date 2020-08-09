<?php

namespace CustomerManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use CustomerManagement\Service\AddressService;
use CustomerManagement\Service\ClientService;
use CustomerManagement\Validation\AddressValidation;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    protected $address;

    protected $client;

    public function __construct(AddressService $addressService, ClientService $clientService)
    {
        $this->address = $addressService;

        $this->client = $clientService;
    }

    public function index(int $idClient)
    {
        try {
            $data = $this->address->all($idClient);

            return response()->json($data, 200);

        } catch (\Exception $e) {

            return response()->json($e->getMessage(), 400);
        }
    }

    public function show(int $id)
    {
        try {
            $data = $this->address->find($id);

            return response()->json($data, 200);

        } catch (\Exception $e) {

            return response()->json($e->getMessage(), 400);
        }
    }

    public function create($idClient)
    {
        $client = $this->client->find($idClient);

        return view('address.create', compact('client'));
    }

    public function store(AddressValidation $request, int $idClient)
    {
        try {
            $input = $request->all();

            $this->address->save($input, $idClient);

            return redirect()->route('clients.index');

        } catch (\Exception $e) {

            return response()->json($e->getMessage(), 400);
        }
    }

    public function edit(int $id)
    {
        $address = $this->address->find($id);

        return view('address.edit', compact('address'));
    }

    public function update(AddressValidation $request, int $id)
    {
        try {
            $input = $request->all();

            $this->address->update($input, $id);

            return redirect()->route('clients.index');

        } catch (\Exception $e) {

            return response()->json($e->getMessage(), 400);
        }
    }

    public function destroy(int $id, int $idClient)
    {
        try {
            $this->address->delete($id, $idClient);

            return redirect()->route('clients.index');

        } catch (\Exception $e) {

            return response()->json($e->getMessage(), 400);
        }
    }
}
