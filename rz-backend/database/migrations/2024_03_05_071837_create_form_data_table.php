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
        Schema::create('formdata', function (Blueprint $table) {
            $table->id();
            $table->string('title', 50);
            $table->enum('datasource', ['text','date','radiobox','text-area','combobox', 'checkbox'])->default('text');
            $table->enum('datatype', ['string', 'number', 'date', 'select', 'radio'])->default('string');
            $table->string('value')->nullable();
            $table->string('data_table', 50)->nullable();
            // $table->string('data_parameter', 50)->nullable();
            $table->mediumInteger('sorting')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_data');
        Schema::dropIfExists('formdata');
    }
};
