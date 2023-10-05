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
        Schema::create('resultats', function (Blueprint $table) {
            $table->id();

            $table->integer('candidat_id')->nullable();

            $table->integer('election_id')->nullable();
            $table->integer('centre_id')->nullable();
            $table->integer('bureau_id')->nullable();

            $table->integer('nombre_votes')->default(0);
            $table->double('pourcentage_vote')->default(0.0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resultats');
    }
};
