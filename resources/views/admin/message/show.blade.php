@extends('admin.layouts.master')

@section('title', 'show message')

@section('content_header')
    <h1>show message</h1>
@stop

@section('content')
<div class="row">
          <div class="col-12">
            <div class="card">
             
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-text-width"></i>
                  message Details
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <dl class="row">
                  <dt class="col-sm-4">Name </dt>
                  <dd class="col-sm-8">{{$contactUS->frist_name .' ' .$contactUS->last_name}}</dd>
                 <dt class="col-sm-4">Email</dt>
                  <dd class="col-sm-8">{{$contactUS->email}}</dd>
                  <dt class="col-sm-4">subject</dt>
                  <dd class="col-sm-8">{{$contactUS->subject}}</dd>
                  <dt class="col-sm-4">message</dt>
                  <dd class="col-sm-8">{{$contactUS->message}} </dd>
                  <dt class="col-sm-4">created at</dt>
                  <dd class="col-sm-8">{{$contactUS->created_at}} </dd>
                  <dt class="col-sm-4">user</dt>
                  <dd class="col-sm-8">{{$contactUS->user->frist_name}} </dd>
                </dl>
              </div>
              <!-- /.card-body -->
            </div>
           


              </div>
              <!-- /.card-header -->
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