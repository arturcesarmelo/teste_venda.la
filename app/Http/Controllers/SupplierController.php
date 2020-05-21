<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Supplier;

class SupplierController extends Controller
{

    public function index()
    {
        $suppliers = Supplier::all();

        return response()->json(compact('suppliers'), 200);
    }

    public function show($id) 
    {
        $supplier = Supplier::find($id);
        
        if (!$supplier)
            return response()->json(['message'=> "Supplier with ID: ${$id} could not be found"], 404);

        return response()->json($supplier, 200);
    }

    public function store(Request $request)
    {
        $this->validate($request, Supplier::rules());

        try {
            $supplier = Supplier::create($request->all());
            return response()->json($supplier, 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Supplier could not be created. Contact support!'], 500);
        }
    }
    
    public function update($id, Request $request)
    {
        $this->validate($request, Supplier::rules());

        try {
            $supplier = Supplier::find($id);

            if (!$supplier)
                return response()->json(['message'=> 'Supplier not found'], 404);
            
            $supplier->update($request->all());

            return response()->json($supplier, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Supplier could not be updated. Contact support!'], 500);
        }
    }

    public function destroy($id)
    {

        try {
            $supplier = Supplier::find($id);

            if (!$supplier)
                return response()->json(['message'=> 'Supplier not found'], 404);
            
            $supplier->delete();
        
        } catch (\Exception $e) {
            return response()->json(['message' => 'Supplier could not deleted. Contact support!'], 500);
        }
    }
}
