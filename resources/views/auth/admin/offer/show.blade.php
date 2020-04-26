@extends('adminlte::page')

@section('title', 'show offer')

@section('content_header')
    <h1>show offer</h1>
@stop

@section('content')
<div class="row">
          <div class="col-12">
            <div class="card">
             

              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-text-width"></i>
                  Offer Details
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <dl class="row">
                  <dt class="col-sm-4">Name </dt>
                  <dd class="col-sm-8">{{$offer->name}}</dd>
                  <dt class="col-sm-4"> dates</dt>
                  <dd class="col-sm-8">starting at {{date_format($offer->start_date,'l d F Y, h:m A')}}</dd>
                  <dd class="col-sm-8 offset-sm-4">ending at {{date_format($offer->end_date,'l d F Y, h:m A')}}</dd>
                  <dt class="col-sm-4">Agency price</dt>
                  <dd class="col-sm-8">{{$offer->agency_price}}</dd>
                  <dt class="col-sm-4">user price</dt>
                  <dd class="col-sm-8">{{$offer->user_price}}</dd>
                  <dt class="col-sm-4">no_rooms</dt>
                  <dd class="col-sm-8">{{$offer->no_rooms}} </dd>
                  <dt class="col-sm-4">Agency</dt>
                  <dd class="col-sm-8">{{$offer->agency->name}} </dd>
                  <dt class="col-sm-4">photos</dt>
                  <dd class="col-sm-8">
                  @foreach($offer->photo as $image)
                  <img src="\storage\uploads\photo\{{$image->photo}}" class="img-fluid mb-2" style="height:100px;width:100px;" alt="white sample"/>
                  
                 
                  @endforeach
                  </dd>

                  <dt class="col-sm-4">category</dt>
                  <dd class="col-sm-8">
                  @foreach($offer->categories as $category){{$category->name .' '}}
                  @endforeach
                  </dd>
                  @foreach($offer->details as $detail)
                  <dt class="col-sm-4">transportation mode</dt>
                  <dd class="col-sm-8"> {{$detail->transportation_mode}}</dd>
                  <dt class="col-sm-4"> dates</dt>
                  <dd class="col-sm-8">departial time at {{date_format($detail->Departial_time,'l d F Y, h:m A')}}</dd>
                  <dd class="col-sm-8 offset-sm-4">arrival time at {{date_format($detail->arrival_time,'l d F Y, h:m A')}}</dd>
                  <dt class="col-sm-4"> distination</dt>
                  <dd class="col-sm-8">from: {{$detail->from}}</dd>
                  <dd class="col-sm-8 offset-sm-4">to: {{$detail->to}}</dd>
                  @endforeach
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