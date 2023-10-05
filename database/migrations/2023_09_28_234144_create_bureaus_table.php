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
        Schema::create('bureaus', function (Blueprint $table) {
            $table->id();

            $table->string('code')->nullable();

            $table->string('type_bureau')->nullable();
            $table->string('libelle')->nullable();
            $table->string('adresse')->nullable();
            $table->string('phone')->nullable();

            $table->integer('ville_id')->nullable();
            $table->integer('centre_id')->nullable();
            $table->integer('responsable_id')->nullable();

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
        Schema::dropIfExists('bureaus');
    }
};
