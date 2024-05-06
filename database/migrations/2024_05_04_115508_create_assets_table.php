<?php

use App\Enums\AssetsStatus;
use App\Enums\ItemType;
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
        Schema::create('assets', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('name'); // Asset name
            $table->text('description')->nullable(); // Optional description
            $table->foreignUlid('category_id')->constrained(); // Foreign key to categories table
            $table->foreignUlid('location_id')->constrained(); // Foreign key to locations table
            $table->foreignUlid('vendor_id')->constrained(); // Foreign key to vendors table
            $table->string('status')->default(AssetsStatus::in_use->value); // Asset status (e.g., in_use, maintenance, disposed)
            $table->date('purchase_date');
            $table->string('item_type')->default(ItemType::PHYSICAL->value); // Type of item (e.g., physical, digital)
            $table->decimal('purchase_price', 10, 2); // Price with decimal precision
            $table->string('serial_number')->nullable(); // Optional serial number
            $table->string('warranty_information')->nullable(); // Optional warranty details
            $table->string('depreciation_method')->nullable(); // Depreciation method (e.g., straight-line)
            $table->string('barcode')->nullable(); 
            $table->softDeletes();
            $table->timestamps(); // Created_at and updated_at timestamps

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
