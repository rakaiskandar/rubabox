<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->string('file_code')->primary();
            $table->string('file_name');
            $table->string('subsi_code');
            $table->string('file');
            $table->string('section');
            $table->string('type');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('subsi_code')->references('subsi_code')->on('subsis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files');
    }
}
