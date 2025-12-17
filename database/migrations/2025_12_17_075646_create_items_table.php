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
            $table->foreignId('room_id')
            ->constrained('rooms')
            ->cascadeOnDelete()->cascadeOnUpdate();
            
            $table->string('item_name');
            $table->string('item_code')->unique();
            $table->string('slug')->unique();
            $table->string('image');
            $table->integer('qty');
            $table->enum('condition', ['good','broken','maintenance'])->default('good');
            $table->text('desc');
            $table->timestamps();
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
