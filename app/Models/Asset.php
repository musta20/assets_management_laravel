<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Asset extends Model
{
    use HasFactory, HasUlids, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'category_id',
        'location_id',
        'vendor_id',
        'status',
        'purchase_date',
        'purchase_price',
        'serial_number',
        'warranty_information',
        'depreciation_method',
    ];

    // Relationships
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function maintenanceRecords()
    {
        return $this->hasMany(Maintenance::class);
    }

    public function media()
    {
        return $this->hasMany(Media::class);
    }
}
