<?php

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

use Illuminate\Support\Facades\Route;

Route::get('/login','AdminController@login')->name('manage-login');
Route::get('/ad-total', 'AdminController@adTotal')->name('ad-total');
Route::post('/ad-total', 'AdminController@postAdTotal');
Route::post('/ad-total-list', 'AdminController@adTotalList');
Route::get('/public-ad-total', 'AdminController@publicAdTotal')->name('public-ad-total');
Route::post('/public-ad-total-list', 'AdminController@publicAdTotalList');


Route::group(['middleware'=>'checkAdmin','as' =>'admin.'],function () {
    Route::get('/home', function () {
        return view('admin.home', [
            'tab' => 'home'
        ]);
    });

    Route::get('/search-members', 'AdminController@searchMembers')->name('search-members');
    Route::post('/search-members', 'AdminController@searchMembersPost');

    Route::get('/member-detail/{member_id}', 'AdminController@memberDetail')->name('member-detail');

    Route::get('/character-register', 'AdminController@characterRegister');
    Route::post('/character-register', 'AdminController@characterRegisterPost');

    Route::get('/user-box', 'AdminController@userBox');
    Route::post('/box_add', 'AdminController@userBoxAdd');
    Route::post('/box-delete', 'AdminController@userBoxDel');
    Route::get('/box-detail/{box_id}', 'AdminController@userBoxDetail');
    Route::post('/box-edit', 'AdminController@userBoxEdit');

    Route::get('/search-characters', 'AdminController@searchCharacters')->name('search-characters');
    Route::post('/search-characters', 'AdminController@searchCharactersPost');

    Route::get('/character-detail/{character_id}', 'AdminController@characterDetail')->name('character-detail');

    Route::get('/total-sales', 'AdminController@totalSales')->name('total-sales');
    Route::post('/total-sales', 'AdminController@getTotalSales');
    Route::get('/pay-list', 'AdminController@payList')->name('pay-list');
    Route::post('/pay-list', 'AdminController@getPayList')->name('pay-list');
    Route::get('/csv-import', 'AdminController@csvImport')->name('csv-import');
    Route::post('/csv-import', 'AdminController@sendCsvImport');
    Route::get('/auto-message', 'AdminController@autoMessage')->name('auto-message');
    Route::get('/auto-delete/{auto_id}', 'AdminController@autoDelete');
    Route::post('/member-delete', 'AdminController@memberDelete');
    Route::post('/member-multi-delete', 'AdminController@memberMultiDelete');
    Route::post('/character-delete', 'AdminController@characterDelete');
    Route::post('/auto-message', 'AdminController@autoMessagePost');
    Route::get('/auto-list', 'AdminController@autoMessageList')->name('auto-list');
    Route::post('/user-send', 'AdminController@userSend');
    Route::post('/member-point', 'AdminController@memberPoint');
    Route::post('/character-point', 'AdminController@characterPoint');
    Route::post('/select-users', 'AdminController@selectUsers');
    Route::post('/question-modify', 'AdminController@questionModify');
    Route::post('/auto-modify', 'AdminController@autoModify');
    Route::post('/modify-character', 'AdminController@modifyCharacter');
    Route::post('/modify-user', 'AdminController@modifyUser');
    Route::post('/save-memo', 'AdminController@saveMemo');
    Route::get('/reply-message', 'AdminController@replyMessage');
    Route::post('/message-list', 'AdminController@messageList');
    Route::get('/dig-user', 'AdminController@digUser');
    Route::post('/dig-message', 'AdminController@digMessage');
    Route::post('/user-list', 'AdminController@userList');

    Route::get('/ad-code', 'AdminController@adCode')->name('ad-code');
    Route::get('/ad-list', 'AdminController@adList');
    Route::post('/add-code', 'AdminController@addCode');
});

