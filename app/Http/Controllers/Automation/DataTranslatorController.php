<?php

namespace App\Http\Controllers\Automation;

use App\Http\Controllers\Controller;
use App\Jobs\TranslateData;
use Illuminate\Http\Request;

class DataTranslatorController extends Controller
{
    public function __invoke(Request $request)
    {
        dispatch(new TranslateData());
    }
}
