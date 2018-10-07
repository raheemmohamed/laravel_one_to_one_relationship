<?php
use App\User;
use App\Address;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Crud with One-to-One relationship using [hasOne]
|--------------------------------------------------------------------------
|*/
//insert data to hasone ->onetoone relationship
Route::get('insert/hasone', function(){
    //create new users for user table using eloquent
    $user = User::create(['name'=>'Bsc Rahem','email'=>'test@bs.com','password'=>'123456']);
    //echo the insert user table id for the some reason
    echo $user_id =$user->id;
    //getting address model to make as object with associate array and store on new variable
    $address = new Address(['name'=>'Nugegoda']);
    //finally $user->function()->Save($variable)
    return $user->address()->save($address);
});

//update one to one realtionship Method 1
Route::get('/updated/{user_id}/address',function($user_id){
    $address = Address::where('userId',$user_id)->first();
    $address->name = 'Wellampitiya';
    $address->save();
});


//update one to one realtionship Method 2
Route::get('/updates/{users_id}',function($users_id){
    $address = Address::where('userId',$users_id)->first();

    $address->name='Kolonnawa';

    $address->save();

});

//read the one to one relationship data
Route::get('/read/{id}', function ($id){
    $user = User::findOrFail($id);
    echo $user->address->name;
    echo $user->name;
});

//delete one to one relationship records
Route::get('/delete/{id}', function($id){
   $address = Address::findOrFail($id);
   $address->delete();
   return "Record deleted";
});