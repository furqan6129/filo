<!--This view is used to display all the items from the table.-->
<!--The items array passed to the view is used to display all the items.-->


@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8 ">
      <div class="card">
        <div class="card-header">Display all Items</div>
        <div class="card-body">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th>Type</th>
                <th>Colour</th>
                <th>Description</th>
                @guest
                @else
                <th colspan="3">Action</th>
                @endguest
              </tr>
            </thead>
            <tbody>
              @if (count($items)>0)

              @foreach($items as $item)
              <tr>
                <td>{{$item['id']}}</td>
                <td>{{$item['type']}}</td>
                <td>{{$item['colour']}}</td>
                <td>{{$item['description']}}</td>
                @guest
					      @else

                <td><a href="{{action('ItemController@show', $item['id'])}}" class="btn
                  btn- primary">View</a></td>
                  <td><a href="{{action('RequestController@create', $item['id'])}}" class="btn
                    btn- warning">Request</a></td>
                    <td>

                      @endguest
                    </form>
                  </td>
                </tr>
                @endforeach
                @endif
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endsection
