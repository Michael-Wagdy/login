@extends('admin.layouts.master')

@section('title', 'Create Category')

@section('content_header')
    <h1>Create Category</h1>
@stop

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('create category') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.category.create') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="parent" class="col-md-4 col-form-label ">{{ __('Name') }}</label>

                            <div class="col-md-8">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="parent" class="col-md-4 col-form-label ">{{ __('parent (opitional) ') }}</label>

                            <div class="col-md-8">
                                <select id="parent" class="form-control @error('parent') is-invalid @enderror" name="parent" value="{{ old('parent') }}" >
                                <option value disabled {{ old('parent', null) === null ? 'selected' : '' }}> Please select a parent category </option>
                                @foreach($categories as $category)
                                <option value="{{$category->id}}" >{{ $category->name }}</option>
                                @endforeach
                                </select>



                                @error('parent')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                       
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('create category') }}
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