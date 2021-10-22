<div class="bg-gray-800 rounded-md w-full shadow-md bg-gray-800"
     x-data="permissionList({{$permission_scopes->toJson()}}, {{$role_permissions->toJson()}})">
    <div class="border-b px-4 py-2 border-b-2 text-white">
        Permissions
    </div>
    <div class="w-full p-4 flex">
        <div class="w-full lg:w-5/12">
            @foreach($permission_scopes as $scope => $permissions)
                <div class="class py-1 cursor-pointer px-2 my-1 min-h-12 flex flex-wrap rounded justify-between items-center"
                     :class="{
                            'bg-sky-500 shadow text-white hover:text-white': category === '{{$scope}}',
                            'hover:text-sky-500 text-white': category !== '{{$scope}}'
                            }"
                     @click="setCategory('{{$scope}}')">
                    <span>
                        {{ ucfirst($scope) }} (<span x-text="getPermissionCount('{{$scope}}')">0</span>/{{count($permissions)}} )
                    </span>

                    <button @click="toggleAllScopePermissions('{{$scope}}')"
                            class="bg-gray-100 text-black w-45 block rounded-lg p-1 px-4 h-full border text-left flex justify-start content-center active:bg-gray-200">
                        @svg('heroicon-o-check', 'w-4 h-4 mr-2 self-center')
                        Check All Permissions
                    </button>

                </div>

            @endforeach
        </div>
        <div class="w-full lg:w-7/12">
            @foreach($permission_scopes as $scope => $permissions)
                <div x-show="category === '{{$scope}}'">
                    <ul>
                        @foreach($permissions as $ability => $permission)
                            @include('web::Settings.AccessList.partials.permission-checkbox', [
                                'scope'=>$scope,
                                'ability'=> is_array($permission) ? $ability:$permission,
                                'is_granted'=>$role_permissions->contains(sprintf('%s.%s', $scope, $ability)),
                                'label'=>  \Illuminate\Support\Arr::get($permission, 'label', ''),
                                'description' =>  \Illuminate\Support\Arr::get($permission, 'description', ''),
])
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    </div>

</div>

@push('alpinejs')
    <script type="text/javascript">

        document.addEventListener('alpine:init', () => {
            Alpine.data('permissionList', (permissions_scope, selected_permissions) => ({

                category: '',
                permissions: permissions_scope,
                selected: selected_permissions,

                permissionsCount: {},

                getPermissionCount(val) {
                    return Object.keys(this.permissionsCount).includes(val) ? this.permissionsCount[val] : 0
                },

                updateCount() {
                    Object.keys(this.permissions).forEach(scope => {
                        var abilities = Object.keys(this.permissions[scope])
                        var permissions = abilities.map(x => [scope, x].join('.'))

                        this.permissionsCount[scope] = this.selected.filter(n => {
                            return permissions.indexOf(n) !== -1
                        }).length
                    })
                },

                setCategory(val) {
                    this.category = val
                },

                syncSelected() {
                    var scopes = Object.keys(this.permissions)
                    scopes.forEach(scope => {
                        var checkboxes = document.querySelectorAll('input.permission-checkbox')
                        checkboxes.forEach(box => {
                            var selected = box.checked
                            var ability = box.dataset.permission
                            var index = this.selected.indexOf(ability)
                            if (box.checked && index < 0) {
                                this.selected.push(ability)
                            } else if (!selected & index >= 0) {
                                this.selected.splice(index, 1)
                            }
                        })
                    })
                    this.updateCount()
                },

                toggleAllScopePermissions(scope) {
                    var scoped_permissions = Object.keys(this.permissions[scope]).map(x => [scope, x].join('.'))
                    var selected_permissions = scoped_permissions.filter(n => this.selected.includes(n))
                    var checkboxes = document.querySelectorAll("input[data-scope='" + scope + "']")
                    if (scoped_permissions.length === selected_permissions.length) {
                        checkboxes.forEach(box => {
                            box.checked = false
                        })
                    } else {
                        checkboxes.forEach(box => {
                            box.checked = true
                        })
                    }
                    this.syncSelected()
                },

                init() {

                    Object.keys(this.permissions).forEach(key => {
                        this.permissionsCount[key] = 0
                    })
                    this.updateCount()
                }
            }))
        })

    </script>

@endpush