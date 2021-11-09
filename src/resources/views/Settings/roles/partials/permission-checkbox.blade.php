<li class="pl-4 my-2 flex">

    <label class="inline-flex items-top">

        <input @click="syncSelected"
               data-permission="{{ sprintf('%s.%s', $scope, $ability) }}"
               data-scope="{{$scope}}"
               id="permission-{{$scope}}-{{$ability}}"
               type="checkbox"
               form="role-form"
               class="mx-2 mt-2 permission-checkbox"
               name="permissions[{{ sprintf('%s.%s', $scope, $ability) }}]"
               @if($is_granted) checked="checked" @endif />

        <span class="text-white">
            <p class="font-bold">
                {{$label}}
            </p>
            <p class="text-sm">
                {{ $description }}
            </p>
        </span>

    </label>


</li>
