<?php

namespace App\Contracts\Services;
use App\Http\Requests\SystemFileRequest;
use Illuminate\Http\Request;

interface SystemFileServiceInterface
{
    public function uploadTmpFile($request);

    public function deleteTmpFile($request);

    public function saveImageToDirectory($uploadFilePath, $imageName, $folderName);
  
    public function deleteImageFromDirectory($image, $folderName);
}
