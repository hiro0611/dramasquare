@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card p-4 border-0 shadow" style="background-color: #fff8cd;">
                <h4 class="p-2 text-center text-secondary" style="letter-spacing: 5px">{{ __('Write Review')}}</h4>

                <div class="card-body ml-5">
                    <form method="POST" action="{{ route('dramas.postReview', $dramas->id) }}">
                        @csrf

                        <!--タイトル-->
                        <div class="form-group row">
                            <label for="review_title" class="col-md-8 col-form-label justify-content-center">{{ __('Title')}}</label>

                            <div class="col-md-10">
                                <input type="text" id="review_title" class="form-control @error('review_title') is-invalid @enderror" name="review_title" value="{{ old('review_title') }}" autocomplete="review_title" autofocus>

                                @error('review_title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!--おすすめ度-->
                        <div class="form-group row">
                            <label for="review_score" class="col-md-12 col-form-label">{{ __('Review Recommend') }}
                            </label>
                            <star-component></star-component>
                        </div>

                        <!--レビュー内容-->
                        <div class="form-group row">
                            <label for="review_comment" class="col-md-12 col-form-label">{{ __('Review Comment')}}</label>

                            <div class="col-md-10">
                                <textarea cols="40" rows="8" id="review_comment" class="form-control @error('review_comment') is-invalid @enderror" name="review_comment" value="{{ old('review_comment') }}" autocomplete="review_comment" autofocus>
                                </textarea>

                                @error('review_comment')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row mt-5">
                            <div class="col-md-10 offset-md-3">
                                <button type="submit" class="col-4 btn btn-dark">
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
