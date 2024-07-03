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
        Schema::create('payment_gives', function (Blueprint $table) {
            $table->id();
            $table->integer('member_id')->nullable();
            $table->double('dollar')->nullable();
            $table->double('rate')->nullable();
            $table->double('amount')->nullable();
            $table->tinyInteger('payment_status')->nullable();
            $table->foreignId('add_by')->nullable();
            $table->foreignId('update_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_gives');
    }
};
