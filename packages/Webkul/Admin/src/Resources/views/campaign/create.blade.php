<x-admin::layouts>
    <x-slot:title>
        @lang('admin::app.campaign.create.title')
    </x-slot>

    {!! view_render_event('admin.campaign.create.form.before') !!}

    <!-- Create campaign Form -->
    <x-admin::form :action="route('admin.campaign.store')">
        <div class="flex flex-col gap-4">
            <div class="flex items-center justify-between rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300">
                <div class="flex flex-col gap-2">
                    <div class="flex cursor-pointer items-center">
                        <x-admin::breadcrumbs name="campaign.create" />
                    </div>

                    <div class="text-xl font-bold dark:text-white">
                        @lang('admin::app.campaign.create.title')
                    </div>
                </div>

                {!! view_render_event('admin.campaign.create.save_button.before') !!}

                <div class="flex items-center gap-x-2.5">
                    <!-- Save button for person -->
                    <div class="flex items-center gap-x-2.5">
                        {!! view_render_event('admin.campaign.create.form_buttons.before') !!}

                        <button
                            type="submit"
                            class="primary-button"
                        >
                            @lang('admin::app.campaign.create.save-btn')
                        </button>

                        {!! view_render_event('admin.campaign.create.form_buttons.after') !!}
                    </div>
                </div>

                {!! view_render_event('admin.campaign.create.save_button.after') !!}
            </div>
        </div>

        <!-- Form Content -->
        <div class="flex mt-3.5 gap-2.5 max-xl:flex-wrap">
            <!-- Left -->
            <div class="flex flex-1 flex-col gap-2 max-xl:flex-auto">
                <div class="box-shadow rounded-lg border border-gray-200 bg-white p-4 dark:bg-gray-900 dark:border-gray-800">
                    {!! view_render_event('admin.campaign.create.form_controls.before') !!}
                    <x-admin::form.control-group>
                        <x-admin::form.control-group.label class="required">
                            @lang('admin::app.campaign.index.datagrid.name')
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="text"
                            name="name"
                            id="name"
                            rules="required"
                            :value="old('name') ?? ''"
                            :label="trans('admin::app.campaign.index.datagrid.name')"
                            :placeholder="trans('admin::app.campaign.index.datagrid.name')"
                        />

                        <x-admin::form.control-group.error control-name="name" />
                    </x-admin::form.control-group>

                    <!-- Comment -->
                    <x-admin::form.control-group>
                        <x-admin::form.control-group.label>
                            @lang('admin::app.campaign.index.datagrid.description')
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="textarea"
                            name="description"
                            id="description"
                            :value="old('description') ?? ''"
                            :label="trans('admin::app.campaign.index.datagrid.description')"
                            :placeholder="trans('admin::app.campaign.index.datagrid.description')"
                        />
                        
                        <x-admin::form.control-group.error control-name="comment" />
                    </x-admin::form.control-group>
                    {!! view_render_event('admin.campaign.create.form_controls.after') !!}
                </div>
            </div>
            <!-- Right -->
            <div class="flex w-[360px] max-w-full flex-col gap-2 max-sm:w-full">
                
            </div>
        </div>
    </x-admin::form>

    {!! view_render_event('admin.campaign.create.form.after') !!}

    @pushOnce('scripts')
        
    @endPushOnce

    @pushOnce('styles')
        
    @endPushOnce    
</x-admin::layouts>