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
        if (Schema::hasTable('orders') && Schema::hasColumn('orders', 'film_id')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->dropColumn('film_id');
            });
        }
    }
    
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->integer('film_id')->nullable();
        });
    }
    

};
