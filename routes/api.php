<?php

use Illuminate\Http\Request;
use App\Http\Middleware\Cors;

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

//getIP
Route::get('/getIp','GetIpController@getIp');;

//Item
Route::post('/getItems','ItemPost@getItemPosts');;
Route::get('/getSingleitem/{itemId}','ItemPost@getSingleItem');;
Route::get('/getItemPictures/{itemId}', 'ItemPost@getItemPictures');;


//Bid
Route::post('/placeBid','BidController@placeBid');;
Route::post('/closeDeal','BidController@closeDeal');;
Route::get('/getBidPlacements/{itemId}/bidder/{bidderId}/pawnshop/{pawnshopId}', 'BidController@getBidPlacements');;
Route::post('/getMyBiddings','BidController@getMyBiddings');;
Route::post('/acceptDeal','BidController@acceptDeal');;
Route::post('/rejectDeal','BidController@rejectDeal');;
Route::post('/getBiddingRecords','BidController@getBiddingRecords');;

//user
Route::post('/changeProfile','UserController@changeProfile');;
Route::post('/loginUser','UserController@loginUser');;
Route::get('/getUserDetails/{userId}', 'UserController@getUserDetails');;
Route::post('/getPendingUsers', 'UserController@getPendingUsers');;
Route::post('/addStore','UserController@addStore');;
Route::post('/updateSatus','UserController@updateSatus');;


//packages
Route::post('/addPackage','PackageController@add');;
Route::post('/updatePackage','PackageController@edit');;
Route::post('/deletePackage','PackageController@delete');;
Route::get('/viewPackages','PackageController@view');;
Route::get('/viewDurations','PackageController@viewDurations');;
Route::post('/addToPawnshop','PackageController@addToPawnshop');;
Route::get('/getItemCategories','PackageController@getItemCategories');;
Route::post('/viewPawnshopCategories','PackageController@viewPawnshopCategories');;
Route::post('/addItemCategory','PackageController@addItemCategory');;
Route::post('/sendCategoryRequest','PackageController@sendCategoryRequest');;
Route::post('/getPendingCategories','PackageController@getPendingCategories');;
Route::post('/declineCategoryRequest','PackageController@declineCategoryRequest');;
Route::post('/removeItemCategory','PackageController@removeItemCategory');;
Route::post('/getPawnshopPackages','PackageController@getPawnshopPackages');;
Route::post('/getDuration','PackageController@getDuration');;

//pawning
Route::post('/getPawnedItem','PawningController@getPawnedItem');;
Route::post('/getPaymentHistory','PawningController@getPaymentHistory');;
Route::post('/payPawn','PawningController@payPawn');;

//notifications
Route::post('/getCategoryRequestNotif','notifcontroller@getCategoryRequestNotif');;
Route::post('/getSuperAdminNotif','notifcontroller@getSuperAdminNotif');;
Route::post('/removeCategory','notifcontroller@removeCategory');;

//SMS API
Route::post('/sendSMS','SMS@sendSMS');;
Route::post('/closeDealSMS','SMS@dealClose');;

// mobile services
Route::get('/mobile/getItemCategories','PackageController@getItemCategories');;

Route::post('/mobile/uploadItem','ItemPost@addItemPost');;
Route::post('/mobile/getItems','ItemPost@getUserItem');;
Route::post('/mobile/addItemPostImage','ItemPost@addItemPostImage');;
Route::post('/mobile/getUserItemPhotos','ItemPost@getUserItemPhotos');;
Route::post('/mobile/uploadUserItemPhotos','ItemPost@uploadUserItemPhotos');;
Route::post('/mobile/uploadPhotoData','ItemPost@uploadPhotoData');;


Route::get('/mobile/getUserDetails/{userId}', 'UserController@getUserDetails');;


Route::post('/mobile/changeUserPassword', 'UserController@changePassword');;
Route::post('/mobile/changeProfile','UserController@changeUserProfile');;
Route::post('/mobile/loginUser','UserController@loginUser');;
Route::post('/mobile/addUser','UserController@addUser');;
Route::post('/mobile/saveProfileImage','UserController@saveProfileImage');;

Route::post('/mobile/getPawnshopsBid','PawnshopController@getPawnshops');;
Route::get('/mobile/getAllPawnshops','PawnshopController@getAllPawnshops');;
Route::post('/mobile/getSinglePawnshop','PawnshopController@getSinglePawnshops');;

Route::post('/mobile/getPaymentHistory','PawningController@getPaymentHistory');;
Route::post('/mobile/getPayable','PawningController@getPayable');;


Route::post('/mobile/getUserBiddings','BidController@getUserBiddings');;
Route::post('/mobile/getActiveBiddings','BidController@getActiveBiddings');;
Route::post('/mobile/getUserBiddingRecords','BidController@getUserBiddingRecords');;
Route::post('/mobile/userSendBid','BidController@placeBid');;
Route::get('/mobile/getBidPlacements/{itemId}/bidder/{bidderId}/pawnshop/{pawnshopId}', 'BidController@getBidPlacements');;
Route::post('/mobile/userSendBid','BidController@placeBid');;

Route::post('/mobile/getPawnshopPackages','PackageController@getPawnshopPackages');;
Route::post('/mobile/viewDurations','PackageController@viewDurations');;
Route::post('/mobile/getDuration','PackageController@getDuration');;
Route::post('/mobile/viewPawnshopCategories','PackageController@viewPawnshopCategories');

Route::post('/mobile/getPawnshopsOnBid','BidController@getPawnshopsOnBid');;









///////////////////////routes added by abing////////////////////////////////
Route::post('/getPawnshopPackages2','zPackageController@getPawnshopPackages2');;
Route::post('/viewPawnshopCategories2','zPackageController@viewPawnshopCategories2');;
Route::post('/addPackageToPawnshop','zPackageController@addPackageToPawnshop');;
Route::post('/editPackageOfPawnshop','zPackageController@editPackageOfPawnshop');;

Route::get('/getReports', 'zUserReportsController@getReports' );;
Route::get('/getReports2', 'zUserReportsController@getReports2' );;
Route::post('/sendReport', 'zUserReportsController@sendReport' );;
Route::get('/sendReport2/{userId}/{pawnshopId}/{situation}/{isFromPawnshop}', 'zUserReportsController@sendReport2' );;
Route::get('/getUserInfo/{id}', 'zUserController@getUserInfo' );;
Route::post('/acceptCategoryRequest', 'PackageController@acceptCategoryRequest' );;

Route::get('/getCategoriesByPawnshop/{id}', 'zCategoriesController@getCategoriesByPawnshop' );;

////////////////////////////////////////////////////////////////////////////
