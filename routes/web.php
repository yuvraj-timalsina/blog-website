<?php

    use App\Http\Controllers\CategoryController;
    use App\Http\Controllers\PostController;
    use App\Http\Controllers\ProfileController;
    use App\Http\Controllers\TagController;
    use Illuminate\Support\Facades\Route;

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

    Route::view('/', 'welcome')->name('welcome');

    Route::view('/dashboard', 'dashboard')->middleware(['auth', 'verified'])->name('dashboard');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::resources([
            'categories' => CategoryController::class,
            'tags' => TagController::class,
            'posts' => PostController::class,
        ]);
    });

    require __DIR__ . '/auth.php';
