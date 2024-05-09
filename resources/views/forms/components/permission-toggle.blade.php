<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>
    <div 
    x-data="{ state: {{$getRecord()->hasPermissionTo($PermissionName()) ? 'true' : 'false' }} }"
    >
    {{$getRecord()->hasPermissionTo($PermissionName())}}
    {{-- n x-data="{
        state: $wire.$entangle('{{$getRecord()->hasPermissionTo($PermissionName())}}',false) ,
    }"  --}}
  
  
        <label class="fi-fo-field-wrp-label inline-flex items-center gap-x-3" for="data.ss">
            <button
                    x-bind:aria-checked="state?.toString()" x-on:click="state = ! state" x-bind:class="
                        state
                            ? 'fi-color-custom bg-custom-600 fi-color-primary'
                            : 'bg-gray-200 dark:bg-gray-700 fi-color-gray'
                    " x-bind:style="
                        state
                            ? '--c-600:var(--primary-600)'
                            : '--c-600:var(--gray-600)'
                    " class="fi-fo-toggle relative inline-flex h-6 w-11 shrink-0 cursor-pointer rounded-full border-2 border-transparent outline-none transition-colors duration-200 ease-in-out disabled:pointer-events-none disabled:opacity-70 bg-gray-200 dark:bg-gray-700 fi-color-gray" aria-checked="false" id="data.ss" role="switch" type="button" wire:loading.attr="disabled" wire:target="data.ss" style="--c-600:var(--gray-600)">
                    <span class="pointer-events-none relative inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out translate-x-0" x-bind:class="{
                            'translate-x-5 rtl:-translate-x-5': state,
                            'translate-x-0': ! state,
                        }">
                        <span class="absolute inset-0 flex h-full w-full items-center justify-center transition-opacity opacity-100 ease-in duration-200" aria-hidden="true" x-bind:class="{
                                'opacity-0 ease-out duration-100': state,
                                'opacity-100 ease-in duration-200': ! state,
                            }">
                            <!--[if BLOCK]><![endif]--><!--[if ENDBLOCK]><![endif]-->
                        </span>
        
                        <span class="absolute inset-0 flex h-full w-full items-center justify-center transition-opacity opacity-0 ease-out duration-100" aria-hidden="true" x-bind:class="{
                                'opacity-100 ease-in duration-200': state,
                                'opacity-0 ease-out duration-100': ! state,
                            }">
                            <!--[if BLOCK]><![endif]--><!--[if ENDBLOCK]><![endif]-->
                        </span>
                    </span>
                </button>
        
            {{-- <span class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
                
                Ss<!--[if BLOCK]><![endif]--><!--[if ENDBLOCK]><![endif]-->
            </span> --}}
        
            
        </label>

























        <!-- Interact with the `state` property in Alpine.js -->
{{-- 
        @if ($getRecord()->hasPermissionTo($PermissionName()))

        <input type="checkbox" class="filament-forms-toggle-component" checked id="">

        @else

        <input type="checkbox"  id="">

        @endif --}}

    </div>
</x-dynamic-component>
