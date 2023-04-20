<x-app-layout>
    @include('pages.supervisor.navbar')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-sky-900 text-center">
                @foreach($teamMembers as $user)
                    <p>{{$user->user->name}}</p>
                @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
