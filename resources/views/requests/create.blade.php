<!--This Create form is used to Crate a new request with soem of the item's details prefilled-->

@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8 ">
      <div class="card">
        <div class="card-header">Request an Item</div>
        @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div><br />
        @endif
        @if (\Session::has('success'))
        <div class="alert alert-success">
          <p>{{ \Session::get('success') }}</p>
        </div><br />
        @endif
        <div class="card-body">
          <form class="form-horizontal" method="POST" action="{{ action('RequestController@store',
          $item['id']) }} " enctype="multipart/form-data" >

          @csrf
          <div class="col-md-8">
            <label >Item Colour</label>
            <input type="text" name="colour" value="{{$item->colour}}"/>
          </div>
          <div class="col-md-8">
            <label>vehicle Type</label>
            <select name="type" value="{{ $item->type }}">
              <option value="pet">Pet</option>
              <option value="phone">Phone</option>
              <option value="jewellery">Jewellery</option>

            </select>
          </div>
          <div class="col-md-8">
            <label >Location</label>
            <input type="text" name="location" value="{{$item->location}}" />
          </div>
          <div class="col-md-8">
            <label >Added By</label>
            <input type="text" name="addedBy" value= "{{auth()->user()->name}}"; />
            <!--<input type="text" name="addedBy" value="{{$item->addedB}}" />-->

          </div>
          <div class="col-md-8">
            <label >Item Description</label>
            <textarea rows="2" cols="50" name="description" > {{$item->description}}
            </textarea>
          </div>

          <div class="col-md-8">
            <label >Reason</label>
            <textarea rows="2" cols="50" name="reason" > {{""}}
            </textarea>
          </div>

          <div class="col-md-8">
            <label>Image</label>
            <input type="file" name="image" />
          </div>
          <div class="col-md-6 col-md-offset-4">
            <input type="hidden" name="item" value="{{$item->id}}">
            <input type="submit" class="btn btn-primary" />
            <input type="reset" class="btn btn-primary" />
          </a>
        </div>
      </form>
    </div>
  </div>
</div>
</div>
</div>
@endsection
