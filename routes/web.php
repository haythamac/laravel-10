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
    $users = DB::select("SELECT * FROM users");

    // create new user
    // $user = DB::insert("INSERT INTO users (name, email, password) values (?,?,?)", ["Dayle", "dayle5@gmail.com", "123123123"]);

    // update user
    // $user = DB::update("UPDATE users set name=? WHERE name=?", ["Janssen", "Janssen Earl"]);

    // delete user
    // $user = DB::delete("DELETE FROM users WHERE id=?", [4]);
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
