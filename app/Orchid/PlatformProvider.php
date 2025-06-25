<?php

declare(strict_types=1);

namespace App\Orchid;

use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\OrchidServiceProvider;
use Orchid\Screen\Actions\Menu;
use Orchid\Support\Color;

class PlatformProvider extends OrchidServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @param Dashboard $dashboard
     *
     * @return void
     */
    public function boot(Dashboard $dashboard): void
    {
        parent::boot($dashboard);

        // ...
    }

    /**
     * Register the application menu.
     *
     * @return Menu[]
     */
    public function menu(): array
    {
        return [
            Menu::make('Dashboard')
                ->icon('bs.book')
                ->title('Home')
                ->route(config('platform.index'))
                ->divider(),

            Menu::make('View Admin Wallets')
                ->title('Wallet Management/Transactions')
            ->route('admin.wallet.view')
                ->icon('bs.eye'),

            Menu::make('Create a Wallet')
            ->route('admin.wallet')
                ->icon('bs.plus'),

            Menu::make('View Deposit')
            ->route('admin.deposit')
                ->icon('bs.download'),

            Menu::make('Top-up user')
            ->route('admin.users.topup')
                ->icon('bs.plus'),

            Menu::make('View Withdrawals')
            ->route('admin.withdrawal')
            ->icon('bs.upload')
            ->divider(),





            Menu::make(__('Manage Car Quests'))
                ->icon('bs.eye')
                ->route('admin.quest.list')
                ->permission('platform.systems.users')
                ->title(__('Car Quest')),

            Menu::make('Create a Car Quest')
            ->route('admin.quest.create')
            ->icon('bs.upload')
            ->divider(),




            Menu::make(__('Users'))
                ->icon('bs.people')
                ->route('platform.systems.users')
                ->permission('platform.systems.users')
                ->title(__('Access Controls')),

            Menu::make(__('Roles'))
                ->icon('bs.shield')
                ->route('platform.systems.roles')
                ->permission('platform.systems.roles')
                ->divider(),




        ];
    }

    /**
     * Register permissions for the application.
     *
     * @return ItemPermission[]
     */
    public function permissions(): array
    {
        return [
            ItemPermission::group(__('System'))
                ->addPermission('platform.systems.roles', __('Roles'))
                ->addPermission('platform.systems.users', __('Users')),
        ];
    }
}
