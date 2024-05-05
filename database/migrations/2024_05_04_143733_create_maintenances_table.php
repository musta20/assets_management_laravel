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
        Schema::create('maintenances', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('asset_id')->constrained(); // Foreign key to assets table
            $table->date('date'); // Date of maintenance
            $table->string('type'); // Type of maintenance (e.g., preventive, corrective)
            $table->text('description')->nullable(); // Optional description
            $table->foreignUlid('technician_id')->constrained('users'); // Foreign key to users table (technician)
            $table->decimal('cost', 10, 2)->nullable(); // Optional cost with decimal precision
            $table->timestamps(); // created_at and updated_at timestamps
            $table->softDeletes();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenances');
    }
};
