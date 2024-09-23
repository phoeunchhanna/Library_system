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
        Schema::create('borrow_book', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('gender');
            $table->string('address');
            $table->string('phone');
            $table->string('image')->nullable();

            $table->unsignedBigInteger('book_id');
            $table->unsignedBigInteger('class_id'); 


     
            $table->dateTime('borrowed_at')->nullable();
            $table->dateTime('returned_at')->nullable();
            $table->integer('booking');
            $table->integer('status')->default(1); 

            $table->timestamps();

            $table->foreign('book_id')->references('id')->on('book')->onDelete('cascade');
            $table->foreign('class_id')->references('id')->on('class')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrow_book');
    }
};
