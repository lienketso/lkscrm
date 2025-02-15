<x-admin::layouts>
    <x-slot:title>
        @if($model->id)
            @lang('admin::app.project.edit.title')
        @else
            @lang('admin::app.project.create.title')
        @endif

    </x-slot:title>

    {!! view_render_event('admin.project.create.form.before') !!}

    <!-- Create campaign Form -->
    <x-admin::form :action="$model->id ? route('admin.projects.update', $model->id) : route('admin.projects.store')">
        @if($model->id)
            @method('PUT')
        @endif
        <div class="flex flex-col gap-4">
            <div class="flex items-center justify-between rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300">
                <div class="flex flex-col gap-2">
                    <div class="flex cursor-pointer items-center">
                        <x-admin::breadcrumbs name="campaign.create" />
                    </div>

                    <div class="text-xl font-bold dark:text-white">
                        @lang('admin::app.project.create.title')
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
                            @lang('admin::app.project.create.save-btn')
                        </button>

                        {!! view_render_event('admin.project.create.form_buttons.after') !!}
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
                            @lang('admin::app.project.index.datagrid.title')
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="text"
                            name="title"
                            rules="required"
                            :value="old('title', $model->id ? $model->title : '')"
                            :label="trans('admin::app.project.index.datagrid.title')"
                            :placeholder="trans('admin::app.project.index.datagrid.title')"
                        />

                        <x-admin::form.control-group.error control-name="title" />
                    </x-admin::form.control-group>

                    <!-- Description -->
                    <x-admin::form.control-group>
                        <x-admin::form.control-group.label>
                            @lang('admin::app.project.index.datagrid.description')
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="textarea"
                            name="description"
                            id="description"
                            :value="old('description', $model->id ? $model->description : '')"
                            :label="trans('admin::app.project.index.datagrid.description')"
                            :placeholder="trans('admin::app.project.index.datagrid.description')"
                        />

                        <x-admin::form.control-group.error control-name="description" />
                    </x-admin::form.control-group>

                    <div class="flex gap-4">
                        <x-admin::form.control-group class="flex-1">
                            <x-admin::form.control-group.label class="required">
                                @lang('admin::app.project.index.datagrid.leader')
                            </x-admin::form.control-group.label>

                            <x-admin::form.control-group.control
                                    id="leader_id"
                                    type="select"
                                    name="leader_id"
                                    rules="required"
                                    :value="old('leader_id') ?? ''"
                            >
                                <option selected>Chọn quản lý dự án</option>
                                @foreach ($leaders as $item)
                                    <option @if((old('leader_id', $model->id ? $model->leader_id : '') ?? '') == $item['id']) selected @endif value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                                @endforeach
                            </x-admin::form.control-group.control>

                            <x-admin::form.control-group.error control-name="leader_id" />
                        </x-admin::form.control-group>
                        <x-admin::form.control-group class="flex-1">
                            <x-admin::form.control-group.label class="required">
                                @lang('admin::app.project.index.datagrid.member')
                            </x-admin::form.control-group.label>

                            <x-admin::form.control-group.control
                                    id="member_id"
                                    type="multiselect"
                                    name="member_id[]"
                            >
                            </x-admin::form.control-group.control>

                            <x-admin::form.control-group.error control-name="member_id[]" />
                        </x-admin::form.control-group>
                    </div>

                    {!! view_render_event('admin.campaign.create.form_controls.after') !!}
                </div>
            </div>
        </div>
    </x-admin::form>

    {!! view_render_event('admin.campaign.create.form.after') !!}

    @pushOnce('scripts')
        <script>
            $(function() {
                generateMemberInput();
                $(`body`).on("change", `select[name='leader_id']`, function() {
                    generateMemberInput();
                });
            });

            function generateMemberInput() {
                $.ajax({
                    url: `{{ route('admin.settings.users.getMemberByLeader') }}`,
                    method: 'GET',
                    data: {
                        'leader_id': $(`select[name='leader_id']`).val()
                    },
                    success: function(response) {
                        let html = ``;
                        response.data.forEach((item) => {
                            html += `<option value="${item.id}">${item.name}</option>`
                        });
                        $(`select[name='member_id[]']`).html(html)
                    },
                    error: function(xhr, status, error) {

                    }
                });
            }
        </script>
    @endPushOnce
</x-admin::layouts>