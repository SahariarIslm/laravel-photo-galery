<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Photo;

class PhotosController extends Controller
{
    public function create($album_id){
    	return view('photos.create')->with('album_id',$album_id);
    }
    public function store(Request $request){
    	$this->validate($request, [
    		'title' => 'required',
    		'photo' =>'image|max:199999'
    	]);
    	// get file name with extession
    	$fileNameWithExt = $request->file('photo')->getClientOriginalName();
    	// get just the file name
    	$fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
    	// get just the file extession
    	$extension = $request->file('photo')->getClientOriginalExtension();
    	//create new file name
    	$filenameToStore = $fileName.'_'.time().'.'.$extension;
    	//upload Image
    	$path = $request->file('photo')->storeAs('public/photos/'.$request->input('album_id'),$filenameToStore);
    	

    	//upload photo
    	$photo = new Photo;
    	$photo->album_id = $request->input('album_id') ;
    	$photo->title = $request->input('title');
    	$photo->description = $request->input('description');
    	$photo->photo = $filenameToStore;
    	$photo->size = $request->file('photo')->getClientSize();
    	
    	$photo->save();
    	return redirect('/albums/'.$request->input('album_id'))->with('success','Photo  uploaded');
    }
    public function show($id){
    	$photo = Photo::find($id);
    	return view('photos.show')->with('photo',$photo);
    }
    public function destroy($id){
    	$photo = Photo::find($id);
    	if (Storage::delete('public/photos/'.$photo->album_id.'/'.$photo->photo)) {
    		$photo->delete();
    	}
    	return redirect('/')->with('success','Photo Deleted');

    }
}
