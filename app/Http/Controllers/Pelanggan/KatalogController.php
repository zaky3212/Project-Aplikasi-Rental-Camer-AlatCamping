<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KatalogController extends Controller
{
    public function katalogCamera()
    {
        $categories = [
            ['name' => 'Camera', 'icon' => 'fa-camera'],
            ['name' => 'Lensa', 'icon' => 'fa-microscope'],
            ['name' => 'Tripod', 'icon' => 'fa-video'],
            ['name' => 'Baterai', 'icon' => 'fa-battery-full'],
            ['name' => 'Lampu', 'icon' => 'fa-lightbulb']
        ];

        return view('Katalog.Katalog_Camera', compact('categories'));
    }

   public function katalogCamping()
{
    $categories = [
        ['name' => 'Tenda', 'icon' => 'fa-campground'],
        ['name' => 'Carrier', 'icon' => 'fa-hiking'],
        ['name' => 'Cooking Set', 'icon' => 'fa-utensils'],
    ];

    // Jika file ada di resources/views/Katalog_Camping.blade.php
    return view('Katalog.Katalog_Camping', compact('categories'));
  
}

}

