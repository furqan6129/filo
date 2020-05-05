<!--Used to display all the requests.-->

@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8 ">
      <div class="card">
        <div class="card-header">Display all Requests</div>
        <div class="card-body">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th>Status</th>
                <th>Reason</th>
                <th>RequestedBy</th>

                <th colspan="3">Action</th>

              </tr>
            </thead>
            <tbody>
              @if (count($requests)>0)

              @foreach($requests as $request)
              <tr>
                <td>{{$request['id']}}</td>
                <td>{{$request['requestStatus']}}</td>
                <td>{{$request['reason']}}</td>
                <td>{{$request['requestedBy']}}</td>
                @guest
					      @else


                <!--This button is used to accept the request.-->
                <td><a href="{{action('RequestController@approveRequest', $request['id'])}}" class="btn
                  btn- primary">Approve</a></td>
                  <!--This button is used to refuse a rquest.-->
                  <td><a href="{{action('RequestController@refuseRequest', $request['id'])}}" class="btn
                    btn- warning">Refuse</a></td>
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
