<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Requests;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //Getting all the requests from the table and then passing them  to the "index" view for displaying them

      $requests = Requests::all()->toArray();
      return view('requests.index', compact('requests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
      //Find the item from the table and pass it to the "create" view for the request form to be prefilled with the item data.
      $item = Item::find($id);
      return view('requests.create',compact('item'));

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
      $this->validate($request, [

        'reason'=>'required',


      ]);

      // create a Requests object and set its values from the input
      $requestedItem = new Requests;
      $requestedItem->reason = $request->input('reason');
      $requestedItem->item = $request->input('item');
      $requestedItem->requestedBy = auth()->user()->id;
      $requestedItem->save();
      // generate a redirect HTTP response with a success message
      return back()->with('success', 'Request has been submitted');
    }


    //Function used by the admin account to approve a request.
    public function approveRequest($id)
    {
      //Find the request from the table and set it's status to "approved"
      $request = Requests::find($id);
      $request->requestStatus='approved';
      $request->save();
      return back()->with('success', 'Request has been accepted');
    }


    //Function used by the admin account to refuse a request.
    public function refuseRequest($id)
    {
      //Find the request from the table and set it's status to "refused".
      $request = Requests::find($id);
      $request->requestStatus='refused';
      $request->save();
      return back()->with('success', 'Request has been refused');
    }

  }
