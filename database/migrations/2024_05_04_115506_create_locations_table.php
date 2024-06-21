<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('locations', function (Blueprint $table) {

            $table->ulid('id')->primary(); // Primary key
            $table->string('name'); // Location name
            $table->text('description')->nullable(); // Optional description
            $table->string('address')->nullable(); // Optional address
            $table->softDeletes();
            $table->timestamps(); // created_at and updated_at timestamps
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
