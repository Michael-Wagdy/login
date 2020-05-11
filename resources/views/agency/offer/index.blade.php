@extends('adminlte::page')

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
                <a  href="{{route('agency.offer.create')}}"class="btn btn-xs btn-info mb-2" >create</a>

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
                    <tr>
                      <td>{{$offer->id}}</td>
                      <td>{{$offer->name}}</td>
                      <td>{{date_format($offer->start_date,'l d F Y, h:m A')}}</td>
                      <td>{{date_format($offer->end_date,'l d F Y, h:m A')}}</td>
                      <td>{{$offer->no_rooms}}</td>
                      <td>{{$offer->agency->name}}</td>
                      <td>
                      <form action="{{ route('agency.offer.delete', $offer->id) }}" method="POST" onsubmit="return confirm('areYouSure');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="delete"></form>
                                        <a  href="{{route('agency.offer.edit',$offer->id)}}"class="btn btn-xs btn-info" >edit</a>
                                        <a  href="{{route('agency.offer.show',$offer->id)}}"class="btn btn-xs btn-info" >show</a>

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
    <script> console.log('Hi!'); </script>
@stop