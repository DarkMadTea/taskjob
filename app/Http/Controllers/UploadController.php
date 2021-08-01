<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UploadRequest;

class UploadController extends Controller
{
    public function show(UploadRequest $request)
    {
        dd($request->request);
    }

    public function upload()
    {

    }
}
