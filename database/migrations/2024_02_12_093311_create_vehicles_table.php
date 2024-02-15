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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->string('constructor')->nullable();
            $table->string('model')->nullable();
            $table->float('original_price')->nullable();
            $table->string('type')->nullable();
            $table->boolean('is_two_wheeled')->nullable();
            $table->string('energy_source')->nullable();
            $table->string('transmission')->nullable();
            $table->integer('cylinder_capacity')->unsigned()->nullable();
            $table->integer('power')->unsigned()->nullable();
            $table->integer('torque')->unsigned()->nullable();
            $table->year('year_of_manufacture')->nullable();
            $table->year('production_year')->nullable();
            $table->date('circulation_date')->nullable();
            $table->date('technical_revision')->nullable();
            $table->integer('number_of_owners')->unsigned()->nullable();
            $table->float('kilometers')->nullable();
            $table->string('color')->nullable();
            $table->integer('number_of_doors')->unsigned()->nullable();
            $table->integer('seats')->unsigned()->nullable();
            $table->float('vehicle_length')->nullable();
            $table->string('condition')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
