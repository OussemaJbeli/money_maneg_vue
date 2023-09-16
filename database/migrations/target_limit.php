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
        Schema::create('target_limits', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedBigInteger('user_id');
                $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            
            $table->integer('id_currency');
                $table->foreign('id_currency')->references('id_carrency')->on('carrencies');
            
            $table->integer('limit_type')->nullable();
            $table->date('start_date')->nullable();
            $table->date('reset_date')->nullable();

            $table->integer('limitTND')->nullable();
            $table->integer('limitUSD')->nullable();
            $table->integer('limitEUR')->nullable();

            $table->integer('avrig_perdayTND')->nullable();
            $table->integer('avrig_perdayUSD')->nullable();
            $table->integer('avrig_perdayEUR')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('target_limits');
    }
};
