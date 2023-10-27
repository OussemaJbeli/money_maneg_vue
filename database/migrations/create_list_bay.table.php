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
        Schema::create('list_buys', function (Blueprint $table) {
            $table->increments('list_id');
            $table->unsignedBigInteger('user_id');
                $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('id_currency');
                $table->foreign('id_currency')->references('id_carrency')->on('carrencies');
            $table->string('title')->nullable();
            $table->integer('item_prix')->nullable();
            $table->integer('totalitem_prix')->nullable();
            $table->integer('item_quentity')->nullable();
            $table->integer('TND')->nullable();
            $table->integer('EUR')->nullable();
            $table->integer('USD')->nullable();
            $table->integer('totalTND')->nullable();
            $table->integer('totalEUR')->nullable();
            $table->integer('totalUSD')->nullable();
            $table->string('discription')->nullable();
            $table->boolean('buy')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('list_buys');
    }
};
