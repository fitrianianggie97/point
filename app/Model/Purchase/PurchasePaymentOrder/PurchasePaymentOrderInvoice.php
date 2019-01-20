<?php

namespace App\Model\Purchase\PurchasePaymentOrder;

use App\Model\Purchase\PurchaseInvoice\PurchaseInvoice;
use App\Model\TransactionModel;

class PurchasePaymentOrderInvoice extends TransactionModel
{
    protected $connection = 'tenant';

    public $timestamps = false;

    protected $fillable = [
        'amount',
        'notes',
    ];

    protected $casts = [
        'amount' => 'double',
    ];

    public function paymentOrder()
    {
        return $this->belongsTo(PurchasePaymentOrder::class);
    }

    public function invoice()
    {
        return $this->belongsTo(PurchaseInvoice::class);
    }
}
