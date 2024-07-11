<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\User;
use App\Like;
use App\Joboffer;
use App\Spam;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    //ログイン後のメインページ
    public function index(Request $request)
    {
        //現在のユーザーを取得
        $user = Auth::user();

        // dd($user->role);

        if($user->role == 0){
            return redirect('/admin');
        }

        // spam_id が 1 でない投稿を取得
        $posts = Post::where('spam_id', '!=', 1)->get();
        
        
        // キーワード検索
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($query) use ($search) {
                $query->where('title', 'LIKE', "%{$search}%")
                    ->orWhere('memo', 'LIKE', "%{$search}%");
            });
        }

        // 金額範囲検索
        if ($request->has('amount')) {
            $amountOption = $request->input('amount');
            switch ($amountOption) {
                case 1:
                    $query->whereBetween('amount', [1, 999]);
                    break;
                case 2:
                    $query->whereBetween('amount', [1000, 9999]);
                    break;
                case 3:
                    $query->whereBetween('amount', [10000, 49999]);
                    break;
                case 4:
                    $query->whereBetween('amount', [50000, 99999]);
                    break;
                case 5:
                    $query->where('amount', '>=', 100000);
                    break;
            }
        }


        // 検索クエリをビューに渡す
        $searchQuery = $request->input('search');
        // dd($searchQuery);

        return view('home', [
            'posts' => $posts, 
            'searchQuery' => $searchQuery
        ]);
    }

    // ほかの人が投稿した投稿詳細
    public function detailsOtherPost(int $id) {

        // $post = Post::findOrFail($id);

        $post = Post::withCount('likes')->findOrFail($id);
        $like_model = new Like;

        return view('details_otherpost', [
            'post' => $post,
            'like_model'=>$like_model,
        ]);
    } 

    // 依頼フォームの表示
    public function RequestForm(int $id) {
        return view('request_form',[
            'id' => $id,
        ]);
    }

    // 依頼確認の処理
    public function RequestConfirm(int $id, Request $request) {
    // 元の投稿を取得
    $post = Post::find($id);

    // 依頼内容の保存処理
    $date = new Joboffer;
    $date->tel = $request->tel;
    $date->email = $request->email;
    $date->user_id = Auth::id();   
    $date->post_id = $id;
    $date->deadline = $request->deadline;
    $date->memo = $request->memo;
    // $date->status = $request->status;

    // データベースに保存
    Auth::user()->joboffers()->save($date);

    // Postsテーブルのstatusを１(依頼中)にする
    $post->status = 1; 
    $post->save();

    return redirect('/');
}


    //いいね機能
    public function ajaxlike(Request $request)
    {
        $id = Auth::user()->id;
        $post_id = $request->post_id;
        $like = new Like;
        $post = Post::findOrFail($post_id);

        // 空でない（既にいいねしている）なら
        if ($like->like_exist($id, $post_id)) {
            //likesテーブルのレコードを削除
            $like = Like::where('post_id', $post_id)->where('user_id', $id)->delete();
        } else {
            //空（まだ「いいね」していない）ならlikesテーブルに新しいレコードを作成する
            $like = new Like;
            $like->post_id = $request->post_id;
            $like->user_id = Auth::user()->id;
            $like->save();
        }

        //loadCountとすればリレーションの数を○○_countという形で取得できる（今回の場合はいいねの総数）
        $postLikesCount = $post->loadCount('likes')->likes_count;

        //一つの変数にajaxに渡す値をまとめる
        $json = [
            'postLikesCount' => $postLikesCount,
        ];
        //下記の記述でajaxに引数の値を返す
        return response()->json($json);
    }


    //ログインしている人のマイページ
    public function show()
    {
        // 現在のユーザーを取得
        $user = Auth::user();

        // ログインしている人の投稿をすべて取得
        $posts = Auth::user()->posts()->get();

        // ビューにデータを渡して表示
        return view('mypage',[
            'posts' => $posts
        ]);
        
        Auth::user()->posts()->get($posts);

    }


    // ユーザーが依頼を受けた投稿の一覧を表示する
    public function OfferPost()
    {
        // ログインしているユーザーの依頼された投稿取得
        $posts = Auth::user()->posts()->where('status', '=', 1 )->get();
        // dd($post);
        // $joboffers = Auth::user()->joboffers()->get();

        // ビューに渡す
        return view('offer_post', compact('posts'));
    }
    
    //投稿のステータス完了
    public function completepost(Post $post){
        // Postsテーブルのstatusを2にする
        $post->status = 2; 
        $post->save();

        return redirect('/offer_post');
    }

    public function vaiolationform(int $id){

        return view('vaiolation_form',[
            'id' => $id,
        ]);
    }

    public function vaiolationpost(int $id, Request $request){
        $spam = new Spam;

        $spam->post_id = $id;
        $spam->user_id = Auth::user()->id;
        $spam->report = $request->report;
        $spam->save();

        return redirect('/');
    }        


    //アカウント退会確認画面遷移
        public function accountDelete()
    {
        return view('account_delete');
    }

    // 退会処理
    public function accountDestroy(Request $request)
    {
        $user = Auth::user();
        Auth::logout();
        $user->delete();
        return redirect('/login');
    }


    //プロフィール編集画面
    public function editMyAcountForm(int $id) {

        // ユーザーID取得
        $user = Auth::user()->find($id);

        return view('edit_myacount', [

            'user' => $user,

        ]);
    }

    //プロフィール編集更新
    public function editMyAcount(int $id, Request $request) {

        // ユーザーID取得
        $user = Auth::user()->find($id);

        $columns = ['image', 'name', 'email', 'profile_text',];

        foreach ($columns as $column) {

            $user->$column = $request->$column;    

        }

        //アイコン画像保存処理
        if($request->file('image')) {
            // 拡張子つきでファイル名を取得
            $imageName = $request->file('image')->getClientOriginalName();
   
            // 拡張子のみ
            $extension = $request->file('image')->getClientOriginalExtension();
    
            // 新しいファイル名を生成（形式：元のファイル名_ランダムの英数字.拡張子）
            $newImageName = pathinfo($imageName, PATHINFO_FILENAME) . "_" . uniqid() . "." . $extension;
   
           // レコードを挿入したときのIDを取得  
           $lastInsertedId = $user->id;
   
           // ディレクトリを作成
           if (!file_exists(public_path() . "/images/img/" . $lastInsertedId)) {
               mkdir(public_path() . "/images/img/" . $lastInsertedId, 0777);
           }
   
            $request->file('image')->move(public_path() . "/images/img/". $lastInsertedId, $newImageName);

            $user->image = $newImageName;
   
        }

        $user->save();

        return redirect('/mypage');
    }


    public function NewPostForm() {
        
        return view('newpost');
    }

    // 新規投稿
    public function NewPost(Request $request) {      

        $image2 = $request->file('image2');

        // 投稿の保存処理
        $posts = new Post;
        $posts->title = $request->title;
        $posts->amount = $request->amount;
        $posts->memo = $request->memo;
        $posts->status = $request->status;

        // Postsテーブルのstatusを2(掲載中)にする
        $posts->status = 0;

        //画像保存処理
        if($request->file('image1')){
            // 拡張子つきでファイル名を取得
            $imageName1 = $request->file('image1')->getClientOriginalName();
   
            // 拡張子のみ
            $extension1 = $request->file('image1')->getClientOriginalExtension();
    
            // 新しいファイル名を生成（形式：元のファイル名_ランダムの英数字.拡張子）
            $newImageName1 = pathinfo($imageName1, PATHINFO_FILENAME) . "_" . uniqid() . "." . $extension1;
   
           // レコードを挿入したときのIDを取得  
           $lastInsertedId = $posts->id;
   
           // ディレクトリを作成
           if (!file_exists(public_path() . "/images/img/" . $lastInsertedId)) {
               mkdir(public_path() . "/images/img/" . $lastInsertedId, 0777);
           }
   
            $request->file('image1')->move(public_path() . "/images/img/". $lastInsertedId, $newImageName1);

            $posts->image = $newImageName1;
   
           }

        Auth::user()->posts()->save($posts);

        return redirect('/mypage');
    }

    //投稿編集画面
    public function editPostForm(int $id) {

        // 特定の投稿を取得
        $post = Auth::user()->posts()->find($id);

        return view('edit_post', [

            'post' => $post,

        ]);
    }

    // 投稿編集更新
    public function editPost(int $id, Request $request) {

        // 特定の投稿を取得
        $posts = Auth::user()->posts()->find($id);

        $columns = ['title', 'amount', 'memo', 'image', 'status'];

        foreach ($columns as $column) {
            $posts->$column = $request->$column;    
        }

        $posts->save();

        return redirect('/');
    }
    
    //投稿詳細
    public function detailsPost(int $id) {
        $post = Auth::user()->posts()->find($id);

        return view('details_post', [

            'post' => $post,

        ]);
    }

    //投稿の物理削除
    public function deletePost($id) {

        $posts = new Post;
        $posts = Auth::user()->posts()->find($id);
        $posts->delete();

        return redirect('/mypage');
    }


    //管理者ページ
    public function managerPage() {

        // 違反報告数の多い投稿上位20件を取得
        $posts = Post::orderBy('spam_id', 'desc')->take(20)->get();

        // 表示停止された投稿件数の多いユーザー上位10件を取得
        $users = User::withCount('posts as disabled_post_count')->orderBy('disabled_post_count', 'desc')->take(10)->get();

        return view('admin.index', compact('posts', 'users'));
    }
    

        //ユーザーアカウントの物理削除
        public function deleteAccount($id) {

            $users = Auth::user()->find($id);
            $users->delete();
    
            return redirect('/admin');
        }

        //違反報告が多かった投稿の論理削除(利用停止ボタンを押したら)
        public function softdeletePost($id) {

            $post = Post::findOrFail($id);
            $post->spam_id = 1;
            $post->save();

            return redirect('/admin');
        }


    
}
