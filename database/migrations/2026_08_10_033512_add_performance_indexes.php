<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('foods', function (Blueprint $table) {
            $table->index('status');
            $table->index('pickup_deadline');
        });

        Schema::table('claims', function (Blueprint $table) {
            $table->index('status');
        });

        Schema::table('restaurants', function (Blueprint $table) {
            $table->index('verification_status');
        });
    }

    public function down(): void
    {
        Schema::table('foods', function (Blueprint $table) {
            $table->dropIndex(['status']);
            $table->dropIndex(['pickup_deadline']);
        });

        Schema::table('claims', function (Blueprint $table) {
            $table->dropIndex(['status']);
        });

        Schema::table('restaurants', function (Blueprint $table) {
            $table->dropIndex(['verification_status']);
        });
    }
};