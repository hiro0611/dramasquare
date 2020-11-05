@extends('layouts.app')

@section('content')
@section('body_style', 'background: url("../images/detail_cinema2.jpg");')
<div class="container">

    <div class="row rounded" style="background: rgba(230, 213, 184, 0.8);">
        <!--bg-color: #e6d5b8-->

        <div class="col-3">
            <form action="{{ route('dramas.search') }}" method="post" class="mt-3 pb-2 rounded">
                @csrf
                <blockquote class="blockquote text-center">
                    <h5 class="m-auto w-75" style="border-left: 12px solid #a8dda8">Search by Category</h5>
                    <footer class="blockquote-footer">カテゴリー検索
                </blockquote>

                <select type="text" id="category_name" class="form-control mt-3" name="category_name" autocomplete="category_name">
                    @foreach($category_names as $key => $value)
                    <option>{{ $value }}</option>
                    @endforeach
                </select>

                <div class="col text-center">
                    @csrf
                    <button class="btn btn-dark col-7 mt-5">GO</button>
                </div>
            </form>

            <div class="sidebar_content mt-5 p-2">
                <blockquote class="blockquote text-center">
                    <h5 class="m-auto" style="border-left: 12px solid #ffa5a5; width: 40%;">Reviews</h5>
                    <footer class="blockquote-footer">最新レビュー
                </blockquote>

                <div class="card p-1 shadow-lg" style="background: #ebebeb">
                    @foreach($reviews as $review)

                    <p class="mb-0">{{ ($review -> name) }}</p>
                    <p class="mb-0 text-secondary">{{ ($review -> created_at) }}</p>
                    <p class="mb-0 font-weight-bold">{{ ($review -> drama_title) }}</p>
                    <p class="mb-0"><a href="{{ route('dramas.detail', $review->drama_id) }}">{{ ($review -> review_title) }}</a></p>
                    <p>⭐️ {{ ($review -> review_score) }}</p>

                    @endforeach
                </div>
            </div>
        </div>

        <div class="col-9">
            <div class="row mt-3">
                <h3 class="col-10 ml-3" style="border-left: 14px solid #b2deec">Drama List</h3>
                <p class="col-10 m-0">海外ドラマの人気作品を紹介します</p>
                <p class="col-10">気になった作品のレビューを参考に、視聴してみましょう</p>

                @if(isset($results))
                @foreach($results as $result)
                <div class="col-3 mb-5">
                    <div class="card border-0" style="width: 12rem; background: #e3dfc8;">
                        <div class=" card-body p-0">

                            <!--画像-->
                            <a href="{{ route('dramas.detail', $result->id) }}">
                                <img src="/uploads/{{ $result -> drama_image }}" class="rounded" style="height:250px; width:100%">
                            </a>

                            <!--カテゴリー-->
                            <h6 class="mt-2 text-secondary">{{ ($result -> category_name) }}</h6>

                            <!--タイトル-->
                            <h6 class="card-title m-0">{{ ($result -> drama_title) }}</h6>

                            <!--レビュー画面へ-->
                            <!--<a href="{{ route('dramas.detail', $result->id) }}" class="btn btn-primary">{{ __('Go Review') }}</a>-->

                            <!--編集ボタン-->
                            <!--<a href="{{ route('dramas.edit',$result->id ) }}" class="btn btn-warning">{{ __('Go Edit')  }}</a>-->

                            <!--削除ボタン-->
                            <!--<form action="{{ route('dramas.delete', $result['id'] ?? '' ) }}" method="post" class="d-inline">

                                @csrf
                                <button class="btn btn-danger" onclick='return confirm("削除しますか？");'>{{ __('Go Delete') }}</button>
                            </form>-->
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="d-flex justify-content-center m-5 col-10">
                    {{ $results->links() }}
                </div>

                @elseif(isset($dramas))
                @foreach($dramas as $drama)
                <div class="col-3 mb-5">
                    <div class="card border-0" style="width: 12rem; background: #e3dfc8;">
                        <div class="card-body p-0">

                            <!--画像-->
                            <a href="{{ route('dramas.detail', $drama -> id) }}">
                                <img src="/uploads/{{ $drama -> drama_image }}" class="rounded" style="height:250px; width:100%">
                            </a>

                            <!--カテゴリー-->
                            <h6 class="mt-2 text-secondary">{{ ($drama -> category_name) }}</h6>

                            <!--タイトル-->
                            <h6 class="card-title m-0">{{ ($drama -> drama_title) }}</h6>

                            <!--レビュー画面へ-->
                            <!--<a href="{{ route('dramas.detail', $drama->id) }}" class="btn btn-primary">{{ __('Go Review') }}</a>-->

                            <!--編集ボタン-->
                            <!--<a href="{{ route('dramas.edit',$drama->id ) }}" class="btn btn-warning">{{ __('Go Edit')  }}</a>-->

                            <!--削除ボタン-->
                            <!--<form action="{{ route('dramas.delete', $drama->id ) }}" method="post" class="d-inline">

                                @csrf
                                <button class="btn btn-danger" onclick='return confirm("削除しますか？");'>{{ __('Go Delete') }}</button>
                            </form>-->
                        </div>
                    </div>
                </div>
                @endforeach

                <div class="d-flex justify-content-center m-5 col-10">
                    {{ $dramas->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
