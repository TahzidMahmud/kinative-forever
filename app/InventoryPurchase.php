<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class InventoryPurchase extends Model
{
	protected $guarded = [];
	protected $fillable = [];
	
	public function inventory_stock(){
    	return $this->hasMany(InventoryStock::class);
    }
    public function inventory_supplier(){
        return $this->belongsTo(InventorySupplier::class);
    }
}