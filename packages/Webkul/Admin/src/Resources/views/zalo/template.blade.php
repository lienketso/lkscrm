<x-admin::layouts>
    <x-slot:title>
        @lang('admin::app.zalo.template_title')
    </x-slot>

    <!-- Header -->
    {!! view_render_event('admin.zalo.template.header.before') !!}

    <div class="flex items-center justify-between rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300">
        {!! view_render_event('admin.zalo.template.header.left.before') !!}

        <div class="flex flex-col gap-2">
            <div class="flex cursor-pointer items-center">
                <!-- Bredcrumbs -->
                <x-admin::breadcrumbs name="zalo.template" />
            </div>

            <div class="text-xl font-bold dark:text-white">
                @lang('admin::app.zalo.template')
            </div>
        </div>

        {!! view_render_event('admin.zalo.template.header.left.after') !!}

        {!! view_render_event('admin.zalo.template.header.right.before') !!}

        <div class="flex items-center gap-x-2.5">
            <!-- Create button get template from zalo -->
            <div class="flex items-center gap-x-2.5">
                <a
                    href="{{ route('admin.zalo.template.sync') }}"
                    class="primary-button"
                >
                    @lang('admin::app.zalo.button.sync_template_from_zalo')
                </a>
            </div>
        </div>

        {!! view_render_event('admin.zalo.template.header.right.after') !!}
    </div>

    {!! view_render_event('admin.zalo.template.header.after') !!}

    {!! view_render_event('admin.zalo.template.content.before') !!}

    <!-- Content table list -->
    <div class="mt-3.5">
        <x-admin::datagrid :src="route('admin.zalo.template.index')">
            <!-- DataGrid Shimmer -->
            <x-admin::shimmer.datagrid />
        </x-admin::datagrid>
    </div>

    {!! view_render_event('admin.zalo.template.content.after') !!}

    @pushOnce('scripts')

    @endPushOnce
</x-admin::layouts>