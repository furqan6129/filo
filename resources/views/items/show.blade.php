<!--This view is used to show complete details of a specific item-->


@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8 ">
      <div class="card">
        <div class="card-header">Item Details</div>
        <div class="card-body">
          <table class="table table-striped" border="1" >
            <tr> <td> <b>Item ID</th> <td> {{$item['id']}}</td></tr>
              <tr> <th>Item type </th> <td>{{$item->type}}</td></tr>
              <tr> <th>Item Colour </th> <td>{{$item->colour}}</td></tr>
              <tr> <td>Item Location </th> <td>{{$item->location}}</td></tr>
              <tr> <th>Item Description </th> <td style="max-width:150px;" >{{$item->description}}</td></tr>

              <!--The image will only be shown if it is not empty(default name)-->
              @if ( $item->image!="noimage.jpg")
              <tr> <td colspan='2' ><img style="width:100%;height:100%" src="{{ asset('storage/images/'.$item->image)}}"></td></tr>
              @endif
            </table>
            <table><tr>
              <td><a href="{{ route('items.index')}}" class="btn btn-primary" role="button">Back to the
                list</a></td>

                @if(Auth::user()->role==1)
                  <td><a href="{{action('ItemController@edit', $item['id'])}}" class="btn
                    btn- warning">Edit</a></td>
                    <td><form action="{{action('ItemController@destroy', $item['id'])}}"
                      method="post"> @csrf
                      <input name="_method" type="hidden" value="DELETE">
                      <button class="btn btn-danger" type="submit">Delete</button>
                  @endif
                  </form></td>
                </tr></table>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endsection
