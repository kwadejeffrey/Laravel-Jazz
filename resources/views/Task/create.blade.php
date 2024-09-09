<x-layouts.main-layout>

    <div class="" x-data="taskForm()">
        <form class="max-w-sm mx-auto" @submit.prevent="submitForm">
            <div class="mb-5">
                <label for="task_name" class="block mb-2 text-sm font-medium text-green-700 dark:text-green-500">Task
                    name</label>
                <input type="text" id="task_name" name="task_name" x-model="task_name"
                    class="bg-green-50 border border-green-500 text-green-900 dark:text-green-400 placeholder-green-700 dark:placeholder-green-500 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-green-500"
                    placeholder="Bonnie Green">
                <p class="mt-2 text-sm text-green-600 dark:text-green-500"><span class="font-medium">
                        @error('task_name')
                            <p class="text-red-500 mt-1 text-xs">{{ $message }}</p>
                        @enderror
                </p>
            </div>
            <div>
                <label for="task_description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Task Description
                </label>
                <textarea id="task_description" rows="4" name="task_description" x-model="task_description"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Leave a comment..."></textarea>
                <p class="mt-2 text-sm text-green-600 dark:text-green-500"><span class="font-medium">
                        @error('task_description')
                            <p class="text-red-500 mt-1 text-xs">{{ $message }}</p>
                        @enderror
                </p>
            </div>
            <div class="">

                <label class="inline-flex items-center cursor-pointer">
                    <input type="checkbox" value="" class="sr-only peer" x-model="is_done">
                    <div
                        class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                    </div>
                    <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Completed?</span>
                </label>
            </div>
            <div class="">
                <button class="p-2 bg-blue-700 rounded-lg text-white">
                    Create Task
                </button>
            </div>
        </form>

    </div>

    <script>
        function taskForm() {
            return {
                task_name: '',
                task_description: '',
                is_done: false,

                submitForm() {
                    // Handle form submission, e.g., send data via fetch/AJAX
                    fetch('/tasks/create', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}', // For Laravel
                            },
                            body: JSON.stringify({
                                task_name: this.task_name,
                                task_description: this.task_description,
                                is_done: this.is_done
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Optionally, clear the form fields after submission
                                this.task_name = '';
                                this.task_description = '';
                                this.completed = false;
                                window.location.href = data.redirect;
                                alert('Task created successfully!');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                }
            }
        }
    </script>

</x-layouts.main-layout>
