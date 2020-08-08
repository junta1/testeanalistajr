<?php

namespace CustomerManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use CustomerManagement\Service\AddressService;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    protected $address;

    public function __construct(AddressService $addressService)
    {
        $this->address = $addressService;
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

    public function store(Request $request, int $idClient)
    {
        try {
            $input = $request->all();

            $data = $this->address->save($input, $idClient);

            return response()->json($data, 200);

        } catch (\Exception $e) {

            return response()->json($e->getMessage(), 400);
        }
    }

    public function update(Request $request, int $id)
    {
        try {
            $input = $request->all();

            $data = $this->address->update($input, $id);

            return response()->json($data, 200);

        } catch (\Exception $e) {

            return response()->json($e->getMessage(), 400);
        }
    }

    public function destroy(int $id, int $idClient)
    {
        try {
            $data = $this->address->delete($id, $idClient);

            return response()->json($data, 200);

        } catch (\Exception $e) {

            return response()->json($e->getMessage(), 400);
        }
    }
}
