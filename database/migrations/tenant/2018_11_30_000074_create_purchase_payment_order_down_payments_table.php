<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchasePaymentOrderDownPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_payment_order_down_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('purchase_payment_order_id');
            $table->unsignedInteger('purchase_down_payment_id');
            $table->unsignedInteger('chart_of_account_id');
            $table->unsignedDecimal('amount', 65, 30);
            $table->text('notes');

            $table->foreign('purchase_payment_order_id', 'purchase_payment_order_down_payments_payment_order_id_f')
                ->references('id')->on('purchase_payment_orders')->onDelete('cascade');
            $table->foreign('purchase_down_payment_id', 'purchase_payment_order_down_payments_down_payment_id_f')
                ->references('id')->on('purchase_down_payments')->onDelete('cascade');
            $table->foreign('chart_of_account_id', 'purchase_payment_order_down_payments_chart_of_account_id_f')
                ->references('id')->on('chart_of_accounts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_payment_order_down_payments');
    }
}
