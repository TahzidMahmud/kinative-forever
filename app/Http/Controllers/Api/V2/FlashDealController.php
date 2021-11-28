<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Resources\V2\FlashDealCollection;
use App\Http\Resources\V2\ProductCollection;
use App\Http\Resources\V2\ProductMiniCollection;
use App\Models\FlashDeal;
use Illuminate\Http\Request;
use App\Models\Product;

class FlashDealController extends Controller
{
    public function index()
    {
        $flash_deals = FlashDeal::where('status', 1)->where('start_date', '<=', strtotime(date('d-m-Y')))->where('end_date', '>=', strtotime(date('d-m-Y')))->get();
        return new FlashDealCollection($flash_deals);
    }
    public function landing(){
        $flash_deal = FlashDeal::where('status', 1)->where('featured', 1)->get();

        $products = collect();
        foreach ($flash_deal[0]->flashDealProductsLand as $key => $flash_deal_product) {
            if(Product::find($flash_deal_product->product_id) != null){
                $products->push(Product::find($flash_deal_product->product_id));
            }
        }
        return new ProductMiniCollection($products);
    }
    public function banner(){
        $flash_deal = FlashDeal::where('status', 1)->where('featured', 1)->get();
        $banner=$flash_deal[0]->banner;
        return response(["banner"=>api_asset($banner)]);
    }


    public function products($id){
        $flash_deal = FlashDeal::find($id);
        $products = collect();
        foreach ($flash_deal->flashDealProducts as $key => $flash_deal_product) {
            if(Product::find($flash_deal_product->product_id) != null){
                $products->push(Product::find($flash_deal_product->product_id));
            }
        }
        return new ProductMiniCollection($products);
    }
}
