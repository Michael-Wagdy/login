@extends('admin.layouts.master')

@section('title', 'Agencies Managment')

@section('content_header')
    <h1>agency Managment</h1>
@stop

@section('content')
<div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Agencies Table</h3>
                <a  href="{{route('admin.agency.create')}}"class="btn btn-xs btn-info mb-2" >create</a>

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
                      <th>agency</th>
                      <th>address</th>
                      <th>Email</th>
                      <th>phone</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($agenies as $agency)
                    <tr id="{{$agency->id}}">
                      <td>{{$agency->id}}</td>
                      <td>{{$agency->name}}</td>
                      <td>{{$agency->address}}</td>
                      <td>{{$agency->email}}</td>
                      <td>{{$agency->phone}}</td>
                      <td>
                      <button type="button" name="delete" class="btn btn-xs btn-danger" data-token="{{ csrf_token() }}"  data-id="{{ $agency->id }}">delete</button>

                      <a  href="{{route('admin.agency.edit',$agency->id)}}"class="btn btn-xs btn-info" >Info</a>

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
    url: "delete/"+id,
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