@extends('layouts.app')

@section('content')
@section('body_style', 'background: url("../images/new_cinema.jpg");')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card p-4" style="background: rgba(230, 213, 184, 0.8);">
                <h4 class="text-center">{{ __('Drama Register')}}</h4>

                <div class="card-body ml-5">
                    <form method="POST" action="{{ route('dramas.new') }}" enctype="multipart/form-data">
                        @csrf

                        <!--タイトル-->
                        <div class="form-group row">
                            <label for="drama_title" class="col-md-8 col-form-label justify-content-center" style="text-align:left;">{{ __('Title')}}</label>

                            <div class="col-md-10">
                                <input type="text" id="drama_title" class="form-control @error('drama_title') is-invalid @enderror" name="drama_title" value="{{ old('drama_title') }}" autocomplete="drama_title" autofocus>

                                @error('drama_title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!--カテゴリー-->
                        <div class="form-group row">
                            <label for="category_name" class="col-md-8 col-form-label" style="text-align:left">{{ __('Category')}}</label>

                            <div class="col-md-10">
                                <select type="text" id="category_name" class="form-control @error('category_name') is-invalid @enderror" name="category_name" value="{{ old('category_name') }}" autocomplete="category_name" autofocus>

                                    @foreach($category_names as $key => $value)
                                    <option>{{ $value }}</option>
                                    @endforeach
                                </select>

                                @error('category_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!--ストーリー-->
                        <div class="form-group row">
                            <label for="drama_story" class="col-md-10 col-form-label" style="text-align:left">{{ __('Story')}}</label>

                            <div class="col-md-10">
                                <textarea cols="40" rows="8" id="drama_story" class="form-control @error('drama_story') is-invalid @enderror" name="drama_story" value="{{ old('drama_story') }}" autocomplete="drama_story" autofocus>
                                </textarea>

                                @error('drama_story')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!--画像-->
                        <div class="form-group row">
                            <label for="drama_image" class="col-md-8 col-form-label">{{ __('Image')}}</label>

                            <div class="col-md-10">
                                <input type="file" id="drama_image" class="@error('image') is-invalid @enderror" name="drama_image" autocomplete="drama_image" autofocus />



                                @error('drama_image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-3">
                                <button type="submit" class="col-6 btn btn-dark mt-4">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
