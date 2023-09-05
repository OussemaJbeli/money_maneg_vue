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
            $table->id();
            $table->unsignedBigInteger('user_id');
                $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->string('ticket_id');
                $table->foreign('ticket_id')->references('ticket_id')->on('tickets');
            $table->integer('id_region');
                $table->foreign('id_region')->references('id')->on('regions');
            $table->integer('id_currency');
                $table->foreign('id_currency')->references('id')->on('carrencies');
            $table->string('item_name');
            $table->integer('item_prix');
            $table->integer('item_quentity');
            $table->timestamps();
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
