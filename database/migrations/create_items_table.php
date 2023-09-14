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
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id_item');
            $table->unsignedBigInteger('user_id');
                $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->string('ticket_id');
                $table->foreign('ticket_id')->references('ticket_id')->on('tickets');
            $table->string('ticket_date');
            $table->integer('id_region');
                $table->foreign('id_region')->references('id_region')->on('regions');
            $table->integer('id_currency');
                $table->foreign('id_currency')->references('id_carrency')->on('carrencies');
            $table->integer('id_icon');
                $table->foreign('id_icon')->references('id_icons')->on('icons');
            $table->integer('item_prix')->nullable();
            $table->integer('totalitem_prix')->nullable();
            $table->integer('item_quentity')->nullable();
            $table->integer('TND')->nullable();
            $table->integer('EUR')->nullable();
            $table->integer('USD')->nullable();
            $table->integer('totalTND')->nullable();
            $table->integer('totalEUR')->nullable();
            $table->integer('totalUSD')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
