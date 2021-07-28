<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKrsDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('krs_detail', function (Blueprint $table) {
            $table->id();
            $table->string('krs_kode');
            $table->string('mata_kuliah_kode');

            $table->foreign('krs_kode')
                    ->references('kode')
                    ->on('krs')
                    ->onDelete('cascade');

            $table->foreign('mata_kuliah_kode')
                    ->references('kode')
                    ->on('mata_kuliah')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('krs_detail');
    }
}
