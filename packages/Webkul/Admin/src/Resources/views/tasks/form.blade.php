<x-admin::layouts>
    <x-slot:title>
        @if($model->id)
            @lang('admin::app.task.edit.title')
        @else
            @lang('admin::app.task.create.title')
        @endif
    </x-slot:title>

    {!! view_render_event('admin.task.create.form.before') !!}

    <!-- Create campaign Form -->
    <x-admin::form :action="$model->id ? route('admin.tasks.update', $model->id) : route('admin.tasks.store')">
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
                        @lang('admin::app.task.create.title')
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
                            @lang('admin::app.task.create.save-btn')
                        </button>

                        {!! view_render_event('admin.task.create.form_buttons.after') !!}
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
                            @lang('admin::app.task.index.datagrid.title')
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="text"
                            name="title"
                            rules="required"
                            :value="old('title', $model->id ? $model->title : '')"
                            :label="trans('admin::app.task.index.datagrid.title')"
                            :placeholder="trans('admin::app.task.index.datagrid.title')"
                        />

                        <x-admin::form.control-group.error control-name="title" />
                    </x-admin::form.control-group>

                    <x-admin::form.control-group class="flex-1">
                        <x-admin::form.control-group.label>
                            @lang('admin::app.task.index.datagrid.assignee')
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                                type="select"
                                name="assignee_id"
                                rules="required"
                        >
                            <option selected>Chọn nguời thực hiện</option>
                            @foreach ($users as $item)
                                <option @if((old('assignee_id', $model->id ? $model->assignee_id : '') ?? '') == $item['id']) selected @endif value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                            @endforeach
                        </x-admin::form.control-group.control>

                        <x-admin::form.control-group.error control-name="assignee_id" />
                    </x-admin::form.control-group>

                    <!-- Description -->
                    <x-admin::form.control-group>
                        <x-admin::form.control-group.label>
                            @lang('admin::app.task.index.datagrid.description')
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="textarea"
                            name="description"
                            id="description"
                            :value="old('description', $model->id ? $model->description : '')"
                            :label="trans('admin::app.task.index.datagrid.description')"
                            :placeholder="trans('admin::app.task.index.datagrid.description')"
                        />

                        <x-admin::form.control-group.error control-name="description" />
                    </x-admin::form.control-group>

                    <div class="flex gap-4">
                        <x-admin::form.control-group class="flex-1">
                            <x-admin::form.control-group.label>
                                @lang('admin::app.task.index.datagrid.step')
                            </x-admin::form.control-group.label>

                            <x-admin::form.control-group.control
                                    type="text"
                                    name="step"
                                    :value="old('step', $model->id ? $model->step : '')"
                                    :label="trans('admin::app.task.index.datagrid.step')"
                                    :placeholder="trans('admin::app.task.index.datagrid.step')"
                            />

                            <x-admin::form.control-group.error control-name="step" />
                        </x-admin::form.control-group>

                        <x-admin::form.control-group class="flex-1">
                            <x-admin::form.control-group.label class="required">
                                @lang('admin::app.task.index.datagrid.priority')
                            </x-admin::form.control-group.label>

                            <x-admin::form.control-group.control
                                    type="select"
                                    name="priority_id"
                                    rules="required"
                            >
                                <option selected>Chọn độ ưu tiên</option>
                                @foreach ($taskPriority as $item)
                                    <option @if((old('priority_id', $model->id ? $model->priority_id : '') ?? '') == $item['id']) selected @endif value="{{ $item['id'] }}">{{ $item['title'] }}</option>
                                @endforeach
                            </x-admin::form.control-group.control>

                            <x-admin::form.control-group.error control-name="priority_id" />
                        </x-admin::form.control-group>
                    </div>

                    <div class="flex gap-4">
                        <x-admin::form.control-group class="flex-1">
                            <x-admin::form.control-group.label>
                                @lang('admin::app.task.index.datagrid.project')
                            </x-admin::form.control-group.label>

                            <x-admin::form.control-group.control
                                    type="select"
                                    name="project_id"
                                    rules="required"
                            >
                                <option selected>Chọn dự án</option>
                                @foreach ($projecs as $item)
                                    <option @if((old('project_id', $model->id ? $model->project_id : '') ?? '') == $item['id']) selected @endif value="{{ $item['id'] }}">{{ $item['title'] }}</option>
                                @endforeach
                            </x-admin::form.control-group.control>

                            <x-admin::form.control-group.error control-name="step" />
                        </x-admin::form.control-group>

                        <x-admin::form.control-group class="flex-1">
                            <x-admin::form.control-group.label>
                                @lang('admin::app.task.index.datagrid.phase')
                            </x-admin::form.control-group.label>

                            <x-admin::form.control-group.control
                                    type="select"
                                    name="phase_id"
                                    rules="required"
                            >
                                <option selected>Chọn dự án</option>
                                @foreach ($phases as $item)
                                    <option @if((old('phase_id', $model->id ? $model->phase_id : '') ?? '') == $item['id']) selected @endif value="{{ $item['id'] }}">{{ $item['title'] }}</option>
                                @endforeach
                            </x-admin::form.control-group.control>

                            <x-admin::form.control-group.error control-name="phase_id" />
                        </x-admin::form.control-group>
                    </div>

                    <div class="flex gap-4">
                        <x-admin::form.control-group class="flex-1">
                            <x-admin::form.control-group.label class="required">
                                @lang('admin::app.phase.index.datagrid.start_date')
                            </x-admin::form.control-group.label>

                            <x-admin::form.control-group.control
                                    type="date"
                                    name="start_date"
                                    :value="old('start_date', $model->id ? $model->start_date : '')"
                                    :label="trans('admin::app.phase.index.datagrid.start_date')"
                                    :placeholder="trans('admin::app.phase.index.datagrid.start_date')"
                            />

                            <x-admin::form.control-group.error control-name="start_date" />
                        </x-admin::form.control-group>

                        <x-admin::form.control-group class="flex-1">
                            <x-admin::form.control-group.label class="required">
                                @lang('admin::app.phase.index.datagrid.end_date')
                            </x-admin::form.control-group.label>

                            <x-admin::form.control-group.control
                                    type="date"
                                    name="end_date"
                                    :value="old('end_date', $model->id ? $model->end_date : '')"
                                    :label="trans('admin::app.phase.index.datagrid.end_date')"
                                    :placeholder="trans('admin::app.phase.index.datagrid.end_date')"
                            />

                            <x-admin::form.control-group.error control-name="end_date" />
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
              // generatePhaseInput();
              //   $(`body`).on("change", `select[name='project_id']`, function() {
              //     generatePhaseInput();
              //   });
            });

            function generatePhaseInput() {
                $.ajax({
                    url: `{{ route('admin.tasks.getPhaseByProjectInput') }}`,
                    method: 'GET',
                    data: {
                        'project_id': $(`select[name='project_id']`).val()
                    },
                    success: function(response) {
                        let html = ``;
                        response.data.forEach((item) => {
                            html += `<option value="${item.id}">${item.title}</option>`
                        });
                        $(`select[name='phase_id']`).html(html)
                    },
                    error: function(xhr, status, error) {

                    }
                });
            }
        </script>
    @endPushOnce
</x-admin::layouts>