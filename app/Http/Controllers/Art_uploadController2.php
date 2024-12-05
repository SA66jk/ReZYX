<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Art_upload_1;


class Art_uploadController2 extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $uploads= Art_upload_1::with('user')->get();
        return view('art_sculpture.index_sculpture', ['uploads' => $uploads]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('art_sculpture.create_sculpture');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $upload = new Art_upload_1;
        $upload->mimeType = $request->file('upload')->getMimeType();
        $upload->originalName = $request->file('upload')->getClientOriginalName();
        $upload->path = $request->file('upload')->store('art_sculpture');
        $upload->user_id = Auth::id();
        
        $upload->save();
        return view('art_sculpture.create_sculpture',
            ['id'=>$upload->id,
            'path'=>$upload->path,
            'originalName'=>$upload->originalName,
            'mimeType'=>$upload->mimeType
            
            ]
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Art_upload_1 $upload,$originalName='')
    {
        $upload = Art_upload_1::findOrFail($upload->id);
    
        return response()->file(storage_path() . '/app/' . $upload->path);
    
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Art_upload_1 $upload)
    {
        return view('art_sculpture.edit_sculpture',
        ['id'=>$upload->id,
        'path'=>$upload->path,
        'originalName'=>$upload->originalName,
        'mimeType'=>$upload->mimeType]
    );
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Art_upload_1 $upload)
    {
        $upload = Art_upload_1::findOrFail($upload->id);
		Storage::delete($upload->path);
		$upload->originalName = request()->file('upload')->getClientOriginalName();
		$upload->path = request()->file('upload')->store('uploads');
		$upload->mimeType = $request->file('upload')->getClientMimeType();
		$upload->save();
		return back()->with('success', 'File updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Art_upload_1 $upload)
    {
        
        $upload = Art_upload_1::findOrFail($upload->id);
        Storage::delete($upload->path);
        $upload->delete();
        return back()->with(['operation'=>'deleted', 'id'=>$upload->id]);
    }

}