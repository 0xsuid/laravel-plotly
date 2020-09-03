<?php

namespace App\Http\Controllers;

use App\File;
use League\Csv\Reader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class FileUpload extends Controller
{
    public function index()
    {
        return view("graph");
    }

    public function csvFileUpload(Request $request)
    {
        
        $request->validate([
            'csvfile' => 'required|mimes:txt,csv|max:15360'
        ]);
        //load the CSV document from a file path
        $csv = Reader::createFromPath($request->file('csvfile')->path(), 'r');
        $csv->setHeaderOffset(0);

        $header = $csv->getHeader(); //returns the CSV header record
        $time_column = false;

        foreach ($header as $value) {
            if($value == "Time" || $value == "time") $time_column = true;
        }
        
        $fileModel = new File;
        
        if($time_column == true) {
            $fileName = time().'_'.$request->file('csvfile')->getClientOriginalName();
            $filePath = $request->file('csvfile')->storeAs('uploads', $fileName, 'public');
            // Alternative
            // Storage::disk('public')->putFileAs(
            //     'uploads',
            //     $request->file('csvfile'),
            //     $fileName
            // );
            $url_hash = Str::random(16);

            $fileModel->name = $fileName;
            $fileModel->url = $url_hash;
            $fileModel->file_path = '/storage/' . $filePath;
            $fileModel->save();

            return redirect('/plot/'.$url_hash);
        }
    }
}
