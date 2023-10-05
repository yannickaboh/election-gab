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
        Schema::create('enrollements', function (Blueprint $table) {
            $table->id();

            $table->string('code')->nullable();

            $table->integer('candidat_id')->nullable();
            $table->integer('citoyen_id')->nullable();

            $table->integer('election_id')->nullable();

            $table->integer('centre_id')->nullable();
            $table->integer('bureau_id')->nullable();

            $table->string('role')->nullable();

            $table->integer('statut')->default(0);
            $table->integer('active')->default(0);


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enrollements');
    }
};
