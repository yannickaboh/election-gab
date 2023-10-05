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
        Schema::create('mouchards', function (Blueprint $table) {
            $table->id();
            $table->string("ip_address")->nullable();
            $table->string("os_system")->nullable();
            $table->string("navigator")->nullable();
            $table->mediumText("author_action")->nullable();
            $table->integer("author_id")->nullable();
            $table->string("title")->nullable();
            $table->boolean("status")->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mouchards');
    }
};
