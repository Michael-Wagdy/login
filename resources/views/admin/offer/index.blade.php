@extends('admin.layouts.master')

@section('title', 'Offers Managment')

@section('content_header')
    <h1>Offers Managment</h1>
@stop

@section('content')
<div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Offers Table</h3>
                <a  href="{{route('admin.offer.create')}}"class="btn btn-xs btn-info mb-2" >create</a>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Offers Name</th>
                      <th>Start</th>
                      <th>End</th>
                      <th>No of rooms</th>
                      <th>Agency</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($offers as $offer)
                    <tr id="{{$offer->id}}">
                      <td>{{$offer->id}}</td>
                      <td>{{$offer->name}}</td>
                      <td>{{date_format($offer->start_date,'l d F Y, h:m A')}}</td>
                      <td>{{date_format($offer->end_date,'l d F Y, h:m A')}}</td>
                      <td>{{$offer->no_rooms}}</td>
                      <td>{{$offer->agency->name}}</td>
                      <td>
                      <button type="button" name="delete" class="btn btn-xs btn-danger" data-token="{{ csrf_token() }}"  data-id="{{ $offer->id }}">delete</button>

                                        <a  href="{{route('admin.offer.edit',$offer->id)}}"class="btn btn-xs btn-info" >Edit</a>
                                        <a  href="{{route('admin.offer.show',$offer->id)}}"class="btn btn-xs btn-info" >show</a>

                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
        @stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
@section('js')
<script>
$(document).ready(function(){
    $("button").click(function () {
      
let id = $(this).data('id');
let  token = $(this).data("token");
console.log(id);
$.ajax(
{
    url: "offer/delete/"+id,
    type: 'DELETE', // Just delete Latter Capital Is Working Fine
    dataType: "JSON",
    data: {
        "id": id ,// method and token not needed in data
        "_token": token,
    },
    success: function (response)
    {
        console.log(response); // see the reponse sent
        $("#"+id).remove();

    }
   
});
});
});

</script>
@stop