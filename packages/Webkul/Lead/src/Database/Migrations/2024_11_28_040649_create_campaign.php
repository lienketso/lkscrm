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
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('campaign_schedules', function (Blueprint $table) {
            $table->id();
            $table->integer('campaign_id');
            $table->datetime('start_at');
            $table->integer('zalo_template_id');
            $table->timestamps();
            $table->softDeletes();

            $table->index('campaign_id');
            $table->index('zalo_template_id');
        });

        Schema::create('campaign_schedule_content', function (Blueprint $table) {
            $table->id();
            $table->integer('campaign_id');
            $table->integer('campaign_schedule_id');
            $table->integer('zalo_template_id');
            $table->integer('zalo_template_info_id');
            $table->string('content');
            $table->timestamps();
            $table->softDeletes();

            $table->index('campaign_id');
            $table->index('campaign_schedule_id');
            $table->index('zalo_template_id');
            $table->index('zalo_template_info_id');
        });

        Schema::create('campaign_customers', function (Blueprint $table) {
            $table->id();
            $table->integer('campaign_id');
            $table->integer('lead_id');
            $table->timestamps();
            $table->softDeletes();

            $table->index('campaign_id');
            $table->index('lead_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaign');
        Schema::dropIfExists('campaign_schedules');
        Schema::dropIfExists('campaign_schedule_content');
    }
};
