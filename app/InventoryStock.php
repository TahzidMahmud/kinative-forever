<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class InventoryStock extends Model
{
	protected $guarded = [];
	protected $fillable = [];

	public function inventory_purchase(){
        return $this->belongsTo(InventoryPurchase::class);
    }

	public function product(){
        return $this->belongsTo(Product::class);
    }

	public function product_stock(){
        return $this->belongsTo(ProductStock::class);
    }
	
}