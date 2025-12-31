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
        Schema::create('stock_movements', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();            // Nomor transaksi
            $table->date('movement_date');               // Tanggal transaksi

            $table->enum('type', ['in', 'out']);         // Masuk / Keluar

            $table->string('source')->nullable();        // Supplier / Gudang / Proyek
            $table->text('notes')->nullable();           // Catatan
            $table->foreignId('created_by')->constrained('users')->cascadeOnDelete();           // Penanggung Jawab

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_movements');
    }
};
