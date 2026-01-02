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
            $table->string('name');                     // Nama barang
            $table->string('stock');                     // Stok barang
            $table->foreignId('unit_id')->constrained()->cascadeOnDelete();                     // Satuan (pcs, zak, kg, m3)

            $table->foreignId('category_id')            // Kategori barang
                ->constrained()
                ->nullOnDelete();

            $table->text('description')->nullable();    // Keterangan tambahan
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
