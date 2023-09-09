<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class AwsFileUploadController extends Controller
{
    public function __construct()
    {
        define("S3_Upload_FolderFile", "uploded_file/");
        define("S3_Upload_FolderImage", "uploded_image/");
    }
    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    //composer require --with-all-dependencies league/flysystem-aws-s3-v3 "^1.0"
    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    //STYLE-1
    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function normal_file_upload(Request $request)
    {
        try {

            $image              = $request->file('picture');
            $file_document      = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath_s3 = S3_Upload_FolderImage . '/';
            $image->storeAs($destinationPath_s3, $file_document, 's3');
            $image_url = self::s3_full_path(S3_Upload_FolderImage, $file_document);
            return Response::json($image_url);

        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return Response::json($errorMessage);
        }

    }
    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    //STYLE-2
    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function base_64_file_upload(Request $request)
    {
        try {

            $dPath_s3     = S3_Upload_FolderFile . '/';
            $base64String = $request->base64file;
            $image        = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64String));
            $imageName    = time() . '_file_multi_data_.' . $request->extension;
            Storage::disk('s3')->put($dPath_s3 . $imageName, $image);
            $image_url = self::s3_full_path(S3_Upload_FolderFile, $imageName);
            return Response::json($image_url);

        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return Response::json($errorMessage);
        }

    }
    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    //Sub Function For The Link
    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    private function s3_full_path($path, $fileName)
    {
        return "https://code180-new-upload-all.s3.ap-southeast-1.amazonaws.com/" . $path . $fileName;
    }
//END
}
