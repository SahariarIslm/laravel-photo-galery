<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Album;

class AlbumsController extends Controller
{
    public function index(){
    	$albums = Album::with('Photos')->get();
    	return view('albums.index')->with('albums', $albums);
    }
    public function create(){
    	return view('albums.create');
    }
    public function store(Request $request){
    	$this->validate($request, [
    		'name' => 'required',
    		'cover_image' =>'image|max:199999'
    	]);
    	// get file name with extession
    	$fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
    	// get just the file name
    	$fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
    	// get just the file extession
    	$extension = $request->file('cover_image')->getClientOriginalExtension();
    	//create new file name
    	$filenameToStore = $fileName.'_'.time().'.'.$extension;
    	//upload Image
    	$path = $request->file('cover_image')->storeAs('public/album_covers',$filenameToStore);
    	

    	//create album
    	$album = new Album;
    	$album->name = $request->input('name');
    	$album->description = $request->input('description');
    	$album->cover_image = $filenameToStore;
    	
    	$album->save();
    	return redirect('/albums')->with('success','Album Created');
    }
    public function show($id){
    	$album = Album::with('Photos')->find($id);
    	return view('albums.show')->with('album',$album);
    }
    
}
