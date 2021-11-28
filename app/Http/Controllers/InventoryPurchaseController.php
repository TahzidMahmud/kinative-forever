<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\InventorySupplier;
use App\InventoryPurchase;
use App\InventoryStock;
use App\ProductStock;

class InventoryPurchaseController extends Controller
{
	public function index(Request $request)
    {
        $products = ProductStock::join('products','product_stocks.product_id', '=', 'products.id')
                        ->where('products.added_by', 'admin')
                        ->select('products.*','product_stocks.id as stock_id','product_stocks.variant','product_stocks.price as stock_price', 'product_stocks.qty as stock_qty', 'product_stocks.image as stock_image')
                        ->orderBy('products.created_at', 'desc')
                        ->get();
        $suppliers = InventorySupplier::latest()->get();

        $purchases = InventoryPurchase::latest()->paginate(15);   

    	return view('backend.inventory.purchase.index',compact('suppliers','products','purchases'));
    }
	public function edit(Request $request)
    {
    	return view('backend.inventory.purchase.edit');
    }
	public function show(Request $request,$id)
    {   
        $purchase = InventoryPurchase::findOrFail($id);
    	return view('backend.inventory.purchase.show',compact('purchase'));
    }
	public function store(Request $request)
    {
        $purchase = new InventoryPurchase;
        $purchase->inventory_supplier_id = $request->supplier;
        $purchase->invoice_number = $request->invoice_number;
        $purchase->paid = $request->paid;
        $purchase->due = $request->due;
        $purchase->total = $request->total;
        $purchase->save();

        foreach ($request->product_ids as $key => $product_id) {
            $product_stock = ProductStock::findOrFail($product_id);
            $product_stock->qty += $request->product_qtys[$key];
            $product_stock->price = $request->selling_prices[$key];
            $product_stock->save();


            $invent_stock = new InventoryStock;
            $invent_stock->inventory_purchase_id = $purchase->id;
            $invent_stock->product_id = $product_stock->product->id;
            $invent_stock->product_stock_id = $product_id;
            $invent_stock->unit_purchase_price = $request->purchase_prices[$key];
            $invent_stock->unit_selling_price = $request->selling_prices[$key];
            $invent_stock->purchased_qty = $request->product_qtys[$key];
            $invent_stock->remaining_qty = $request->product_qtys[$key];
            $invent_stock->total_purchase_price = $request->purchase_prices[$key]*$request->product_qtys[$key];
            $invent_stock->save();
        }

        flash(translate('New purchase added successfully'))->success();
    	return back();
    }
	public function update(Request $request)
    {
    	return view('backend.inventory.purchase.create');
    }
}