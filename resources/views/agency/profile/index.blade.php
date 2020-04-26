@extends('layouts.app')

@section('content')

    <!-- Main content -->
    <section class="content">
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img src="\storage\uploads\photo\{{$agency->photo}}"
                       alt="agency profile picture"
                       style="border: 3px solid #adb5bd;border-radius: 50%;margin: 0 auto;padding: 3px;width:200px;height:200px">
                </div>

                <h3 class="profile-name text-center">{{$agency->name}}</h3>

                <ul class="list-group list-group-unbordered">
                  <li class="list-group-item">
                    <b>telephone</b> <a class="float-right">{{$agency->phone}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>address</b> <a class="float-right">{{$agency->address}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>email</b> <a class="float-right">{{$agency->email}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>country</b> <a class="float-right">{{$agency->country}}</a>
                  </li>
                </ul>

                <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

@endsection

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop