<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('infaqs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_donatur');
            $table->decimal('jumlah', 15, 0);
            $table->date('tanggal');
            $table->string('no_wa')->nullable();
            $table->text('keterangan')->nullable();
            $table->enum('status', ['pending', 'confirmed'])->default('confirmed');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('infaqs');
    }
};
