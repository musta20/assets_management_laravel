<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Media extends Model
{
    use HasFactory, HasUuids, SoftDeletes;


    protected $fillable = [
        'asset_id', 
        'media_type', 
        'file_name', 
        'file_path', 
        'description'
    ];

    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }
}
