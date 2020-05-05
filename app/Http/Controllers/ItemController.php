<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\User;
//use App\Request;

class ItemController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    //Getting all the items from the table and then passing them  to the index view for displaying them

    $items = Item::all()->toArray();
    return view('items.index', compact('items'));
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    //Load the "create" view
    return view('items.create');
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request)
  {
    // form validation specifying the inout requirements
    $item = $this->validate(request(), [
      'colour' => 'required',
      'description' => 'required',
      'image' => 'image|nullable|max:1999',
      'location' => 'required',

    ]);
    //Handles the uploading of the image
    if ($request->hasFile('image')){
      //Gets the filename with the extension
      $fileNameWithExt = $request->file('image')->getClientOriginalName();
      //just gets the filename
      $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
      //Just gets the extension
      $extension = $request->file('image')->getClientOriginalExtension();
      //Gets the filename to store
      $fileNameToStore = $filename.'_'.time().'.'.$extension;
      //Uploads the image
      $path =$request->file('image')->storeAs('public/images', $fileNameToStore);
    }
    else {
      $fileNameToStore = 'noimage.jpg';
    }

    // create a Item object and set its values from the input
    $item = new Item;
    $item->colour = $request->input('colour');
    $item->description = $request->input('description');
    $item->location = $request->input('location');
    $item->addedBy = auth()->user()->id;
    $item->type = $request->input('type');
    $item->created_at = now();
    //  $item->image = $url;
    $item->image = $fileNameToStore;
    // save the Vehicle object
    $item->save();
    // generate a redirect HTTP response with a success message
    return back()->with('success', 'Item has been added');
  }

  /**
  * Display the specified item with details
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show($id)
  {
    //Extract the item from the database and pass it to the "show" view
    $item = Item::find($id);
    return view('items.show',compact('item'));
  }

  /**
  * Show the form for editing the specified item.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function edit($id)
  {
    //Extract the item from the database and pass it to the "edit" view
    $item = Item::find($id);
    return view('items.edit',compact('item'));
  }

  /**
  * Update the specified item in the database.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function update(Request $request, $id)
  {
    // form validation
    $item = $this->validate(request(), [
      'colour' => 'required',
      'description' => 'required',
      'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:500',
      'location' => 'required',
      'addedBy' => 'required',
    ]);
    //Handles the uploading of the image
    if ($request->hasFile('image')){
      //Gets the filename with the extension
      $fileNameWithExt = $request->file('image')->getClientOriginalName();
      //just gets the filename
      $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
      //Just gets the extension
      $extension = $request->file('image')->getClientOriginalExtension();
      //Gets the filename to store
      $fileNameToStore = $filename.'_'.time().'.'.$extension;
      //Uploads the image
      $path =$request->file('image')->storeAs('public/images', $fileNameToStore);
    }
    else {
      $fileNameToStore = 'noimage.jpg';
    }
    // create an Item object and set its values from the input
    $item = Item::find($id);
    $item->colour = $request->input('colour');
    $item->description = $request->input('description');
    $item->location = $request->input('location');
    $item->addedBy = $request->input('addedBy');
    $item->type = $request->input('type');
    $item->created_at = now();
    $item->image = $fileNameToStore;
    // save the Item object
    $item->save();
    // generate a redirect HTTP response with a success message
    return back()->with('success', 'Item has been updated');

  }

  /**
  * Remove the specified image from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    //Extract the item from the database and delete it.
    $item = Item::find($id);
    $item->delete();
    return redirect('items')->with('success','item has been deleted');


  }
}
