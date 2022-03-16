<?php

namespace App\Http\Controllers;

use App\Imports\UsersImport as ImportsUsersImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use ZipArchive;

class ImportExcelController extends Controller
{
    function index()
    {
       return view('import_excel');
    }

    function import(Request $request)
    {
        $this->validate($request, [
        'select_file'  => 'required|mimes:xls,xlsx'
        ]);

        // $path = $request->file('select_file')->getRealPath();
        $path1 = $request->file('select_file')->store('temp'); 
        $path=storage_path('app').'/'.$path1;  
        $array = Excel::toArray(new ImportsUsersImport, $path);

        foreach($array as $value)
        {
            foreach($value as $key => $row)
            {
                if ($key != 0) {
                    header('Content-type: image/jpeg');
                    $font='https://save-the-strays.herokuapp.com/public/assets/certificate/arial.ttf';
                    $path = 'https://save-the-strays.herokuapp.com/assets/certificate/format.jpg';
                    $image=imagecreatefromjpeg($path);
                    $color=imagecolorallocate($image, 51, 51, 102);
                    $date=date('d F, Y');
                    imagettftext($image, 18, 0, 880, 188, $color,$font, $date);
                    $name=$row[0];
                    imagettftext($image, 48, 0, 120, 520, $color,$font, $name);
                    imagejpeg($image,"storage/app/certificate/generated-certificate/" . $name . ".jpg");
                    //imagejpeg($image);
                    // imagedestroy($image);
                }
            }
            $zip      = new ZipArchive;
            $fileName = 'attachment.zip';
            if ($zip->open(public_path($fileName), ZipArchive::CREATE) === TRUE) {
                $files = File::files('storage/app/certificate/generated-certificate');
                foreach ($files as $key => $value) {
                    $relativeName = basename($value);
                    $zip->addFile($value, $relativeName);
                }
            $zip->close();
            }
            return response()->download(public_path($fileName));
        }

        // return $array;
    }
}
