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
        Schema::create('zalo_templates', function (Blueprint $table) {
            $table->id();
            $table->string('template_id');
            $table->string('template_name');
            $table->string('created_time')->nullable();
            $table->string('status')->nullable();
            $table->string('template_quality')->nullable();
            $table->string('timeout')->nullable();
            $table->string('template_tag')->nullable();
            $table->string('price')->nullable();
            $table->timestamps();

            $table->index('template_id');
        });

        Schema::create('zalo_template_info', function (Blueprint $table) {
            $table->id();
            $table->string('template_id');
            $table->string('name');
            $table->boolean('require')->default(1);
            $table->string('type')->nullable();
            $table->string('max_length')->nullable();
            $table->string('min_length')->nullable();
            $table->boolean('accept_null')->default(0);
            $table->timestamps();

            $table->index('template_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zalo_templates');
        Schema::dropIfExists('zalo_template_info');
    }
};
