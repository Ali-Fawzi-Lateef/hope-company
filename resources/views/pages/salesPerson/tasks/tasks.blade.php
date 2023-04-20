<x-app-layout>
    @include('pages.salesPerson.navbar')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-sky-900 text-center">
                    <section class="justify-center text-sm md:text-lg ">
                        <table class="table-auto overflow-x-auto w-full border">
                            <thead>
                            <tr class="bg-gradient-to-br from-indigo-400 to-sky-400 text-white">
                                <th class="px-2 md:px-4 py-2">عرض التفاصيل</th>
                                <th class="px-2 md:px-4 py-2">وقت انتهاء المهمة</th>
                                <th class="px-2 md:px-4 py-2">موقغ المهمة</th>
                                <th class="px-2 md:px-4 py-2">عنوان المهمة</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tasks as $task)
                                <tr class="hover:bg-slate-200 text-indigo-900">
                                    <td class="border px-2 md:px-4 py-2">
                                        <a href="{{route('salesPerson.showMyTask',['task' => $task->id])}}" class="hover:text-xl hover:text-amber-400">عرض التفاصيل</a>
                                    </td>
                                    <td class="border px-2 md:px-4 py-2">
                                        {{$task->ends_at}}
                                    </td>
                                    <td class="border px-2 md:px-4 py-2">
                                        {{$task->location}}
                                    </td>
                                    <td class="border px-2 md:px-4 py-2">
                                        {{$task->title}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
