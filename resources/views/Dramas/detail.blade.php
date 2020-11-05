@extends('layouts.app')

@section('content')
@section('body_style', 'background: url("/images/cinema_image.jpg");')
<div class="container mt-5">
    <div class="row justify-content-center w-75 m-auto p-4" style="background: rgba(230, 213, 184, 0.8);">

        <!--カテゴリーとタイトル-->
        <div class="col-6">
            <h6 class="col-4 mb-4" style="border-left: 12px solid #a8dda8">{{ $dramas -> category_name }}</h6>
            <h3 class="col mb-5 font-weight-light" style="border-left: 12px solid #ffa5a5;">{{ $dramas -> drama_title }}</h3>

            <!--画像表示-->
            <div class="col-10">
                <img src="/uploads/{{ $dramas -> drama_image }}" class="w-60" style="height: 300px;">
            </div>
            <div class="col-8 mt-5 text-center">
                <a href="{{ route('dramas.review', $dramas->id) }}" class="col-8 btn btn-dark text-light">{{ __('Write Review')  }}</a>
            </div>
        </div>

        <!--ストーリー-->
        <div class="col-6 mt-5">
            <h4 class="col-md-8 mb-5" style="text-align:left; border-left: 14px solid #b2deec">STORY
            </h4>

            <div class="col-10">
                <p style="letter-spacing: 2px">{{ $dramas -> drama_story }}</p>
            </div>
        </div>
    </div>
</div>

<!--レビュー表示-->
<div class="col-sm-8 mt-5">
    <h2 class="col-md-8 mb-2 text-light">Review</h2>
    @foreach($reviews as $review)
    <div class="card border-0 w-75 m-2" style="background: rgba(255, 248, 205, 0.8);">
        <div class="card-body">
            <h6 class="font-weight-bold">{{ ($review['review_title'] ?? '') }}</h6>
            <p class="font-italic">{{ ($review['created_at'] ?? '') }}</p>
            <h6>⭐️　{{ ($review['review_score'] ?? '') }}</h6>
            <p class="font-italic">{{ ($review['review_comment'] ?? '') }}</p>

            @if($review['user_id'] == Auth::id())
            <form action="{{ route('dramas.deleteReview', $review['id'] ?? '' ) }}" method="post" class="d-inline">

                @csrf
                <button class="btn btn-outline-dark btn-sm" onclick='return confirm("削除しますか？");'>{{ __('Go Delete') }}</button>
            </form>
            @endif
            @csrf
        </div>
    </div>
    @endforeach
    <div class="col-md-10 d-flex justify-content-center mt-5">
        {{ $reviews->links() }}
    </div>
</div>

</div>
</div>
</div>
@endsection
