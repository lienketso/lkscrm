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
        Schema::create('zalo_zns_messages', function (Blueprint $table) {
            $table->id();
            $table->string('phone')->nullable();
            $table->string('template_id')->nullable();
            $table->text('template_data')->nullable();
            $table->integer('status')->default(1);
            $table->string('tracking_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zalo_zns_messages');
    }
};
