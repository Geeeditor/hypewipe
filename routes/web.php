<?php

use App\Models\UserWallet;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserWalletController;
use App\Orchid\Screens\EditWalletScreen;
use App\Http\Controllers\QuestController;


Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Route::any()
Route::middleware(['admin', 'web'])->group(function () {
    Route::screen('admin/wallet/edit/{adminWallet}', EditWalletScreen::class)
    ->name('admin.wallet.edit'); // Include necessary middleware

    Route::get('admin/quests/create', [QuestController::class, 'create'])->name('admin.quest.create');

    Route::post('/admin/quests/store', [QuestController::class, 'store'])->name('admin.quest.store');
});




Route::middleware('auth')->group(function () {

    Route::get('/wallet',  [HomeController::class, 'viewWallet'])->name('wallet');

    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    Route::get('/tasks', [HomeController::class, 'quest'])->name('tasks');

    Route::post('/tasks/store', [HomeController::class, 'questStore'])->name('tasks.store');

    Route::get('/withdraw',  [HomeController::class, 'withdraw'])->name('withdraw');

    Route::post('/withdraw/process',  [HomeController::class, 'withdrawStore'])->name('withdraw.store');

    Route::get('/profile', [HomeController::class, 'viewProfile'])->name('profile');

    Route::post('/wallet/create', [UserWalletController::class, 'addWallet'])->name('wallet.create');


    Route::get('/notification', [HomeController::class, 'userNotification'])->name('notification');

    Route::get('/wallet/topup', [HomeController::class, 'topUp'])->name('wallet.topup');

    Route::post('/wallet/topup/process', [HomeController::class, 'topUpStore'])->name('wallet.topup.store');

    Route::delete('/available-wallets/{walletAddress}', [UserWalletController::class, 'deleteAvailableWallet'])
        ->name('available-wallets.delete');


    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/delete', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
