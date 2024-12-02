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
        Schema::create('zalo_configs', function (Blueprint $table) {
            $table->id();
            $table->integer('template_offset')->default(0);
            $table->integer('template_limit')->default(100);
            $table->text('access_token')->nullable();
            $table->text('refresh_token')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zalo_configs');
    }
};
