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
        Schema::table('lead_pipelines', function (Blueprint $table) {
            $table->tinyInteger('type')->default(\Webkul\Lead\Models\Pipeline::CUSTOMER_TYPE)->after('rotten_days');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lead_pipelines', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
};
