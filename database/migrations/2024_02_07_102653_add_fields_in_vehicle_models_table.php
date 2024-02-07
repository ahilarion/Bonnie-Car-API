<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('vehicle_models', function (Blueprint $table) {
            $table->enum('gearbox', ['automatic','manual'])->after('estimated_price');
            $table->enum('fuel_type', ['gasoline', 'petrol', 'diesel', 'propane', 'compressed natural gas', 'liquefied petroleum gas', 'ethanol', 'methanol', 'biodiesel', 'hydrogen'])->after('gearbox');
            $table->decimal('horse_power', 10, 2)->after('fuel_type');
            $table->decimal('consumption', 10, 2)->after('horse_power');
            $table->decimal('release_year', 10, 2)->after('consumption');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vehicle_models', function (Blueprint $table) {
            $table->dropColumn('gearbox');
            $table->dropColumn('fuel_type');
            $table->dropColumn('horse_power');
            $table->dropColumn('consumption');
            $table->dropColumn('release_year');
        });
    }
};
