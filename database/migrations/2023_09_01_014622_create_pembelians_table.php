<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembelian', function (Blueprint $table) {
            $table->id();
            $table->string('kode_masuk',50);
            $table->date('tanggal_masuk');
            $table->double('total');
            $table->unsignedInteger('pemasok_id');
            $table->unsignedInteger('user_id');
            $table->timestamp('created_at')->default(DB::raw
            ('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw
            ('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembelian');
    }
};
