<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->enum('status_bayar', ['sudah bayar', 'belum bayar'])->default('belum bayar');
            $table->enum('status_pengerjaan', ['selesai', 'menunggu', 'sedang dikerjakan'])->default('sedang dikerjakan');
            $table->date('tanggal');
            $table->string('no_wa');
            $table->string('alamat');
            $table->string('no_reference');
            $table->bigInteger('grand_total');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksis');
    }
}
