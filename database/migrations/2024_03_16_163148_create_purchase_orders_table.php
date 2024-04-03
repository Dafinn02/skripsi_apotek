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
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('number_letter');
            $table->date('date');
            $table->enum('payment_method',['cash','transfer']);
            $table->string('proof')->nullable();
            $table->date('payment_due_date')->nullable();
            $table->unsignedBigInteger('grandtotal');
            $table->string('information')->nullable();
            $table->enum('status',['plan','order'])->default('plan');
            $table->boolean('distribution')->default(false);
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_orders');
    }
};
