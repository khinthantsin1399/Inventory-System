<?php

namespace App\Lib\File;

use Illuminate\Support\Facades\Facade;

class CustomFileFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'customfilefacade';
    }
}
