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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('table_id');
            $table->string('note')->nullable();
            $table->double('total_price', 9, 0);
            $table->enum('status',['Xác Nhận','Đã Xác Nhận','Hủy','Đã Thanh Toán']);
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->date('order_day');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
