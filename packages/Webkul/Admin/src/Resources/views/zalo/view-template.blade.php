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
        <div class="flex flex-col gap-2">
            <h3>Thông tin chi tiết mẫu ZNS:  {{ $template->template_name }}</h3>
            <x-admin::table>
                <x-admin::table.tbody.tr>
                    <x-admin::table.td>
                        Tên mẫu ZNS
                    </x-admin::table.td>

                    <x-admin::table.td>
                        {{ $template->template_name }}
                    </x-admin::table.td>
                </x-admin::table.tbody.tr>
                <x-admin::table.tbody.tr>
                    <x-admin::table.td>
                        ID mẫu ZNS
                    </x-admin::table.td>

                    <x-admin::table.td>
                        {{ $template->template_id }}
                    </x-admin::table.td>
                </x-admin::table.tbody.tr>
                <x-admin::table.tbody.tr>
                    <x-admin::table.td>
                        Đơn giá chuẩn
                    </x-admin::table.td>

                    <x-admin::table.td>
                        {{ $template->price }} ₫/ZNS
                    </x-admin::table.td>
                </x-admin::table.tbody.tr>
                <x-admin::table.tbody.tr>
                    <x-admin::table.td>
                        Ztime (s)
                    </x-admin::table.td>

                    <x-admin::table.td>
                        {{ $template->timeout / 1000 }}
                    </x-admin::table.td>
                </x-admin::table.tbody.tr>
                <x-admin::table.tbody.tr>
                    <x-admin::table.td>
                        Tham số
                    </x-admin::table.td>

                    <x-admin::table.td>
                        
                        <x-admin::table>
                            <x-admin::table.thead>
                                <x-admin::table.thead.tr>
                                    <x-admin::table.th>
                                        Tên tham số
                                    </x-admin::table.th>

                                    <x-admin::table.th>
                                        Loại dữ liệu
                                    </x-admin::table.th>

                                    <x-admin::table.th>
                                        Yêu cầu bát buộc
                                    </x-admin::table.th>

                                    <x-admin::table.th>
                                        Giới hạn ký tự
                                    </x-admin::table.th>
                                </x-admin::table.thead.tr>
                            </x-admin::table.thead>
                            <x-admin::table.tbody>
                                @foreach ($template->info as $item)
                                <x-admin::table.tbody.tr>
                                    <x-admin::table.td>
                                        {{ $item->name }}
                                    </x-admin::table.td>

                                    <x-admin::table.td>
                                        {{ $item->type }}
                                    </x-admin::table.td>

                                    <x-admin::table.td>
                                        {{ $item->require == 1 ? 'Có' : 'Không' }}
                                    </x-admin::table.td>

                                    <x-admin::table.td>
                                        {{ $item->max_length }}
                                    </x-admin::table.td>
                                </x-admin::table.tbody.tr>
                                @endforeach
                            </x-admin::table.tbody>
                        </x-admin::table>

                    </x-admin::table.td>
                </x-admin::table.tbody.tr>
            </x-admin::table>
        </div>
    </div>
</x-admin::layouts>
