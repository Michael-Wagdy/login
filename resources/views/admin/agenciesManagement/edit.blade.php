@extends('adminlte::page')

@section('title', 'Edit Agency Account')

@section('content_header')
    <h1>Edit Agency Account</h1>
@stop

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Edit') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.agency.update',$agency->id) }}"  enctype="multipart/form-data">
                        @csrf
                        {{method_field('patch')}}
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label ">{{ __('Name') }}</label>

                            <div class="col-md-8">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $agency->name }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label ">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-8">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $agency->email }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                       
                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label ">{{ __('phone') }}</label>

                            <div class="col-md-8">
                                <input id="phone" type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $agency->phone }}" required>

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label ">{{ __('Address') }}</label>

                            <div class="col-md-8">
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ $agency->address }}" required autocomplete="address" autofocus>

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                                                
                        <div class="form-group row">
                            <label for="country" class="col-md-4 col-form-label ">{{ __('country') }}</label>

                         
                                                
                        <div class="form-group row">
                            <label for="country" class="col-md-4 col-form-label ">{{ __('country') }}</label>

                            <div class="col-md-8">
                                <select id="country" class="form-control @error('country') is-invalid @enderror" name="country" value="{{ old('country') }}" >
                                <option value disabled {{ $agency->country === null ? 'selected' : '' }}> Please select a country </option>
                                @foreach(App\Agency::COUNTRY_SELECT as $label)
                                <option >{{ $label }}</option>
                                @endforeach
                                </select>
                                

                                @error('country')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="photo" class="col-md-4 col-form-label">{{ __('Profile picture') }}</label>

                            <div class="col-md-8">
                                <input id="photo" type="file"  accept="image/*" class="form-control @error('avatar') is-invalid @enderror" name="photo"  value="{{$agency->photo}}">
                            </div>  
                            
                            </div>  
                      
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('update') }}
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

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop