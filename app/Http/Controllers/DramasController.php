<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Drama;
use App\Review;

class DramasController extends Controller
{
    //新規登録画面表示
    public function new()
    {
        $category_names = config('category');
        return view('dramas.new')->with(['category_names' => $category_names]);
    }

    //新規登録ポスト
    public function create(Request $request)
    {
        $request->validate([

            'drama_title' => 'required|string|max:255',
            'category_name' => 'required',
            'drama_story' => 'required|string|max:500',
            'drama_image' => 'file|image|mimes:jpeg,png'
        ]);

        if ($file = $request->drama_image) {
            //保存するファイルに名前をつける
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            //Laravel直下のpublicディレクトリに新フォルダをつくり保存する
            $target_path = public_path('/uploads/');
            $file->move($target_path, $fileName);
        } else {
            //画像が登録されなかった時はから文字をいれる
            $fileName = "";
        }

        $dramas = new Drama;
        //インスタンスを生成
        $dramas->user_id = $request->user()->id;
        //DBのuser_idに、操作しているユーザーのIDをいれる。
        $dramas->drama_title = $request->drama_title;
        $dramas->category_name = $request->category_name;
        $dramas->drama_story = $request->drama_story;
        $dramas->drama_image = $fileName;
        //DBのdrama_imageに、$fileNameでつけたファイル名を保存
        $dramas->save();
        //$dramas->fill($request->all())->save();

        return redirect('/')->with('flash_message', __('Registered.'));
    }

    //トップページ一覧表示
    public function index()
    {
        //セレクトボックスのoptionをconfigから出力
        $category_names = config('category_index');
        $dramas = Drama::paginate(8);

        //最新のレビューを３件取り出す
        $reviews = Review::join('users', 'reviews.user_id', '=', 'users.id')
            ->join('dramas', 'reviews.drama_id', '=', 'dramas.id')
            ->SELECT('reviews.*', 'users.name', 'dramas.drama_title')->latest()->limit(3)->get();

        //$reviews = Review::latest()->limit(3)->get();
        return view('index', ['dramas' => $dramas], ['reviews' => $reviews])->with(['category_names' => $category_names]);
    }

    //カテゴリー別検索機能
    public function search(Request $request)
    {
        $category_names = config('category_index');
        //セレクトボックスで選択された値を取得
        $input = $request->input('category_name');

        //最新のレビューを３件取り出す
        $reviews = Review::join('users', 'reviews.user_id', '=', 'users.id')
            ->join('dramas', 'reviews.drama_id', '=', 'dramas.id')
            ->SELECT('reviews.*', 'users.name', 'dramas.drama_title')->latest()->limit(3)->get();

        //セレクトボックスで選択されたのが、全てか各カテゴリーかを識別
        if ($input === '全て') {
            $dramas = Drama::paginate(8);
            return view('index', ['dramas' => $dramas], ['reviews' => $reviews])->with(['category_names' => $category_names]);
        } else {
            $results = Drama::where('category_name', $input)->paginate(8);
            return view('index', ['results' => $results], ['reviews' => $reviews])->with(['category_names' => $category_names]);
        }
    }

    //編集画面表示
    public function edit($id)
    {
        if (!ctype_digit($id)) {
            redirect('/')->with('flash_message', __('Invalid performed was operated'));
        }

        $category_names = config('category');
        $dramas = Drama::find($id);
        return view('dramas.update', ['dramas' => $dramas])->with(['category_names' => $category_names]);
    }

    //編集内容ポスト
    public function update(Request $request, $id)
    {
        $request->validate([

            'drama_title' => 'required|string|max:255',
            'category_name' => 'required',
            'drama_story' => 'required|string|max:500',
            'drama_image' => 'file|image|miles:jpeg,png'
        ]);

        $dramas = Drama::find($id);
        $dramas->fill($request->all())->save();

        return redirect('/')->with('flash_message', __('updated'));
    }

    //ドラマ削除機能
    public function delete($id)
    {
        if (!ctype_digit($id)) {
            redirect('/dramas/{id}/delete')->with('flash_message', __('Invalid operation was performed.'));
        }

        Drama::find($id)->delete();
        //指定ドラマのレビューも削除
        Review::where('drama_id', $id)->delete();

        return redirect('/')->with('flash_message', __('Deleted'));
    }

    //ドラマ詳細表示
    public function detail($id)
    {
        if (!ctype_digit($id)) {
            redirect('/')->with('flash_message', __('Invalid operation was performed.'));
        }

        $dramas = Drama::find($id);
        //データベースreviews内の指定ドラマidと一致するレビューを全て取得
        $reviews = Review::where('drama_id', $id)->latest()->paginate(5);

        return view('dramas.detail', ['dramas' => $dramas], ['reviews' => $reviews]);
    }

    //レビュー画面
    public function review($id)
    {
        $dramas = Drama::find($id);
        return view('dramas.review', ['dramas' => $dramas]);
    }

    //レビューをポスト
    public function postReview(Request $request, $id)
    {
        $request->validate([
            'review_title' => 'required|string|max:30',
            'review_score' => 'required',
            'review_comment' => 'required|string|max:500'
        ]);

        $reviews = new Review;
        $dramas = Drama::find($id);
        $reviews->user_id = $request->user()->id;
        $reviews->drama_id = $dramas->id;
        $reviews->review_title = $request->review_title;
        $reviews->review_score = $request->review_score;
        $reviews->review_comment = $request->review_comment;

        $reviews->save();

        return redirect('/')->with('flash_message', __('Post Review'));
    }

    //レビュー削除機能
    public function deleteReview($id)
    {
        if (!ctype_digit($id)) {
            redirect('/dramas/{id}/delete')->with('flash_message', __('Invalid operation was performed.'));
        }

        Review::find($id)->delete();

        return redirect('/')->with('flash_message', __('Deleted'));
    }
}
