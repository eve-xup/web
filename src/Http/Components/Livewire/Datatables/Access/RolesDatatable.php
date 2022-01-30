<?php

namespace Xup\Web\Http\Components\Livewire\Datatables\Access;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Xup\Core\Models\Access\Role;

class RolesDatatable extends DataTableComponent
{

    public function setTableDataClass($row)
    {
        return 'px-4 py-2';
    }

    public function columns(): array
    {
        return [
            Column::make('Role', 'title')
            ->searchable()
            ->sortable(),

            Column::make('Users', 'users_count'),

            Column::make('Permissions', 'permissions_count'),

            Column::make('Actions')
            ->format(function($value, $column, $row){
                return view('xup::partials.tables.access.role_actions', ['role'=>$row]);
            })
        ];
        // TODO: Implement columns() method.
    }

    public function query()
    {
        return Role::query()->withCount(['users', 'permissions']);
    }
}
