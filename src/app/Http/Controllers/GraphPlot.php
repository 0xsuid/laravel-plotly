<?php

namespace App\Http\Controllers;

use App\File;
use League\Csv\Reader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GraphPlot extends Controller
{
    public function index(Request $request, $url_hash)
    {
        $csvData = File::where('url', $url_hash)->first();
        if ($csvData) { 
            $path = Storage::disk('public')->path('uploads/'.$csvData->name);
            $csv = Reader::createFromPath($path, 'r');
            $csv->setHeaderOffset(0);
    
            $header = $csv->getHeader();
            return json_encode($csv, JSON_PRETTY_PRINT);
        }

    }
    
}
