<?php

use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    // fetch all users
    $users = DB::select("SELECT * FROM users"); // raw sql query
    // $users = DB::table("users")->where('id', 5)->get(); // laravel query builder
    // $users = DB::table("users")->find(7); // get the id which is 7
    // $users = DB::table("users")->pluck('email'); // get the column which is email

    // create new user
    // $user = DB::insert("INSERT INTO users (name, email, password) values (?,?,?)", ["Dayle", "dayle5@gmail.com", "123123123"]);
    // $user = DB::insert("INSERT INTO users (name, email, password) values (?,?,?)", ["Dayle", "dayle5@gmail.com", "123123123"]);
    // $user = DB::table("users")->insert([
    //     'name' => 'Janssen',
    //     'email' => 'janssen.uy2@gmail.com',
    //     'password' => '123123123'
    // ]);

    // update user
    // $user = DB::update("UPDATE users set name=? WHERE name=?", ["Janssen", "Janssen Earl"]);
    // $user = DB::table("users")->where('id', 5)->update(['name' => 'Earl', 'email' => 'earl@gmail.com']); // laravel query builder

    // delete user
    // $user = DB::delete("DELETE FROM users WHERE id=?", [4]);
    // $user = DB::table("users")->where('id', 5)->delete();
    dd($users);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
