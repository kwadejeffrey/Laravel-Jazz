<x-layouts.main-layout>

    <div class="relative overflow-x-auto">
        <div class="p-2 flex justify-end">
            <a href="" class="text-xl bg-blue-500 p-2 text-white rounded-lg">
                Create Task
            </a>
        </div>
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Task Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Task Description
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Completed
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                @if ($tasks->count() > 0)
                    @foreach ($tasks as $task)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $task->task_name }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $task->task_description }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $task->is_done ? 'Yes' : 'No' }}
                            </td>
                            <td class="px-6 py-4 flex gap-2">
                                {{-- route('task.edit', $task->id) --}}
                                <a href=""
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                <span>
                                    Mark as completed
                                </span>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <p class="text-3xl font-semibold">No Task Recorded</p>
                @endif
            </tbody>
        </table>
        <div class="flex justify-center items-center p-2 space-x-2">
            {{ $tasks->links() }}
        </div>
    </div>

</x-layouts.main-layout>
