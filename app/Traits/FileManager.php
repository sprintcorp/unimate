<?php


namespace App\Traits;


trait FileManager
{
    public function fileUpload($file)
    {
        return cloudinary()->uploadFile($file);
    }

    public function deleteFile($file_path)
    {

    }
}
