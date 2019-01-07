<?php

namespace App\Model\Purchase\PurchaseOrder;

use App\Model\Master\Allocation;
use App\Model\Master\Item;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderItem extends Model
{
    protected $connection = 'tenant';

    public $timestamps = false;

    protected $fillable = [
        'item_id',
        'quantity',
        'price',
        'discount_percent',
        'discount_value',
        'taxable',
        'unit',
        'converter',
        'description',
        'allocation_id',
    ];

    protected $casts = [
        'quantity'         => 'double',
        'price'            => 'double',
        'discount_percent' => 'double',
        'discount_value'   => 'double',
        'converter'        => 'double',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function allocation()
    {
        return $this->belongsTo(Allocation::class);
    }
}