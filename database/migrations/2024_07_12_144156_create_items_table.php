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
        Schema::create('items', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('item_type_id');
            $table->unsignedBigInteger('unit_type_id');

            $table->string('name');
            $table->string('item_code')->unique();
            $table->bigInteger('stock')->default(0);
            $table->bigInteger('reorder_level');
            $table->integer('price');
            $table->string('photo');

            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('item_type_id')->references('id')->on('item_types')->onDelete('cascade');
            $table->foreign('unit_type_id')->references('id')->on('unit_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
