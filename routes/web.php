<?php

use App\Http\Controllers\Profile\AvatarController;
use App\Http\Controllers\ProfileController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function (){
    return view('welcome');
});

Route::get('/help', function () {
    // Raw SQL query ===============================================================================================================
    // $users = DB::select("SELECT * FROM users"); // get all users
    // $user = DB::insert("INSERT INTO users (name, email, password) values (?,?,?)", ["Dayle", "dayle5@gmail.com", "123123123"]); // insert
    // $user = DB::update("UPDATE users set name=? WHERE name=?", ["Janssen", "Janssen Earl"]); // update
    // $user = DB::delete("DELETE FROM users WHERE id=?", [4]); // delete
    
    // Laravel Query Builder =======================================================================================================
    // $users = DB::table("users")->where('id', 5)->get(); // Get
    // $users = DB::table("users")->find(7); // get the id which is 7
    // $users = DB::table("users")->pluck('email'); // get the column which is email

    // $user = DB::table("users")->insert([ // insert
    //     'name' => 'Janssen',
    //     'email' => 'janssen.uy2@gmail.com',
    //     'password' => '123123123'
    // ]);

    // $user = DB::table("users")->where('id', 5)->update(['name' => 'Earl', 'email' => 'earl@gmail.com']); // update
    // $user = DB::table("users")->where('id', 5)->delete(); // Delete

    // Eloquent Model ==============================================================================================================
    $users = User::get()->where('id', 7)->first(); 
    // $user = User::create([ 
    //     'name' => 'janssen earl uy',
    //     'email' => 'janssen.uy8@gmail.com',
    //     'password' => '123123123'
    // ]);

    // $user = User::find(7);
    // $user->update([
    //     'name' => 'Janssen Earl Uy',
    //     'email' => 'janssen.earl@gmail.com',
    // ]);

    // $user = User::find(7);
    // $user->delete();

    dd($users);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::patch('/profile/avatar', [AvatarController::class, 'update'])->name('profile.avatar');
});

require __DIR__.'/auth.php';
