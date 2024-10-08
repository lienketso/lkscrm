<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emails', function (Blueprint $table) {
            $table->increments('id');
            $table->string('subject')->nullable();
            $table->string('source');
            $table->string('user_type');
            $table->string('name')->nullable();
            $table->text('reply')->nullable();
            $table->boolean('is_read')->default(0);
            $table->text('folders')->nullable();
            $table->text('from')->nullable();
            $table->text('sender')->nullable();
            $table->text('reply_to')->nullable();
            $table->text('cc')->nullable();
            $table->text('bcc')->nullable();
            $table->string('unique_id')->nullable();
            $table->string('message_id')->nullable();
            $table->text('reference_ids')->nullable();

            $table->integer('person_id')->unsigned()->nullable();
            $table->foreign('person_id')->references('id')->on('persons')->onDelete('set null');

            $table->integer('lead_id')->unsigned()->nullable();
            $table->foreign('lead_id')->references('id')->on('leads')->onDelete('set null');

            $table->timestamps();
        });

        Schema::table('emails', function (Blueprint $table) {
            $table->integer('parent_id')->unsigned()->nullable();
            $table->foreign('parent_id')->references('id')->on('emails')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('emails');
    }
};
