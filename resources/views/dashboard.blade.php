<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Community Contributions') }}
        </h2>
    </x-slot>

    <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-between">
            <!-- Sección de los Links -->
            <div class="w-3/4 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    {{ __("Here you will see the Community Links!") }}
                    <br>
                    @foreach ($links as $link)
                    <x-community-links :link="$link"/>
                    @endforeach
                    
                    {{$links->links()}}
                </div>
            </div>

            <!-- Sección del formulario -->
            <div class="w-1/4 ml-4">
                <x-community-add-link :channels="$channels"/>
            </div>
        </div>
    </div>
</div>
</x-app-layout>