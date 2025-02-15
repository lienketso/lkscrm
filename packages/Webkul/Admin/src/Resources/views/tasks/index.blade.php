<x-admin::layouts>
    <x-slot:title>
        @lang('admin::app.task.index.title')
    </x-slot:title>

    <!-- Header -->
    {!! view_render_event('admin.project.index.header.before') !!}

    <div class="flex items-center justify-between rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300">
        {!! view_render_event('admin.project.index.header.left.before') !!}

        <div class="flex flex-col gap-2">
            <div class="flex cursor-pointer items-center">
                <!-- Bredcrumbs -->
                <x-admin::breadcrumbs name="campaign" />
            </div>

            <div class="text-xl font-bold dark:text-white">
                @lang('admin::app.task.index.list')
            </div>
        </div>

        {!! view_render_event('admin.project.index.header.left.after') !!}

        {!! view_render_event('admin.project.index.header.right.before') !!}

        <div class="flex items-center gap-x-2.5">
            <!-- Create button add -->
            <div class="flex items-center gap-x-2.5">
                <a
                    href="{{ route('admin.tasks.create') }}"
                    class="primary-button"
                >
                    @lang('admin::app.task.index.create-btn')
                </a>
            </div>
        </div>

        {!! view_render_event('admin.project.index.header.right.after') !!}
    </div>

    {!! view_render_event('admin.project.index.header.after') !!}

    {!! view_render_event('admin.project.index.content.before') !!}

    <!-- Content table list -->
    <div class="mt-3.5">
        <x-admin::datagrid :src="route('admin.tasks.index')">
            <!-- DataGrid Shimmer -->
            <x-admin::shimmer.datagrid />
        </x-admin::datagrid>
    </div>

    {!! view_render_event('admin.campaign.index.content.after') !!}

    @pushOnce('scripts')

    @endPushOnce
</x-admin::layouts>