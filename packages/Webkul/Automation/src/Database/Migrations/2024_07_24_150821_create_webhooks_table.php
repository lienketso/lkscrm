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
        Schema::create('webhooks', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('entity_type')->nullable();
            $table->string('description')->nullable();
            $table->string('method')->nullable();
            $table->string('end_point')->nullable();
            $table->text('query_params')->nullable();
            $table->text('headers')->nullable();
            $table->string('payload_type')->nullable();
            $table->string('raw_payload_type')->nullable();
            $table->text('payload')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('webhooks');
    }
};
