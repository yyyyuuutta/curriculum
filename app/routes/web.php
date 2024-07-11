<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Index;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

// パスワードリセット
// Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
// Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
// Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
// Route::post('password/reset/{token}', 'Auth\ResetPasswordController@reset');

//ホーム画面
Route::get('/', [HomeController::class, 'index'])->name('home');

//ホームにある投稿の詳細ページに遷移
Route::get('details/otherpost/{id}', [HomeController::class, 'detailsOtherPost'])->name('details.otherPost');

//マイページへ遷移
Route::get('/mypage', [HomeController::class, 'show'])->name('mypage');

//依頼を受けた投稿画面へ遷移
Route::get('/offer_post', [HomeController::class, 'OfferPost'])->name('offer.post');

//依頼を受けた投稿を完了にする
Route::get('/complete_post/{post}', [HomeController::class, 'completepost'])->name('complete.post');


//違反登録画面～登録完了
Route::get('/vaiolation_form/{id}', [HomeController::class, 'vaiolationform'])->name('vaiolation.form');
Route::post('/vaiolation_form/{id}', [HomeController::class, 'vaiolationpost']);

//退会確認画面へ遷移
Route::get('/account_delete', [HomeController::class, 'accountDelete'])->name('account.delete');

// 退会処理（物理削除）
Route::post('/account_destroy', [HomeController::class, 'accountDestroy'])->name('account.destroy');

//新規投稿画面へ遷移
Route::get('/newpost', [HomeController::class, 'newPostForm'])->name('newpost');

//新規投稿を処理
Route::post('/newpost', [HomeController::class, 'newPost'])->name('create.post');   

//投稿編集ページに遷移
Route::get('edit_post/{posts}', [HomeController::class, 'editPostForm'])->name('edit.post');

//投稿編集処理
Route::post('edit_post/{posts}', [HomeController::class, 'editPost']);

//自分が投稿した投稿詳細ページに遷移
Route::get('details_post/{post}', [HomeController::class, 'detailsPost'])->name('details.post');

//投稿の物理削除
Route::get('delete_post/{posts}', [HomeController::class, 'deletePost'])->name('delete.post');

//プロフィール編集画面へ遷移
Route::get('edit_myacount/{id}', [HomeController::class, 'editMyAcountForm'])->name('edit.myacount');

//プロフィール編集処理
Route::post('edit_myacount/{id}', [HomeController::class, 'editMyAcount'])->name('update.myacount');

//依頼フォームへ遷移
Route::get('request_form/{id}', [HomeController::class, 'RequestForm'])->name('request.form');

//依頼確認画面へ遷移
Route::post('request_confirm/{id}', [HomeController::class, 'RequestConfirm'])->name('request.confirm');

//依頼送信
Route::post('request_submit', [HomeController::class, 'RequestSubmit'])->name('request.submit');

// いいね機能
Route::post('ajaxlike', 'HomeController@ajaxlike')->name('posts.ajaxlike');



//管理者画面表示
Route::get('/admin', [AdminController::class, 'AdminPage']);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//ユーザーアカウントの物理削除
Route::get('delete_account/{users}', [HomeController::class, 'deleteAccount'])->name('delete.account');

//投稿の論理削除
Route::post('softdelete_post/{post}', [HomeController::class, 'softdeletePost'])->name('softdelete.post');
