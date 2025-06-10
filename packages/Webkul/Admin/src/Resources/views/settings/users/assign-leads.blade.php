<x-admin::layouts>
    <x-slot:title>
        Chia leads cho user
    </x-slot>

    <div class="flex flex-col gap-4">
        <div class="flex items-center justify-between rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300">
            <div class="flex flex-col gap-2">
                <div class="flex cursor-pointer items-center">
                    <x-admin::breadcrumbs name="settings.users" />
                </div>

                <div class="text-xl font-bold dark:text-white">
                    Chia leads cho user: {{ $user->name }}
                </div>
            </div>
        </div>

        <div class="rounded-lg border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-gray-900">
            <div class="mb-4">
                <div class="rounded-md bg-blue-50 p-4 dark:bg-blue-900">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-blue-400 dark:text-blue-300" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-blue-800 dark:text-blue-200">
                                Số lượng leads chưa chia: {{ $unassignedLeadsCount }}
                            </h3>
                        </div>
                    </div>
                </div>
            </div>

            <form action="{{ route('admin.settings.users.process_assign_leads', $user->id) }}" method="POST">
                @csrf
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Số lượng leads cần chia
                    </label>
                    <input 
                        type="number" 
                        name="quantity" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm"
                        required
                        min="1"
                        style="border:1px solid; padding: 10px"
                    >
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="primary-button">
                        Xác nhận
                    </button>
                </div>
            </form>
        </div>
    </div>

    @pushOnce('scripts')
        <script type="module">
            app.component('v-assign-leads', {
                template: '#assign-leads-template',

                data() {
                    return {
                        isProcessing: false,
                    };
                },

                methods: {
                    submitForm() {
                        this.isProcessing = true;

                        this.$axios.post(`{{ route('admin.settings.users.process_assign_leads', $user->id) }}`, this.$refs.assignLeadsForm)
                            .then(response => {
                                this.$notify(response.data.message, 'success');
                                this.$refs.assignLeadsModal.toggle();
                            })
                            .catch(error => {
                                this.$notify(error.response.data.message, 'error');
                            })
                            .finally(() => {
                                this.isProcessing = false;
                            });
                    }
                }
            });
        </script>
    @endPushOnce
</x-admin::layouts> 