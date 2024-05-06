<?php

namespace Database\Seeders;

use App\Models\Asset;
use App\Models\Media;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class AssetsMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $assets = Asset::get();

        $filesNames = glob(storage_path('seedImages/*'));

        $AllfilesNames = array_map(function($filePath) {

            return basename($filePath);

        }, $filesNames);
        
       

        Media::factory()
        ->count(count($AllfilesNames))
        ->sequence(fn (Sequence $sequence) => 
        [
            'asset_id' => $assets->random()->id,
            'file_name' => $this->copyImage($AllfilesNames),
            'file_path' => 'asset',
            'media_type' => 'image',
            
        ])
        ->create();
    }

    public function copyImage($arrayimage){

        $imageName = $arrayimage[array_rand($arrayimage)];
        $sourcePath = storage_path('seedImages/'.$imageName);



        Storage::disk('asset')->put($imageName, file_get_contents($sourcePath));
        
        // copy($sourcePath, $destinationPath);
        
        // \Illuminate\Support\Facades\Storage::disk('asset')->put($imageName, file_get_contents($destinationPath));
        
        // unlink($destinationPath);
    
        return $imageName;
    }



}
