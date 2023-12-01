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
        Schema::create('memeber_incames', function (Blueprint $table) {
            $table->increments('memeber_incame_id');
            $table->unsignedBigInteger('id_user');
                $table->foreign('id_user')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->string('amount')->nullable();
            $table->string('currency')->nullable();
            $table->string('totalTND')->nullable();
            $table->string('totalUSD')->nullable();
            $table->string('totalEUR')->nullable();
            $table->string('from_name')->nullable();
            $table->string('to_name')->nullable();
            $table->string('type')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('memeber_incames');
    }
};
