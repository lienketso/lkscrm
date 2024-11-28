<x-admin::layouts>
    <x-slot:title>
        @lang('admin::app.zalo.template_detail')
    </x-slot>

    <!-- Header -->
    {!! view_render_event('admin.zalo.template.header.before') !!}

    <div class="flex items-center justify-between rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300">
        <div class="flex flex-col gap-2">
            <div class="flex cursor-pointer items-center">
                <!-- Bredcrumbs -->
                
                <x-admin::breadcrumbs name="zalo.template.view" :entity="$template" />
            </div>

            <div class="text-xl font-bold dark:text-white">
            @lang('admin::app.zalo.template_detail')
            </div>
        </div>
    </div>

    <!-- Content detail -->
    <div class="mt-3.5 flex items-left justify-between rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300">
        <div class="flex flex-wrap">
            <h4 class="flex justify-between font-semibold dark:text-white">
                {{ $template->template_name}}
            </h4>
        </div>
    </div>
    <div class="mt-3.5 flex items-left justify-between rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300">
        <div class="px-4">ID mẫu ZNS: </div>
        <div class="">{{ $template->template_id}}</div>
    </div>
    <div class="mt-3.5 flex items-left justify-between rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300">
        <div class="px-4">ID mẫu ZNS: </div>
        <div class="">{{ $template->template_id}}</div>
    </div>
</x-admin::layouts>
