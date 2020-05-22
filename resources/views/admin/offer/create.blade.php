@extends('admin.layouts.master')

@section('title', 'Create offer ')

@section('content_header')
    <h1>Create offer</h1>
    
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@stop

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('create offer') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.offer.create') }}"  enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label ">{{ __('Name') }}</label>

                            <div class="col-md-8">
                                <input  type="text" class="form-control @error('name') is-invalid @enderror" name="name" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        
                        <div class="form-group row">
                            <label for="start_date" class="col-md-4 col-form-label ">{{ __('starting Date') }}</label>

                            <div class="col-md-8">
                                <input  type="text" class="form-control form_datetime  @error('start_date') is-invalid @enderror" name="start_date"  required autocomplete="start_date">

                                @error('start_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="end_date" class="col-md-4 col-form-label ">{{ __('End date') }}</label>

                            <div class="col-md-8">
                                <input  type="text" class="form-control form_datetime   timedate @error('end_date') is-invalid @enderror " name="end_date" required autocomplete="new-end_date">

                                @error('end_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                       
                        <div class="form-group row">
                            <label for="agency_price" class="col-md-4 col-form-label ">{{ __('agency price') }}</label>

                            <div class="col-md-8">
                                <input type="number" class="form-control @error('agency_price') is-invalid @enderror" name="agency_price" required>

                                @error('agency_price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="user_price" class="col-md-4 col-form-label ">{{ __('User price') }}</label>

                            <div class="col-md-8">
                                <input type="number" class="form-control @error('user_price') is-invalid @enderror" name="user_price" required autocomplete="user_price" autofocus>

                                @error('user_price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="no_rooms" class="col-md-4 col-form-label ">{{ __('Number of rooms') }}</label>

                            <div class="col-md-8">
                                <input type="number" class="form-control @error('no_rooms') is-invalid @enderror" name="no_rooms" required autocomplete="no_rooms" autofocus>

                                @error('no_rooms')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                                                
                        <div class="form-group row">
                            <label for="status" class="col-md-4 col-form-label ">{{ __('status') }}</label>

                            <div class="col-md-8">
                                <select  class="form-control @error('status') is-invalid @enderror" name="status">
                                <option value disabled {{ old('status', null) === null ? 'selected' : '' }}> Please select a status </option>
                                @foreach(App\User::STATUS_SELECT as $key => $label)
                                <option value={{ $key }} >{{ $label }}</option>
                                @endforeach
                                </select>
                                

                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="agency" class="col-md-4 col-form-label ">{{ __('agency') }}</label>

                            <div class="col-md-8">
                                <select  class="form-control @error('agency') is-invalid @enderror" name="agency" required>
                                <option value disabled {{ old('agency', null) === null ? 'selected' : '' }}> Please select a agency </option>
                                @foreach(App\Agency::all() as $agency)
                                <option value={{ $agency->id }} >{{ $agency->name }}</option>
                                @endforeach
                                </select>
                                

                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                  <label  class="col-md-4 col-form-label ">category</label>
                  <div class="col-md-8">

                  <select class="select2" name="category[]" multiple="category" data-placeholder="Select a State" style="width: 100%;" required>
                                  @foreach(App\category::all() as $category)
                                <option value={{ $category->id }} >{{ $category->name }}</option>
                                @endforeach
                  </select>
                        
                        </div>
                </div>


                        <div id="details">

                        <div class="form-group row">
                            <label for="transportation_mode" class="col-md-4 col-form-label ">{{ __('transportation mode') }}</label>

                            <div class="col-md-8">
                                <select  class="form-control @error('transportation_mode') is-invalid @enderror" name="transportation_mode[]" required>
                                <option value disabled {{ old('transportation_mode', null) === null ? 'selected' : '' }}> Please select a transportation </option>
                                @foreach(App\offer::Transporation_SELECT as $key => $label)
                                <option value={{ $key }} >{{ $label }}</option>
                                @endforeach
                                </select>
                                

                                @error('transportation_mode')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Departial_time" class="col-md-4 col-form-label ">{{ __('Departial time') }}</label>

                            <div class="col-md-8">
                                <input type="text" class="form-control form_datetime  @error('start_date') is-invalid @enderror" name="Departial_time[]" required autocomplete="Departial_time">

                                @error('Departial_time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="arrival_time" class="col-md-4 col-form-label ">{{ __('arrival time') }}</label>

                            <div class="col-md-8">
                                <input type="text" class="form-control form_datetime   timedate @error('arrival_time') is-invalid @enderror " name="arrival_time[]" required autocomplete="arrival_time">

                                @error('arrival_time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="to" class="col-md-4 col-form-label ">{{ __('to') }}</label>

                            <div class="col-md-8">
                                <input  type="text" class="form-control @error('to') is-invalid @enderror" name="to[]"  required autocomplete="to" autofocus>

                                @error('to')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="from" class="col-md-4 col-form-label ">{{ __('from') }}</label>

                            <div class="col-md-8">
                                <input  type="text" class="form-control @error('from') is-invalid @enderror" name="from[]" required autocomplete="from" autofocus>

                                @error('from')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="no_trip" class="col-md-4 col-form-label ">{{ __('trip number') }}</label>

                            <div class="col-md-8">
                                <input  type="number" class="form-control @error('no_trip') is-invalid @enderror" name="no_trip[]"required autocomplete="no_trip" autofocus>

                                @error('no_trip')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        </div>
                        <button class="btn btn-info" name='add-details' id='add-details'>add</button>

                        <div class="form-group row">
                            <label for="photo" class="col-md-4 col-form-label">{{ __('Photos') }}</label>

                            <div class="col-md-8">
                                <input type="file"  accept="image/*" class="form-control @error('photo') is-invalid @enderror" name="photos" multiple required>
                            </div>  
                            
                            </div>  
                      
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('create') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
  @stop

@section('js')
    <script>
                $(document).ready(function() { 
$('#add-details').click(function(){
    
    $('#details').append(` 
  
    <div class="form-group row">
                            <label for="transportation_mode" class="col-md-4 col-form-label ">{{ __('transportation mode') }}</label>

                            <div class="col-md-8">
                                <select  class="form-control @error('transportation_mode') is-invalid @enderror" name="transportation_mode[]"  >
                                <option> Please select a transportation </option>
                                @foreach(App\offer::Transporation_SELECT as $key => $label)
                                <option value={{ $key }} >{{ $label }}</option>
                                @endforeach
                                </select>
                                

                                @error('transportation_mode')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Departial_time" class="col-md-4 col-form-label ">{{ __('Departial time') }}</label>

                            <div class="col-md-8">
                                <input type="text" class="form-control form_datetime  @error('start_date') is-invalid @enderror" name="Departial_time[]" required autocomplete="Departial_time">

                                @error('Departial_time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="arrival_time" class="col-md-4 col-form-label ">{{ __('arrival time') }}</label>

                            <div class="col-md-8">
                                <input  type="text" class="form-control form_datetime   timedate @error('arrival_time') is-invalid @enderror " name="arrival_time[]" required autocomplete="arrival_time">

                                @error('arrival_time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="to" class="col-md-4 col-form-label ">{{ __('to') }}</label>

                            <div class="col-md-8">
                                <input  type="text" class="form-control @error('to') is-invalid @enderror" name="to[]"  required autocomplete="to" autofocus>

                                @error('to')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="from" class="col-md-4 col-form-label ">{{ __('from') }}</label>

                            <div class="col-md-8">
                                <input  type="text" class="form-control @error('from') is-invalid @enderror" name="from[]" required autocomplete="from" autofocus>

                                @error('from')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="no_trip" class="col-md-4 col-form-label ">{{ __('trip number') }}</label>

                            <div class="col-md-8">
                                <input  type="number" class="form-control @error('no_trip') is-invalid @enderror" name="no_trip[]"  required autocomplete="no_trip" autofocus>

                                @error('no_trip')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        `)
 
                    });

$(".form_datetime").datetimepicker({format: 'yyyy-mm-dd hh:ii'});
           //Initialize Select2 Elements
        $('.select2').select2()

            });


    </script>
@stop