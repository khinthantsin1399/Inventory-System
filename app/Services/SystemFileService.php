<?php

namespace App\Services;

use App\Contracts\Services\SystemFileServiceInterface;
use App\Http\Requests\SystemFileRequest;
use CustomFile;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class SystemFileService implements SystemFileServiceInterface 
{
    /**
    * upload file to tmp folder
    *
    * @param SystemFileRequest $request
    * @return Response
    */
    public function uploadTmpFile($request): Response 
    {
        $sName = $request[ 'storage' ] ?? 'form_image';
        $fileName = Str::random( 40 ) . '.' . request()->file( 'file' )->getClientOriginalExtension();
        $file = CustomFile::storage( 'tmp', $sName )->putFileAs( '', request()->file( 'file' ), $fileName );

        return response( [ 'path' => $file, 'url' => CustomFile::tmpUrl( [ 'tmp', $file ], Carbon::now()->addDays( 2 ), $sName ) ] );
    }

    /**
    * delete image from tmp folder
    *
    * @param Request $request
    * @return void
    */
    public function deleteTmpFile($request) 
    {
        $fileName = $request[ 'tmp_file_name' ];
        $sName = 'form_image';
        $storage = CustomFile::storage( 'tmp', $sName );
        abort_if ( !$storage->exists( $fileName ), 404 );
        $storage->delete( $fileName );
    }

    /**
    * save image from tmp folder to specific directory
    *
    * @param string|null $uploadFilePath
    * @param string|null $imageName
    * @param string $folderName
    * @return void
    */
    public function saveImageToDirectory($uploadFilePath, $imageName, $folderName) 
    {
        if ( empty( $uploadFilePath ) || empty( $imageName ) ) return;

        $storage = CustomFile::storage();
        $srcPath = 'tmp' . DIRECTORY_SEPARATOR . $uploadFilePath;
        $targetPath = $folderName . DIRECTORY_SEPARATOR . $imageName;
        abort_unless( $storage->exists( $srcPath ), 404 );
        $storage->copy( $srcPath, $targetPath );

        /**delete tmp file */
        $tmpStorage = CustomFile::storage( 'tmp' );
        $tmpStorage->delete( $uploadFilePath );
    }

    /**
    * delete image from directory
    *
    * @param string|null $image
    * @param string $folderName
    * @return void
    */
    public function deleteImageFromDirectory($image, $folderName) 
    {
        if ( empty( $image ) ) return;

        $storage = CustomFile::storage();
        $storage->delete( $folderName . DIRECTORY_SEPARATOR . $image );
    }
}
