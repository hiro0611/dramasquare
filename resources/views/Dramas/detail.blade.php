@extends('layouts.app')

@section('content')
<div class="container" style="height: 800px;">
    <div class="row justify-content-center p-4 mb-5">

        <!--カテゴリーとタイトル-->
        <div class="col-6 pl-5">
            <h6 class="col-4 mb-4" style="border-left: 12px solid #a8dda8">{{ $dramas -> category_name }}</h6>
            <h3 class="col mb-5 font-weight-light" style="border-left: 12px solid #ffa5a5; letter-spacing: 3px">{{ $dramas -> drama_title }}</h3>

            <!--画像表示-->
            <div class="col-10 m-auto">
                <img src="/uploads/{{ $dramas -> drama_image }}" style="height: 300px;">
            </div>
            <div class="col-8 mt-5 text-center">
                <a href="{{ route('dramas.review', $dramas->id) }}" class="col-8 btn btn-dark">{{ __('Write Review')  }}</a>
            </div>
        </div>

        <!--ストーリー-->
        <div class="col-6 mt-5">
            <h4 class="col-md-8 mb-5" style="text-align:left; border-left: 14px solid #b2deec; letter-spacing: 3px">STORY
            </h4>

            <div class="col-10 bg-list p-3 rounded">
                <p style="letter-spacing: 2px; line-height: 2rem">{{ $dramas -> drama_story }}</p>
            </div>
        </div>
    </div>
</div>

<!--レビュー表示-->
<div class="container">
    <h2 class="col-sm-2 m-auto text-left" style="border-left: 14px solid #fcf876; letter-spacing: 3px">Review</h2>
    <div class="row" style="margin-top: 100px">
        @foreach($reviews as $review)
        <div class="card border-0 mb-3 w-100">
            <div class="card-body bg-list rounded w-75">
                <h5 class="font-weight-bold">{{ ($review['review_title'] ?? '') }}</h5>
                <p class="font-italic">{{ ($review['created_at'] ?? '') }}</p>
                <h6>⭐️　{{ ($review['review_score'] ?? '') }}</h6>
                <p>{{ ($review['review_comment'] ?? '') }}</p>

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
            {{ $reviews->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
</div>

</div>
</div>
</div>
@endsection
