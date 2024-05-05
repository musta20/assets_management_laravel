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
        Schema::create('vendors', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('name'); // Vendor name
            $table->string('contact_person')->nullable(); // Optional contact person name
            $table->string('phone_number')->nullable(); // Optional phone number
            $table->string('email')->nullable(); // Optional email address
            $table->string('address')->nullable(); // Optional address
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendors');
    }
};
