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
        Schema::create('memberships', function (Blueprint $table) {
            $table->id();
            $table->integer('is_freezed')->default(0);
            $table->integer('freeze_right_count');
            $table->timestamp('freeze_starting_date')->nullable();
            $table->timestamp('freeze_expiration_date')->nullable();
            $table->timestamp('starting_date');
            $table->timestamp('expiration_date');
            $table->integer('package_period');
            $table->boolean('is_student');
            $table->boolean('is_vip');
            $table->integer('package_cost');
            $table->unsignedBigInteger('member_id');
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
            $table->unsignedBigInteger('package_id');
            $table->foreign('package_id')->references('id')->on('packages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('memberships');
    }
};
