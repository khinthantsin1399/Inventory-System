<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\Services\SystemFileServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\SystemFileRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class SystemFileController extends Controller 
{
    /**
    * SystemFileService
    *
    * @var SystemFileServiceInterface
    */
    private $systemFileService;

    /**
    * Constructor function
    *
    * @param SystemFileServiceInterface $systemFileService
    */

    public function __construct( SystemFileServiceInterface $systemFileService ) 
    {
        $this->systemFileService = $systemFileService;
    }

    /**
    * upload file to tmp folder
    *
    * @param SystemFileRequest $request
    * @return Response
    */

    public function uploadTmpFile( SystemFileRequest $request ): Response 
    {
        $response = $this->systemFileService->uploadTmpFile( $request );
        return $response;
    }

    /**
    * delete file from temp storage
    *
    * @return JsonResponse
    */

    public function deleteTmpFile(): JsonResponse 
    {
        $this->systemFileService->deleteTmpFile( request() );
        return \Response::json( [ 'message' => 'success' ], 200 );
    }
}
