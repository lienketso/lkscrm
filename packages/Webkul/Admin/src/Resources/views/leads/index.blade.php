<x-admin::layouts>
    <x-slot:title>
        @lang('admin::app.leads.index.title')
    </x-slot>

    <!-- Header -->
    {!! view_render_event('admin.leads.index.header.before') !!}

    <div class="flex items-center justify-between rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300">
        {!! view_render_event('admin.leads.index.header.left.before') !!}

        <div class="flex flex-col gap-2">
            <div class="flex cursor-pointer items-center">
                <!-- Bredcrumbs -->
                <x-admin::breadcrumbs name="leads" />
            </div>

            <div class="text-xl font-bold dark:text-white">
                @lang('admin::app.leads.index.title')
            </div>
        </div>

        {!! view_render_event('admin.leads.index.header.left.after') !!}

        {!! view_render_event('admin.leads.index.header.right.before') !!}

        <div class="flex items-center gap-x-2.5">
            <!-- Create button for Leads -->
            <div class="flex items-center gap-x-2.5">
                @if (bouncer()->hasPermission('leads.create'))
                    <a
                        href="{{ route('admin.leads.create') }}"
                        class="primary-button"
                    >
                        @lang('admin::app.leads.index.create-btn')
                    </a>
                    <v-import-leads
                        :import-url="'{{ route('admin.leads.import') }}'"
                        :csrf-token="'{{ csrf_token() }}'"
                    ></v-import-leads>
                @endif
            </div>
        </div>

        {!! view_render_event('admin.leads.index.header.right.after') !!}
    </div>

    {!! view_render_event('admin.leads.index.header.after') !!}

    {!! view_render_event('admin.leads.index.content.before') !!}

    <!-- Content -->
    <div class="mt-3.5">
        @if ((request()->view_type ?? "kanban") == "table")
            @include('admin::leads.index.table')
        @else
            @include('admin::leads.index.kanban')
        @endif
    </div>

    {!! view_render_event('admin.leads.index.content.after') !!}


    @pushOnce('scripts')
    <script type="text/x-template" id="v-import-leads-template">
        <div>
            <a class="importCustomer secondary-button" @click="showImportModal">Import lead (xls,xlsx)</a>

            <div v-if="isImportModalVisible" class="modal" style="position: fixed; z-index: 1; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.4);">
                <div class="modal-content" style="background-color: #fefefe; margin: 15% auto; padding: 20px; border: 1px solid #888; width: 80%;">
                    <span class="close" @click="hideImportModal" style="color: #aaa; float: right; font-size: 28px; font-weight: bold;">&times;</span>
                    <h2>Import Leads</h2>
                    <form id="import-leads-form" :action="importUrl" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="file" accept=".xls,.xlsx" required>
                        <button type="submit" class="primary-button">Upload</button>
                    </form>
                </div>
            </div>
        </div>
    </script>

    <script type="module">
        app.component('v-import-leads', {
            template: '#v-import-leads-template',

            props: {
                importUrl: {
                    type: String,
                    required: true
                },
                csrfToken: {
                    type: String,
                    required: true
                }
            },

            data() {
                return {
                    isImportModalVisible: false
                }
            },

            methods: {
                showImportModal() {
                    this.isImportModalVisible = true
                },
                hideImportModal() {
                    this.isImportModalVisible = false
                }
            }
        });
    </script>
@endPushOnce

</x-admin::layouts>

