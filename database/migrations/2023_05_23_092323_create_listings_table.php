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
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->string('description',255)->default('Дане оголошення управляється контакт-центром МаркетЗем в інтересах власника ділянки.')->nullable();
            $table->string('cadastral_number',22);
            $table->date('rental_status')->nullable();
            $table->float('square');
            $table->float('rental_price')->nullable();
            $table->float('price')->nullable();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('city_id')->constrained('cities');
            $table->foreignId('assignment_id')->constrained('assignments');
            $table->boolean('approved')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
};
