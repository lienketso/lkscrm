<x-admin::layouts>
    <x-slot:title>
        @lang('admin::app.customers.index.title')
    </x-slot>

    <!-- Header -->
    {!! view_render_event('admin.customers.index.header.before') !!}

    <div class="flex items-center justify-between rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300">
        {!! view_render_event('admin.customers.index.header.left.before') !!}
        <div class="flex flex-col gap-2">
            <div class="flex cursor-pointer items-center">
                <!-- Bredcrumbs -->
                <x-admin::breadcrumbs name="customers" />
            </div>

            <div class="text-xl font-bold dark:text-white">
                @lang('admin::app.customers.index.title')
            </div>
        </div>

        {!! view_render_event('admin.customers.index.header.left.after') !!}

        {!! view_render_event('admin.customers.index.header.right.before') !!}

        <div class="flex items-center gap-x-2.5">
            <!-- Create button for Leads -->
            <div class="flex items-center gap-x-2.5">
                @if (bouncer()->hasPermission('leads.create'))
                    <a
                        href="{{ route('admin.customers.create') }}"
                        class="primary-button"
                    >
                        @lang('admin::app.customers.index.create-btn')
                    </a>
                @endif
            </div>
        </div>

        {!! view_render_event('admin.customers.index.header.right.after') !!}
    </div>

    {!! view_render_event('admin.customers.index.header.after') !!}

    {!! view_render_event('admin.customers.index.content.before') !!}

    <!-- Content -->
    <div class="mt-3.5">
        @if ((request()->view_type ?? "kanban") == "table")
            @include('admin::customers.index.table')
        @else
            @include('admin::customers.index.kanban')
        @endif
    </div>

    {!! view_render_event('admin.customers.index.content.after') !!}
</x-admin::layouts>