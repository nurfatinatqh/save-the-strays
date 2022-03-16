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

        $path = $request->file('select_file')->getRealPath();

        $array = Excel::toArray(new ImportsUsersImport, $path);

        foreach($array as $value)
        {
            foreach($value as $key => $row)
            {
                if ($key != 0) {
                    header('Content-type: image/jpeg');
                    $font='C:\Users\nurfa\OneDrive\Documents\Save-The-Strays\public\storage\app\certificate\arial.ttf';
                    $path = 'storage\app\certificate\format.jpg';
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
            $files = File::files(public_path('storage/app/certificate/generated-certificate'));
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
