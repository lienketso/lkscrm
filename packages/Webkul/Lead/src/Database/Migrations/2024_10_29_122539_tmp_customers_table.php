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
        Schema::create('tmp_customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_kiotviet')->nullable();
            $table->string('code')->nullable();
            $table->string('name')->nullable();
            $table->string('gender')->nullable();
            $table->string('retailerId')->nullable();
            $table->string('branchId')->nullable();
            $table->string('locationName')->nullable();
            $table->string('wardName')->nullable();
            $table->string('type')->nullable();
            $table->string('organization')->nullable();
            $table->string('debt')->nullable();
            $table->string('totalInvoiced')->nullable();
            $table->string('totalRevenue')->nullable();
            $table->string('totalPoint')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tmp_customers');
    }
};
