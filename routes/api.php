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
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('gan/{id}',"nishacontroller@show");
Route::post('/gan',"nishacontroller@store");
Route::delete('gan/{id}',"nishacontroller@destroy");

Route::post('loginuser/', "geoRegistercontroller@login");
Route::post('loginadmin/', "geoRegistercontroller@adminLogin");
Route::post('register/', "geoRegistercontroller@register");
Route::post('userlist/',"geoRegistercontroller@store");
Route::get('userlist/{id}',"geoRegistercontroller@show");
Route::delete('userlist/{id}',"geoRegistercontroller@destroy");
Route::get('userlist/',"geoRegistercontroller@index");
Route::post('userlist/{id}',"userprofilecontroller@update");
Route::post('logout','geologout@logoutApi');
Route::get('userprofile','geoRegistercontroller@details')->middleware('auth:api');


Route::post('taglist/',"geotagcontroller@store");
Route::get('taglist/{tag_id}',"geotagcontroller@show");
Route::delete('taglist/{tag_id}',"geotagcontroller@destroy");
Route::get('taglist/',"geotagcontroller@index");
Route::post('taglist/{tag_id}',"geotagcontroller@update");


Route::post('userlist/',"geoRegistercontroller@store");
Route::get('userlist/{id}',"geoRegistercontroller@show");
Route::delete('userlist/{id}',"geoRegistercontroller@destroy");
Route::get('userlist/',"geoRegistercontroller@index");
Route::post('userlist/{id}',"userprofilecontroller@update");
Route::post('logout','geologout@logoutApi');
Route::get('userprofile','geoRegistercontroller@details')->middleware('auth:api');

Route::post('taglist/',"geotagcontroller@store");
Route::get('taglist/{tag_id}',"geotagcontroller@show");
Route::delete('taglist/{tag_id}',"geotagcontroller@destroy");
Route::get('taglist/',"geotagcontroller@index");
Route::post('taglist/{tag_id}',"geotagcontroller@update");

Route::group(['middleware' => 'auth:api'], function () 
{    
});

//Route::post('login/',"geoRegistercontroller@log1in");
//Route::post('register/',"LoginController@register");
//Route::post('login/', "LoginController@login");

/*
Route::middleware('auth:api')->get('/User', function (Request $request) {
    return $request->User();
 });
//Route::post('loginuser/', "UserController@login");
//Route::post('user/', "UserController@store");
Route::post('register/', "UserController@register");
Route::group(['middleware' => 'auth:api'], function(){
Route::post('details', "geoRegistercontroller@details");
});*/