<?php

namespace App\Http\Controllers;

use App\Models\Art_upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;




class Art_uploadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $uploads = Art_upload::with('user')->get();
        return view('art_uploads.index', ['uploads' => $uploads]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('art_uploads.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       /* 
            if (!$request->hasFile('upload')) {
                dd('hello');
            }
        
            $file = $request->file('upload');
        
            if (!$file->isValid()) {
                dd('no' . $file->getError());
            }
        
            dd([
                'originalName' => $file->getClientOriginalName(),
                'mimeType' => $file->getMimeType(),
                'size' => $file->getSize(),
                'path' => $file->getPathname(),
            ]);
        */
        
        
        


      
        
        $upload = new Art_upload;
        $upload->mimeType = $request->file('upload')->getMimeType();
        $upload->originalName = $request->file('upload')->getClientOriginalName();
        $upload->path = $request->file('upload')->store('art_sculpture');
        $upload->user_id = Auth::id();
        
        $upload->save();
        return view('art_uploads.create',
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
    public function show(Art_upload $upload,$originalName='')
    {
        $upload = Art_upload::findOrFail($upload->id);
    
        return response()->file(storage_path() . '/app/' . $upload->path);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Art_upload $upload)
    {
        return view('art_uploads.edit',
            ['id'=>$upload->id,
            'path'=>$upload->path,
            'originalName'=>$upload->originalName,
            'mimeType'=>$upload->mimeType]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Art_upload $upload)
    {
        $upload = Art_upload::findOrFail($upload->id);
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
    public function destroy(Art_upload $upload)
    {
        $upload = Art_upload::findOrFail($upload->id);
        Storage::delete($upload->path);
        $upload->delete();
        return back()->with(['operation'=>'deleted', 'id'=>$upload->id]);
    }
/*
    public function store_sculpture(Request $request)
    {
        $upload_1 = new Art_upload_1;
        $upload_1->mimeType_1 = $request->file('upload')->getMimeType();
        $upload_1->originalName_1 = $request->file('upload')->getClientOriginalName();
        $upload_1->path_1 = $request->file('upload')->store('art_sculpture');
        $upload_1->save();
        return view('art_sculpture.create_sculpture',
            ['id'=>$upload_1->id,
            'path'=>$upload_1->path_1,
            'originalName'=>$upload_1->originalName_1,
            'mimeType'=>$upload_1->mimeType_1]
        );
    }

    
    public function show_sculpture(Art_upload_1 $upload_1,$originalName_1='')
    {
        $upload_1 = Art_upload_1::findOrFail($upload_1->id);
    
        return response()->file(storage_path() . '/app/' . $upload_1->path_1);
    }

    
    public function edit_sculpture(Art_upload_1 $upload_1)
    {
        return view('art_sculpture.edit_sculpture',
            ['id'=>$upload_1->id,
            'path'=>$upload_1->path_1,
            'originalName'=>$upload_1->originalName_1,
            'mimeType'=>$upload_1->mimeType_1]
        );
    }

    
    public function update_sculpture(Request $request, Art_upload_1 $upload_1)
    {
        $upload_1 = Art_upload_1::findOrFail($upload_1->id);
		Storage::delete($upload_1->path_1);
		$upload_1->originalName_1 = request()->file('upload')->getClientOriginalName();
		$upload_1->path_1 = request()->file('upload')->store('uploads');
		$upload_1->mimeType_1 = $request->file('upload')->getClientMimeType();
		$upload_1->save();
		return back();
    }

   
    public function destroy_sculpture(Art_upload_1 $upload_1)
    {
        $upload_1 = Art_upload_1::findOrFail($upload_1->id);
        Storage::delete($upload_1->path_1);
        $upload_1->delete();
        return back()->with(['operation'=>'deleted', 'id'=>$upload_1->id]);
    }

    public function index_sculpture()
    {
        $uploads_1 = Art_upload_1::get();
        return view('art_sculpture.index_sculpture', ['uploads' => $uploads_1]);
    }

    
    public function create_sculpture()
    {
        return view('art_sculpture.create_sculpture');
    }
   */
}
