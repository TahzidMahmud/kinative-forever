<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\InventorySupplier;

class InventorySupplierController extends Controller
{
	public function index(Request $request)
    {
        $suppliers = InventorySupplier::latest()->paginate(15);   
    	return view('backend.inventory.supplier.index',compact('suppliers'));
    }


	public function edit(Request $request,$id)
    {
        $supplier = InventorySupplier::findOrFail($id);
    	return view('backend.inventory.supplier.edit',compact('supplier'));
    }


	public function show(Request $request)
    {

    }


	public function store(Request $request)
    {
        $supplier = new InventorySupplier;
        $supplier->name = $request->name;
        $supplier->contact_person = $request->contact_person;
        $supplier->phone = $request->phone;
        $supplier->email = $request->email;
        $supplier->address = $request->address;
        $supplier->save();

        flash(translate('New supplier added successfully'))->success();

    	return back();
    }


	public function update(Request $request,$id)
    {   
        $supplier = InventorySupplier::findOrFail($id);
        $supplier->name = $request->name;
        $supplier->contact_person = $request->contact_person;
        $supplier->phone = $request->phone;
        $supplier->email = $request->email;
        $supplier->address = $request->address;
        $supplier->save();

        flash(translate('Supplier information updated successfully'))->success();

    	return redirect()->route('inventory-supplier.index');
    }
}