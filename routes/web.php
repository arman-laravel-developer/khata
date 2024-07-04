<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\PrivacyController;
use App\Http\Controllers\PaymentGiveController;
use App\Http\Controllers\PaymentReceivedController;
use App\Http\Controllers\ExpenseController;

use App\Models\RoleRoute;

function getRoleName($routeName)
{
    $routesData = RoleRoute::where('route_name', $routeName)->get();
    $result = [];
    foreach ($routesData as $routeData) {
        array_push($result, $routeData->role_name);
    }
    return $result;
}
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


Route::get('/', [HomeController::class, 'index'])->name('home');


Route::get('/error', function () {
    return view('errors.404');
});





Route::get('/privacy-policy', [PrivacyController::class, 'page_view'])->name('privacy.view');
Route::get('/terms-and-condition', [PrivacyController::class, 'condition_page_view'])->name('condition.view');

Route::prefix('profile')->group(function () {
    Route::get('/', [HomeController::class, 'profileView'])->name('profile.view');
});


Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('migrate', function() {
        $exitCode = Artisan::call('migrate');

        if ($exitCode === 0) {
            $output = Artisan::output();
            return response()->json(['status' => 'success', 'message' => $output]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Migration failed'], 500);
        }
    })->name('migrate');
    Route::get('migrate-rollback', function() {
        $exitCodeRollBack = Artisan::call('migrate:rollback');

        if ($exitCodeRollBack === 0) {
            $output = Artisan::output();
            return response()->json(['status' => 'success', 'message' => $output]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Migration failed'], 500);
        }
    })->name('migrate-rollback');
    Route::get('clear',function() {
        Artisan::call('optimize:clear');
        flash()->success('Cache Clear', 'Cache clear successfully');
        return redirect()->back();
//    dd('cleared');
    });
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/payment-give', [PaymentGiveController::class, 'index'])->name('payment-give');
    Route::post('/payment-give-create', [PaymentGiveController::class, 'create'])->name('payment-give.new');
    Route::get('/payment-give-edit/{id}', [PaymentGiveController::class, 'edit'])->name('payment-give.edit');
    Route::post('/payment-give-update', [PaymentGiveController::class, 'update'])->name('payment-give.update');
    Route::post('/payment-give-delete/{id}', [PaymentGiveController::class, 'delete'])->name('payment-give.delete');

    Route::get('/payment-received', [PaymentReceivedController::class, 'index'])->name('payment-received');
    Route::post('/payment-received-create', [PaymentReceivedController::class, 'create'])->name('payment-received.new');
    Route::get('/payment-received-edit/{id}', [PaymentReceivedController::class, 'edit'])->name('payment-received.edit');
    Route::get('/payment-received-view/{id}', [PaymentReceivedController::class, 'view'])->name('payment-received.view');
    Route::post('/payment-received-update', [PaymentReceivedController::class, 'update'])->name('payment-received.update');
    Route::post('/payment-received-delete/{id}', [PaymentReceivedController::class, 'delete'])->name('payment-received.delete');

    Route::get('/expense', [ExpenseController::class, 'index'])->name('expense');
    Route::post('/expense-create', [ExpenseController::class, 'create'])->name('expense.new');
    Route::get('/expense-edit/{id}', [ExpenseController::class, 'edit'])->name('expense.edit');
    Route::post('/expense-update', [ExpenseController::class, 'update'])->name('expense.update');
    Route::post('/expense-delete/{id}', [ExpenseController::class, 'delete'])->name('expense.delete');


        Route::middleware(['roles'])->group(function () {
            Route::group(['prefix' => 'role', 'as' => 'role.'], function(){
                Route::get('/add', [RoleController::class, 'index'])->name('add');
                Route::post('/new', [RoleController::class, 'create'])->name('new');
                Route::get('/manage', [RoleController::class, 'manage'])->name('manage');
                Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('edit');
                Route::post('/update/{id}', [RoleController::class, 'update'])->name('update');
                Route::get('/delete/{id}', [RoleController::class, 'delete'])->name('delete');
            });

            Route::prefix('user')->group(function () {
                Route::get('/add', [UserController::class, 'index'])->name('user.add');
                Route::post('/new', [UserController::class, 'create'])->name('user.new');
                Route::get('/manage', [UserController::class, 'manage'])->name('user.manage');
                Route::get('/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
                Route::post('/update/{id}', [UserController::class, 'update'])->name('user.update');
                Route::get('/delete/{id}', [UserController::class, 'delete'])->name('user.delete');
            });
            Route::prefix('slider')->group(function () {
                Route::get('/add', [SliderController::class, 'index'])->name('slider.add');
                Route::post('/new', [SliderController::class, 'create'])->name('slider.new');
                Route::get('/manage', [SliderController::class, 'manage'])->name('slider.manage');
                Route::get('/edit/{id}', [SliderController::class, 'edit'])->name('slider.edit');
                Route::post('/update/{id}', [SliderController::class, 'update'])->name('slider.update');
                Route::get('/delete/{id}', [SliderController::class, 'delete'])->name('slider.delete');
            });
            Route::prefix('category')->group(function () {
                Route::get('/add', [CategoryController::class, 'index'])->name('category.add');
                Route::post('/new', [CategoryController::class, 'create'])->name('category.new');
                Route::get('/manage', [CategoryController::class, 'manage'])->name('category.manage');
                Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
                Route::post('/update/{id}', [CategoryController::class, 'update'])->name('category.update');
                Route::post('/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');
            });
            Route::prefix('privacy')->group(function () {
                Route::get('/add', [PrivacyController::class, 'index'])->name('privacy.add');
                Route::post('/new', [PrivacyController::class, 'create'])->name('privacy.new');
                Route::get('/manage', [PrivacyController::class, 'manage'])->name('privacy.manage');
                Route::get('/edit/{id}', [PrivacyController::class, 'edit'])->name('privacy.edit');
                Route::post('/update/{id}', [PrivacyController::class, 'update'])->name('privacy.update');
                Route::post('/delete/{id}', [PrivacyController::class, 'delete'])->name('privacy.delete');
            });
        });
    });

