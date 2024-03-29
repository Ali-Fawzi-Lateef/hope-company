<x-app-layout>
    @include('pages.'.Auth::user()->user_type.'.navbar')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-sky-900 text-center">
                    <form method="POST" action="{{route(Auth::user()->user_type.'.storage.store')}}" class="md:w-2/4 mx-auto bg-sky-100 px-6 py-8 rounded">
                        <a href="{{route(Auth::user()->user_type.'.storage.index')}}" class="text-lg text-blue-700 hover:text-blue-900">اضافة عنصر</a>
                        @csrf
                        <div class="mb-2">
                            <x-input-label for="item_name" :value="__('اسم العنصر')"/>
                            <x-text-input id="item_name" class="block mt-1 w-full" type="text" name="item_name" :value="old('item_name')" required autofocus autocomplete="item_name" />
                            <x-input-error :messages="$errors->get('item_name')" class="mt-2" />
                        </div>

                        <div class="mb-2">
                            <x-input-label for="item_price" :value="__('السعر')"/>
                            <x-text-input id="item_price" class="block mt-1 w-full" type="number" name="item_price" :value="old('item_price')" required autofocus autocomplete="item_price" />
                            <x-input-error :messages="$errors->get('item_price')" class="mt-2" />
                        </div>
                        <div class="mb-2">
                            <x-input-label for="item_in_stock" :value="__('العدد')"/>
                            <x-text-input id="item_in_stock" class="block mt-1 w-full" type="number" name="item_in_stock" :value="old('item_in_stock')" required autofocus autocomplete="item_in_stock" />
                            <x-input-error :messages="$errors->get('item_in_stock')" class="mt-2" />
                        </div>
                        <x-primary-button class="mt-6">
                            {{ __('اضافة') }}
                        </x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

