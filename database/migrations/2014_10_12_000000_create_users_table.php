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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');

            $table->string('noms')->nullable();
            $table->string('prenoms')->nullable();
            $table->date('date_naissance')->nullable();
            $table->string('sexe')->default('Masculin');
            $table->string('photo')->default(url('assets/photos/avatar.png'));

            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            $table->string('phone')->nullable();
            $table->string('role')->default('Agent');

            $table->string('code_secret')->nullable();
            $table->string('adresse')->nullable();
            $table->string('profession')->nullable();

            $table->string('code_vote')->nullable();
            $table->string('parti_politique')->nullable();
            $table->string('logo_parti_politique')->default(url('assets/partis/logo.png'));
            $table->mediumText('programme_parti_politique')->nullable();

            $table->integer('statut')->default(0);
            $table->integer('active')->default(0);
            
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
