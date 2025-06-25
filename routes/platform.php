<?php

declare(strict_types=1);

use Tabuna\Breadcrumbs\Trail;
use App\Orchid\Screens\TopupUser;
use App\Orchid\Screens\TopupUserEdit;
use Illuminate\Support\Facades\Route;
use App\Orchid\Screens\PlatformScreen;
use App\Orchid\Screens\QuestListScreen;
use App\Orchid\Screens\EditWalletScreen;
use App\Orchid\Screens\ViewWalletScreen;
use App\Orchid\Screens\CreateQuestScreen;
use App\Orchid\Screens\UpdateQuestScreen;
use App\Orchid\Screens\UserDepositScreen;
use App\Orchid\Screens\CreateWalletScreen;
use App\Orchid\Screens\Role\RoleEditScreen;
use App\Orchid\Screens\Role\RoleListScreen;
use App\Orchid\Screens\User\UserEditScreen;
use App\Orchid\Screens\User\UserListScreen;
use App\Orchid\Screens\UserWithdrawalScreen;
use App\Orchid\Screens\UserViewDepositScreen;
use App\Orchid\Screens\Examples\ExampleScreen;
use App\Orchid\Screens\User\UserProfileScreen;
use App\Orchid\Screens\Examples\ExampleGridScreen;
use App\Orchid\Screens\UpdateUserWithdrawalScreen;
use App\Orchid\Screens\Examples\ExampleCardsScreen;
use App\Orchid\Screens\Examples\ExampleChartsScreen;
use App\Orchid\Screens\Examples\ExampleFieldsScreen;
use App\Orchid\Screens\Examples\ExampleActionsScreen;
use App\Orchid\Screens\Examples\ExampleLayoutsScreen;
use App\Orchid\Screens\Examples\ExampleTextEditorsScreen;
use App\Orchid\Screens\Examples\ExampleFieldsAdvancedScreen;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the need "dashboard" middleware group. Now create something great!
|
*/

// Main
Route::screen('/main', PlatformScreen::class)
    ->name('platform.main');

Route::screen('create-wallet', CreateWalletScreen::class)->name('admin.wallet');

Route::screen('view-wallet', ViewWalletScreen::class)->name('admin.wallet.view');

Route::screen('deposit', UserDepositScreen::class)->name('admin.deposit');

Route::screen('deposit/update/{id}', UserViewDepositScreen::class)->name('admin.deposit.view');

Route::screen('withdrawal', UserWithdrawalScreen::class)->name('admin.withdrawal');

Route::screen('withdrawal/update/{id}', UpdateUserWithdrawalScreen::class)->name('admin.withdrawal.update');

Route::screen('users/topup', TopupUser::class)->name('admin.users.topup');

Route::screen('users/topup/{id}', TopupUserEdit::class)->name('admin.users.topup.edit');

// Route::screen('quest/create', CreateQuestScreen::class)->name('admin.quest.create');

Route::screen('quest/list', QuestListScreen::class)->name('admin.quest.list');

Route::screen('quest/view/update/{id}', UpdateQuestScreen::class)->name('admin.quest.update');



// Platform > Profile
Route::screen('profile', UserProfileScreen::class)
    ->name('platform.profile')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Profile'), route('platform.profile')));

// Platform > System > Users > User
Route::screen('users/{user}/edit', UserEditScreen::class)
    ->name('platform.systems.users.edit')
    ->breadcrumbs(fn (Trail $trail, $user) => $trail
        ->parent('platform.systems.users')
        ->push($user->name, route('platform.systems.users.edit', $user)));

// Platform > System > Users > Create
Route::screen('users/create', UserEditScreen::class)
    ->name('platform.systems.users.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.systems.users')
        ->push(__('Create'), route('platform.systems.users.create')));

// Platform > System > Users
Route::screen('users', UserListScreen::class)
    ->name('platform.systems.users')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Users'), route('platform.systems.users')));

// Platform > System > Roles > Role
Route::screen('roles/{role}/edit', RoleEditScreen::class)
    ->name('platform.systems.roles.edit')
    ->breadcrumbs(fn (Trail $trail, $role) => $trail
        ->parent('platform.systems.roles')
        ->push($role->name, route('platform.systems.roles.edit', $role)));

// Platform > System > Roles > Create
Route::screen('roles/create', RoleEditScreen::class)
    ->name('platform.systems.roles.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.systems.roles')
        ->push(__('Create'), route('platform.systems.roles.create')));

// Platform > System > Roles
Route::screen('roles', RoleListScreen::class)
    ->name('platform.systems.roles')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Roles'), route('platform.systems.roles')));

// Example...
Route::screen('example', ExampleScreen::class)
    ->name('platform.example')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push('Example Screen'));

Route::screen('/examples/form/fields', ExampleFieldsScreen::class)->name('platform.example.fields');
Route::screen('/examples/form/advanced', ExampleFieldsAdvancedScreen::class)->name('platform.example.advanced');
Route::screen('/examples/form/editors', ExampleTextEditorsScreen::class)->name('platform.example.editors');
Route::screen('/examples/form/actions', ExampleActionsScreen::class)->name('platform.example.actions');

Route::screen('/examples/layouts', ExampleLayoutsScreen::class)->name('platform.example.layouts');
Route::screen('/examples/grid', ExampleGridScreen::class)->name('platform.example.grid');
Route::screen('/examples/charts', ExampleChartsScreen::class)->name('platform.example.charts');
Route::screen('/examples/cards', ExampleCardsScreen::class)->name('platform.example.cards');

// Route::screen('idea', Idea::class, 'platform.screens.idea');
