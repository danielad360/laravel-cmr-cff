<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceTable extends Migration
{
    public function up()
    {
        Schema::create('invoice', function (Blueprint $table) {
            $table->id();

            $table->json('parts')->nullable();
            $table->json('products')->nullable();
            $table->string('from')->nullable();
            $table->string('to')->nullable();
            $table->integer('invoice_number')->nullable();
            $table->integer('amount')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('invoice');
    }
}
