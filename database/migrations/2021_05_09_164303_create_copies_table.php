<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCopiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('copies', function (Blueprint $table) {
            $table->id();
            $table->string('copy_id');
            $table->string('editorial');
            $table->unsignedInteger('pages');
            $table->string('image_url');
            $table->foreignId('book_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('copies');
    }
}
