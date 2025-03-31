<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();

            $table->string('media_type');

            $table->string('name');
            $table->text('synopsis')->nullable();
            $table->string('backdrop_path')->nullable();
            $table->string('poster_path')->nullable();
            $table->date('release_date')->nullable();

            $table->text('note')->nullable();

            $table->boolean('watched')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
