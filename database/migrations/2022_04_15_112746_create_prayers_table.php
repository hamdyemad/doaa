<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prayers', function (Blueprint $table) {
            $table->id();
            $table->boolean('has_photo')->default(0); // العبارى الرئيسية
            $table->unsignedBigInteger('category_id'); // التصنيف
            $table->string('main_phrase')->nullable(); // العبارى الرئيسية
            $table->string('txt')->nullable(); //  النص
            $table->string('graduation')->nullable(); //  التخريج
            $table->text('photo')->nullable(); //  التخريج
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
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
        Schema::dropIfExists('prayers');
    }
};
