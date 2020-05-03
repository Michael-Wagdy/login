@extends('adminlte::page')

@section('title', 'message Managment')

@section('content_header')
    <h1>Offers Managment</h1>
@stop

@section('content')

<div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">messages Table</h3>

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
                      <th>Name</th>
                      <th>Email</th>
                      <th>subject</t h>
                      <th>read</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($messages as $message)
                    <tr>
                      <td>{{$message->frist_name}}</td>
                      <td>{{$message->last_name}}</td>
                      <td>{{$message->email}}</td>
                      <td>{{$message->subject}}</td>
                      <td>
                      <button type="button" name="status" class="btn btn-default"  data-id="{{ $message->id }}">
  <span class=" glyphicon glyphicon-envelope " style="color: {{ $message->status === 1 ? 'blue;' : 'black;' }}" aria-hidden="true"></span>
</button>
</td> 
                      <td>
                                      <a  href="{{route('admin.message.show',$message->id)}}"class="btn btn-xs btn-info" >show</a>

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
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

@stop

@section('js')
<!-- Latest compiled and minified JavaScript -->
<script>
$(document).ready(function(){
    $("button").click(function () {
      
        let status = $(this).find("span").css('color') == "rgb(0, 0, 0)" ? 1 : 0;
     status ?   $(this).find("span").css('color',"blue") :$(this).find("span").css('color',"black"); 
                let contactUs = $(this).data('id');
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{ route('admin.message.updateRead') }}',
            data: {'status': status, 'contactUs': contactUs},
            success: function (data) {
                console.log(data.message);
            }
        });
    });
});
</script>
@stop