<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Fileupload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class FileuploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function formatBytes($size, $precision = 2)
    {
        $base = log($size, 1024);
        return round(pow(1024, $base - floor($base)), $precision);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $file = $request->file('fileUpload');
        $filename = $file->getClientOriginalName();
        $filename = time().'_'.$filename;
        $size = $request->file('fileUpload')->getSize();
        $path = $file->storeAs('public', $filename);
        $size = FileuploadController::formatBytes($size, 4);

        if (is_nan($size)){
            Fileupload::create([
                'filesize' => 0,
                'filename' => $filename,
            ]);
        } else{
            Fileupload::create([
                'filesize' => $size,
                'filename' => $filename,
            ]);
        }


        $files = DB::table('fileuploads')->get();

        return redirect()->route('home')->with('files', $files);
    }

    public function download(Request $request, $file)
    {
        return response()->download(public_path('storage/'.$file));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fileupload  $fileupload
     * @return \Illuminate\Http\Response
     */
    public function show(Fileupload $fileupload)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fileupload  $fileupload
     * @return \Illuminate\Http\Response
     */
    public function edit(Fileupload $fileupload)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fileupload  $fileupload
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fileupload $fileupload)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fileupload  $fileupload
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fileupload $fileupload)
    {
        //
    }
}
