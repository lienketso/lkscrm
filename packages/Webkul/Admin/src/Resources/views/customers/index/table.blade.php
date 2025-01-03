{!! view_render_event('admin.customers.index.table.before') !!}

<x-admin::datagrid :src="route('admin.customers.index')">
    <!-- DataGrid Shimmer -->
    <x-admin::shimmer.datagrid />

    <x-slot:toolbar-right-after>
        @include('admin::customers.index.view-switcher')
    </x-slot>
</x-admin::datagrid>

{!! view_render_event('admin.customers.index.table.after') !!}