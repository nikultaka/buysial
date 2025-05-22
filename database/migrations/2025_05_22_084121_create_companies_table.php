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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('company_logo')->nullable();
            $table->string('company_name');
            $table->string('company_code')->unique();
            $table->string('company_email')->unique();
            $table->string('company_phone')->unique();
            $table->string('company_address');
            $table->string('company_city');
            $table->string('company_state');
            $table->string('company_zip');
            $table->string('company_country');
            $table->string('company_website')->nullable();
            $table->string('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
