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
        Schema::create('entreprises', function (Blueprint $table) {
            $table->id('entreprise_id');
            $table->string('name');
            $table->string('slogan')->nullable();
            $table->string('adresse');
            $table->string('ville');
            $table->string('pays');
            $table->string('phone');
            $table->string('email')->unique();
            $table->string('site_web')->nullable();
            $table->string('logo')->nullable();
            $table->string('raison_sociale')->nullable();
            $table->string('registre_de_commerce')->nullable();
            $table->string('id_fiscal')->nullable();
            $table->string('description')->nullable();
            $table->string('rccm')->nullable();
            $table->string('niu')->nullable();

            $table->foreignId('admin_id')->nullable()->constrained('admins', 'admin_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entreprises');
    }
};
