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
        Schema::table('zalo_zns_messages', function (Blueprint $table) {
            
            $table->string('app_id')->nullable(); // ID của ứng dụng gửi tin (ứng dụng mà OA đã cấp quyền)

            $table->string('msg_id')->nullable(); // ID của thông báo ZNS.
            $table->string('sent_time')->nullable(); // Thời gian gửi thông báo ZNS (định dạng timestamp).

            $table->string('event_name')->nullable(); //Tên sự kiện
            $table->string('delivery_time')->nullable(); // Thời gian thiết bị của người dùng nhận được thông báo ZNS
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('zalo_zns_messages', function (Blueprint $table) {
            $table->dropColumn('app_id');
            $table->dropColumn('msg_id');
            $table->dropColumn('sent_time');
            $table->dropColumn('event_name');
            $table->dropColumn('delivery_time');
        });
    }
};
