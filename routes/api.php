 <?php
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//  header('Access-Control-Allow-Headers: Content-Type, x-xsrf-token, x_csrftoken');
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('loginuser/', "geoRegistercontroller@login");
Route::post('loginadmin/', "geoRegistercontroller@adminLogin");
Route::post('register/', "geoRegistercontroller@register");
Route::post('userlist/',"geoRegistercontroller@store");
Route::get('userlist/{id}',"geoRegistercontroller@show");
Route::delete('userlist/{id}',"geoRegistercontroller@destroy");
Route::get('userlist/',"geoRegistercontroller@index");
Route::post('userlist/{id}',"userprofilecontroller@update");
Route::post('logout/','geologout@logoutApi');
Route::get('userprofile','geoRegistercontroller@details')->middleware('auth:api');



Route::get('tagDisplaybyid/{tag_id}',"GeotagsController@show")->middleware('auth:api');
Route::delete('tagDelete/{tag_id}',"GeotagsController@destroy")->middleware('auth:api');
Route::get('tagDisplay/',"GeotagsController@index")->middleware('auth:api');
Route::post('tagUpdate/{tag_id}',"GeotagsController@update")->middleware('auth:api');
// Route::post('pushnotify/',"geotagcontroller@push_notification");
Route::post('tagAdd',"GeotagsController@store")->middleware('auth:api');



Route::post('adminAddtag/',"tagcontroller@store");
Route::get('adminDisplaytag/',"tagcontroller@index");
Route::post('adminUpdatetag/{id}',"tagcontroller@update");
Route::delete('adminDeletetag/{id}',"tagcontroller@destroy");
Route::get('adminSearchtag/',"tagcontroller@autoComplete");
Route::get('admintagstatus/{id}/',"tagcontroller@tagupdatestatus");



Route::get('changestatus/{id}','updateuserstatuscontroller@updatestatus');
