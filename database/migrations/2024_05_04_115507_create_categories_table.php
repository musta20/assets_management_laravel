<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('name'); // Category name
            $table->text('description')->nullable(); // Optional description
            $table->foreignUlid('parent_id')->nullable(); // Optional description
            $table->softDeletes();
            $table->timestamps(); // created_at and updated_at timestamps

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
