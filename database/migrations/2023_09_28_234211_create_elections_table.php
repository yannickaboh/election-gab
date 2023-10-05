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
        Schema::create('elections', function (Blueprint $table) {
            $table->id();

            $table->string('type_election')->nullable();

            $table->string('code')->nullable();
            $table->string('libelle')->nullable();

            $table->date('date_debut')->nullable();
            $table->date('date_fin')->nullable();

            $table->mediumText('code_electoral')->nullable();
            $table->string('code_electoral_pdf')->default(url('assets/elections/code_electoral.pdf'));

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
        Schema::dropIfExists('elections');
    }
};
