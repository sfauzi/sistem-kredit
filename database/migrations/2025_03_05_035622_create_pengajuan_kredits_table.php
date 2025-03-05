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
        Schema::create('pengajuan_kredits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('konsumen_id');
            $table->string('merk_kendaraan');
            $table->string('model_kendaraan');
            $table->string('warna_kendaraan');
            $table->decimal('harga_kendaraan', 15, 2);
            $table->integer('tenor');
            $table->decimal('dp_persen', 5, 2);
            $table->decimal('dp_nominal', 15, 2);
            $table->enum('status', [
                'draft',
                'menunggu_approval',
                'disetujui',
                'ditolak'
            ])->default('draft');
            $table->text('catatan_approval')->nullable();
            $table->unsignedBigInteger('marketing_id')->nullable();
            $table->unsignedBigInteger('approver_id')->nullable();
            $table->timestamps();

            $table->foreign('konsumen_id')->references('id')->on('konsumens');
            $table->foreign('marketing_id')->references('id')->on('users');
            $table->foreign('approver_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_kredits');
    }
};
