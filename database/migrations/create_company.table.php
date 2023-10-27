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
        Schema::create('companys', function (Blueprint $table) {
            $table->string('company_id')->primary();
            $table->string('invitation_code')->unique();
            $table->string('name')->nullable();
            $table->string('type')->nullable();
            $table->string('discription')->nullable();
            $table->string('avatar')->nullable();
            $table->string('main_currency')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companys');
    }
};
