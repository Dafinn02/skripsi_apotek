<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('shift_id');
            $table->foreign('shift_id')->references('id')->on('shifts')->onDelete('cascade');
            $table->date('date');
            $table->string('customer_name')->nullable();
            $table->string('customer_phone')->nullable();
            $table->unsignedBigInteger('service_cost')->default('0');
            $table->unsignedBigInteger('emblase_cost')->default('0');
            $table->unsignedBigInteger('shipping_cost')->default('0');
            $table->unsignedBigInteger('lainnya')->default('0');
            $table->enum('discount_type',['fix_price','percentage'])->nullable(); 
            $table->unsignedBigInteger('discount')->default('0');
            $table->unsignedBigInteger('grandtotal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
