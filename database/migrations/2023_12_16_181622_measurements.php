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
        // Schema::create('measurements', function (Blueprint $table) {
        //     $table->id();
        //     $table->float('weight');
        //     $table->float('arm');
        //     $table->float('chest');
        //     $table->float('shoulders');
        //     $table->float('waist');
        //     $table->float('legs');
        //     $table->float('hips');
        //     $table->unsignedBigInteger('member_id');
        //     $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       // Schema::dropIfExists('measurements');
    }
};
