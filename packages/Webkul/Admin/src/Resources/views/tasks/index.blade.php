<x-admin::layouts>
    <x-slot:title>
        @lang('admin::app.project.index.title'): {{$project->title}} - @lang('admin::app.phase.title'): {{$phase->title}} - @lang('admin::app.task.index.title')
        </x-slot>

        <div class="flex flex-col gap-4">
            <div class="flex items-center justify-between rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300">
                <div class="flex flex-col gap-2">
                    <div class="flex cursor-pointer items-center">
                        <!-- Breadcrumbs -->
                        <x-admin::breadcrumbs name="task" :entity="['project_id' => $project->id, 'phase_id' => $phase->id]"/>
                    </div>

                    <div class="text-xl font-bold dark:text-white">
                        @lang('admin::app.project.index.title'): {{$project->title}} - @lang('admin::app.phase.title'): {{$phase->title}} - @lang('admin::app.task.index.list')
                    </div>
                </div>

                <div class="flex items-center gap-x-2.5">
                    {!! view_render_event('admin.tasks.index.create_button.before') !!}

                    <!-- Create button for User -->
                    @if (bouncer()->hasPermission('settings.user.users.create'))
                        <div class="flex items-center gap-x-2.5">
                            <button
                                    type="button"
                                    class="primary-button"
                                    @click="$refs.task.openModal()"
                            >
                                @lang('admin::app.task.index.create-btn')
                            </button>
                        </div>
                    @endif

                    {!! view_render_event('admin.tasks.index.create_button.after') !!}
                </div>
            </div>

            <v-tasks ref="task">
                <!-- DataGrid Shimmer -->
                <x-admin::shimmer.datagrid/>
            </v-tasks>
        </div>

        @pushOnce('scripts')
            <script
                    type="text/x-template"
                    id="tasks-template"
            >
                {!! view_render_event('admin.tasks.index.datagrid.before') !!}

                <!-- Datagrid -->
                <x-admin::datagrid
                        :src="route('admin.tasks.index', ['project_id' => $project->id, 'phase_id' => $phase->id])"
                        ref="datagrid"
                >
                    <template #body="{
                    isLoading,
                    available,
                    applied,
                    selectAll,
                    sort,
                    performAction
                }">
                        <template v-if="isLoading">
                            <x-admin::shimmer.datagrid.table.body/>
                        </template>

                        <template v-else>
                            <div
                                    v-for="record in available.records"
                                    :key="record.id"
                                    class="grid items-center gap-2.5 border-b px-4 py-4 text-gray-600 transition-all hover:bg-gray-50 dark:border-gray-800 dark:text-gray-300 dark:hover:bg-gray-950"
                                    :style="`grid-template-columns: repeat(${gridsCount}, minmax(0, 1fr))`"
                            >
                                <!-- Mass Actions, Title and Created By -->
                                <div class="flex select-none items-center gap-16">
                                    <input
                                            type="checkbox"
                                            :name="`mass_action_select_record_${record.id}`"
                                            :id="`mass_action_select_record_${record.id}`"
                                            :value="record.id"
                                            class="peer hidden"
                                            v-model="applied.massActions.indices"
                                    >

                                    <label
                                            class="icon-checkbox-outline peer-checked:icon-checkbox-select cursor-pointer rounded-md text-2xl text-gray-600 peer-checked:text-brandColor dark:text-gray-300"
                                            :for="`mass_action_select_record_${record.id}`"
                                    ></label>
                                </div>

                                <p>@{{ record.title }}</p>

                                <span
                                        :class="record.status_css_class"
                                >
                                @{{ record.task_status }}
                            </span>

                                <span
                                        :class="record.priority_css_class"
                                >
                                @{{ record.task_priority }}
                            </span>

                                <!-- Users Name -->
                                <p>
                                <div class="flex items-center gap-2.5">
                                    <div
                                            class="border-3 mr-2 inline-block h-9 w-9 overflow-hidden rounded-full border-gray-800 text-center align-middle"
                                            v-if="record.assignee_img"
                                    >
                                        <img
                                                class="h-9 w-9"
                                                :src="record.assignee_img"
                                                alt="record.assignee_name"
                                        />
                                    </div>

                                    <div
                                            class="profile-info-icon"
                                            v-else-if="record.assignee_name"
                                    >
                                        <button class="flex h-9 w-9 cursor-pointer items-center justify-center rounded-full bg-blue-400 text-sm font-semibold leading-6 text-white transition-all hover:bg-blue-500 focus:bg-blue-500">
                                            @{{ record.assignee_name[0].toUpperCase() }}
                                        </button>
                                    </div>

                                    <div class="text-sm">
                                        @{{ record.assignee_name }}
                                    </div>
                                </div>
                                </p>


                                <p>@{{ record.start_date }}</p>
                                <p>@{{ record.end_date }}</p>

                                <p>
                                <div class="flex items-center gap-2.5">
                                    <div
                                            class="border-3 mr-2 inline-block h-9 w-9 overflow-hidden rounded-full border-gray-800 text-center align-middle"
                                            v-if="record.createdBy_img"
                                    >
                                        <img
                                                class="h-9 w-9"
                                                :src="record.createdBy_img"
                                                alt="record.createdBy_name"
                                        />
                                    </div>

                                    <div
                                            class="profile-info-icon"
                                            v-else-if="record.createdBy_name"
                                    >
                                        <button class="flex h-9 w-9 cursor-pointer items-center justify-center rounded-full bg-blue-400 text-sm font-semibold leading-6 text-white transition-all hover:bg-blue-500 focus:bg-blue-500">
                                            @{{ record.createdBy_name[0].toUpperCase() }}
                                        </button>
                                    </div>

                                    <div v-if="record.createdBy_name" class="text-sm">
                                        @{{ record.createdBy_name }}
                                    </div>
                                </div>
                                </p>

                                <!-- Actions -->
                                <div class="flex justify-end">
                                    <a @click="editModal(record.actions.find(action => action.index === 'edit'))">
                                        <span class="icon-edit cursor-pointer rounded-md p-1.5 text-2xl transition-all hover:bg-gray-200 dark:hover:bg-gray-800 max-sm:place-self-center"></span>
                                    </a>

                                    {{--                                <a @click="performAction(record.actions.find(action => action.index === 'delete'))">--}}
                                    {{--                                    <span--}}
                                    {{--                                            :class="record.actions.find(action => action.index === 'delete')?.icon"--}}
                                    {{--                                            class="cursor-pointer rounded-md p-1.5 text-2xl transition-all hover:bg-gray-200 dark:hover:bg-gray-800 max-sm:place-self-center"--}}
                                    {{--                                    >--}}
                                    {{--                                    </span>--}}
                                    {{--                                </a>--}}
                                </div>
                                <template v-for="record in record.sub_tasks">
                                    <template v-for="col in arrCol">
                                        <table>
                                            <tr>
                                                <td v-if="col == 'mask'">
                                                    <div class="flex select-none items-center gap-16 ml-4">
                                                        <input
                                                                type="checkbox"
                                                                :name="`mass_action_select_record_${record.id}`"
                                                                :id="`mass_action_select_record_${record.id}`"
                                                                :value="record.id"
                                                                class="peer hidden"
                                                                v-model="applied.massActions.indices"
                                                        >

                                                        <label
                                                                class="icon-checkbox-outline peer-checked:icon-checkbox-select cursor-pointer rounded-md text-2xl text-gray-600 peer-checked:text-brandColor dark:text-gray-300"
                                                                :for="`mass_action_select_record_${record.id}`"
                                                        ></label>
                                                    </div>
                                                </td>
                                                <td v-if="col == 'title'">
                                                    <p class="ml-4">@{{ record.title }}</p>
                                                </td>
                                                {{--                                                <td v-if="col == 'step'">--}}
                                                {{--                                                    <p class="ml-4">@{{ record.step }}</p>--}}
                                                {{--                                                </td>--}}
                                                <td v-if="col == 'status'">
                                                <span
                                                        :class="record.status_css_class"
                                                        class="ml-4"
                                                >
                                                @{{ record.task_status }}
                                                </span>
                                                </td>
                                                <td v-if="col == 'priority'">
                                                <span
                                                        :class="record.priority_css_class"
                                                        class="ml-4"
                                                >
                                                @{{ record.task_priority }}
                                                </span>
                                                </td>
                                                <td v-if="col == 'assignee'">
                                                    <p class="ml-4">
                                                    <div class="flex items-center gap-2.5">
                                                        <div
                                                                class="border-3 mr-2 inline-block h-9 w-9 overflow-hidden rounded-full border-gray-800 text-center align-middle"
                                                                v-if="record.assignee_img"
                                                        >
                                                            <img
                                                                    class="h-9 w-9"
                                                                    :src="record.assignee_img"
                                                                    alt="record.assignee_name"
                                                            />
                                                        </div>

                                                        <div
                                                                class="profile-info-icon"
                                                                v-else-if="record.assignee_name"
                                                        >
                                                            <button class="flex h-9 w-9 cursor-pointer items-center justify-center rounded-full bg-blue-400 text-sm font-semibold leading-6 text-white transition-all hover:bg-blue-500 focus:bg-blue-500">
                                                                @{{ record.assignee_name[0].toUpperCase() }}
                                                            </button>
                                                        </div>

                                                        <div v-if="record.assignee_name" class="text-sm">
                                                            @{{ record.assignee_name }}
                                                        </div>
                                                    </div>
                                                    </p>
                                                </td>
                                                <td v-if="col == 'start_date'">
                                                    <p class="ml-4">@{{ record.start_date }}</p>
                                                </td>
                                                <td v-if="col == 'end_date'">
                                                    <p class="ml-4">@{{ record.end_date }}</p>
                                                </td>
                                                <td v-if="col == 'createdBy'">
                                                    <p class="ml-4">
                                                    <div class="flex items-center gap-2.5" v-if="record.createdBy_name">
                                                        <div
                                                                class="border-3 mr-2 inline-block h-9 w-9 overflow-hidden rounded-full border-gray-800 text-center align-middle"
                                                                v-if="record.createdBy_img"
                                                        >
                                                            <img
                                                                    class="h-9 w-9"
                                                                    :src="record.createdBy_img"
                                                                    alt="record.createdBy_name"
                                                            />
                                                        </div>

                                                        <div
                                                                class="profile-info-icon"
                                                                v-else-if="record.createdBy_name"
                                                        >
                                                            <button class="flex h-9 w-9 cursor-pointer items-center justify-center rounded-full bg-blue-400 text-sm font-semibold leading-6 text-white transition-all hover:bg-blue-500 focus:bg-blue-500">
                                                                @{{ record.createdBy_name[0].toUpperCase() }}
                                                            </button>
                                                        </div>

                                                        <div v-if="record.createdBy_name" class="text-sm">
                                                            @{{ record.createdBy_name }}
                                                        </div>
                                                    </div>
                                                    </p>
                                                </td>
                                                <td v-if="col == 'action'">
                                                    <div class="flex justify-end">
                                                        <a @click="editModal(record.actions.find(action => action.index === 'edit'))">
                                                            <span class="icon-edit cursor-pointer rounded-md p-1.5 text-2xl transition-all hover:bg-gray-200 dark:hover:bg-gray-800 max-sm:place-self-center"></span>
                                                        </a>

                                                        {{--                                <a @click="performAction(record.actions.find(action => action.index === 'delete'))">--}}
                                                        {{--                                    <span--}}
                                                        {{--                                            :class="record.actions.find(action => action.index === 'delete')?.icon"--}}
                                                        {{--                                            class="cursor-pointer rounded-md p-1.5 text-2xl transition-all hover:bg-gray-200 dark:hover:bg-gray-800 max-sm:place-self-center"--}}
                                                        {{--                                    >--}}
                                                        {{--                                    </span>--}}
                                                        {{--                                </a>--}}
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </template>
                                </template>
                            </div>
                        </template>
                    </template>
                </x-admin::datagrid>

                {!! view_render_event('admin.users.index.datagrid.after') !!}

                <x-admin::form
                        v-slot="{ meta, values, errors, handleSubmit }"
                        as="div"
                        ref="modalForm"
                >
                    <form
                            @submit="handleSubmit($event, updateOrCreate)"
                            ref="tasksForm"
                    >
                        {!! view_render_event('admin.tasks.index.form_controls.before') !!}

                        <x-admin::modal ref="taskUpdateAndCreateModal">
                            <!-- Modal Header -->
                            <x-slot:header>
                                <p class="text-lg font-bold text-gray-800 dark:text-white">
                                    @{{
                                    selectedType == 'create'
                                    ? "@lang('admin::app.task.create.title')"
                                    : "@lang('admin::app.task.edit.title')"
                                    }}
                                </p>
                            </x-slot:header>

                            <!-- Modal Content -->
                            <x-slot:content>
                                <x-admin::form.control-group.control
                                        type="hidden"
                                        name="id"
                                        v-model="task.id"
                                />
                                <x-admin::form.control-group.control
                                        type="hidden"
                                        name="project_id"
                                        v-model="project.id"
                                />
                                <x-admin::form.control-group.control
                                        type="hidden"
                                        name="phase_id"
                                        v-model="phase.id"
                                />
                                {!! view_render_event('admin.tasks.index.form.title.before') !!}

                                <!-- Name -->
                                <x-admin::form.control-group>
                                    <x-admin::form.control-group.label class="required">
                                        @lang('admin::app.task.columns.title')
                                    </x-admin::form.control-group.label>

                                    <x-admin::form.control-group.control
                                            type="text"
                                            name="title"
                                            rules="required"
                                            v-model="task.title"
                                            :label="trans('admin::app.task.columns.title')"
                                            :placeholder="trans('admin::app.task.columns.title')"
                                    />

                                    <x-admin::form.control-group.error control-name="title"/>
                                </x-admin::form.control-group>

                                {!! view_render_event('admin.tasks.index.form.title.after') !!}

                                {!! view_render_event('admin.tasks.index.form.description.before') !!}
                                <!-- Description -->
                                <x-admin::form.control-group>
                                    <x-admin::form.control-group.label>
                                        @lang('admin::app.task.index.datagrid.description')
                                    </x-admin::form.control-group.label>

                                    <x-admin::form.control-group.control
                                            type="textarea"
                                            name="description"
                                            v-model="task.description"
                                            :label="trans('admin::app.task.index.datagrid.description')"
                                            :placeholder="trans('admin::app.task.index.datagrid.description')"
                                    />

                                    <x-admin::form.control-group.error control-name="description"/>
                                </x-admin::form.control-group>
                                {!! view_render_event('admin.tasks.index.form.description.after') !!}

                                <div class="flex gap-4">
                                    {!! view_render_event('admin.tasks.index.form.project.before') !!}
                                    <x-admin::form.control-group class="flex-1">
                                        <x-admin::form.control-group.label class="required">
                                            @lang('admin::app.task.index.datagrid.project')
                                        </x-admin::form.control-group.label>

                                        <x-admin::form.control-group.control
                                                type="select"
                                                name="project_id"
                                                rules="required"
                                                :value="$project->id"
                                                :label="trans('admin::app.task.index.datagrid.project')"
                                                disabled
                                        >
                                            <option value="{{$project->id}}">
                                                {{$project->title}}
                                            </option>
                                        </x-admin::form.control-group.control>

                                        <x-admin::form.control-group.error control-name="project_id"/>
                                    </x-admin::form.control-group>
                                    {!! view_render_event('admin.tasks.index.form.project_id.after') !!}

                                    {!! view_render_event('admin.tasks.index.form.phase.before') !!}
                                    <x-admin::form.control-group class="flex-1">
                                        <x-admin::form.control-group.label class="required">
                                            @lang('admin::app.task.index.datagrid.phase')
                                        </x-admin::form.control-group.label>

                                        <x-admin::form.control-group.control
                                                type="select"
                                                name="phase_id"
                                                rules="required"
                                                :value="$phase->id"
                                                :label="trans('admin::app.task.index.datagrid.phase')"
                                                disabled
                                        >
                                            <option value="{{$phase->id}}">
                                                {{$phase->title}}
                                            </option>
                                        </x-admin::form.control-group.control>

                                        <x-admin::form.control-group.error control-name="phase_id"/>
                                    </x-admin::form.control-group>
                                    {!! view_render_event('admin.tasks.index.form.phase.after') !!}
                                </div>

                                {!! view_render_event('admin.tasks.index.form.assignee_id.before') !!}
                                <x-admin::form.control-group>
                                    <x-admin::form.control-group.label>
                                        @lang('admin::app.task.index.datagrid.assignee')
                                    </x-admin::form.control-group.label>

                                    <x-admin::form.control-group.control
                                            type="select"
                                            name="assignee_id"
                                            v-model="task.assignee_id"
                                            :label="trans('admin::app.task.index.datagrid.assignee')"
                                    >
                                        <option value="">-- Chọn người thực hiện --</option>
                                        <option
                                                v-for="user in users"
                                                :key="user.id"
                                                :value="user.id"
                                        >
                                            @{{ user.name }} - @{{ user.email }}
                                        </option>
                                    </x-admin::form.control-group.control>

                                    <x-admin::form.control-group.error control-name="assignee_id"/>
                                </x-admin::form.control-group>
                                {!! view_render_event('admin.tasks.index.form.assignee_id.after') !!}

                                {!! view_render_event('admin.tasks.index.form.parent_id.before') !!}
                                <x-admin::form.control-group>
                                    <x-admin::form.control-group.label>
                                        @lang('admin::app.task.index.datagrid.parent_task_title')
                                    </x-admin::form.control-group.label>

                                    <x-admin::form.control-group.control
                                            type="select"
                                            name="parent_id"
                                            v-model="task.parent_id"
                                            :label="trans('admin::app.task.index.datagrid.parent_task')"
                                    >
                                        <option value="">-- Chọn task cha --</option>
                                        <option
                                                v-for="pTask in parentTask"
                                                :key="pTask.id"
                                                :value="pTask.id"
                                        >
                                            @{{ pTask.title }}
                                        </option>
                                    </x-admin::form.control-group.control>

                                    <x-admin::form.control-group.error control-name="parent_id"/>
                                </x-admin::form.control-group>
                                {!! view_render_event('admin.tasks.index.form.parent_id.after') !!}

                                <div class="flex gap-4">
                                    {!! view_render_event('admin.tasks.index.form.priority_id.before') !!}
                                    <x-admin::form.control-group class="flex-1">
                                        <x-admin::form.control-group.label class="required">
                                            @lang('admin::app.task.index.datagrid.priority')
                                        </x-admin::form.control-group.label>

                                        <x-admin::form.control-group.control
                                                type="select"
                                                name="priority_id"
                                                rules="required"
                                                v-model="task.priority_id"
                                                :label="trans('admin::app.task.index.datagrid.priority')"
                                        >
                                            <option value="">-- Chọn độ ưu tiên --</option>
                                            <option
                                                    v-for="priority in taskPriority"
                                                    :key="priority.id"
                                                    :value="priority.id"
                                            >
                                                @{{ priority.title }}
                                            </option>
                                        </x-admin::form.control-group.control>

                                        <x-admin::form.control-group.error control-name="priority_id"/>
                                    </x-admin::form.control-group>
                                    {!! view_render_event('admin.tasks.index.form.priority_id.after') !!}

                                    {!! view_render_event('admin.tasks.index.form.category_id.before') !!}
                                    <x-admin::form.control-group class="flex-1">
                                        <x-admin::form.control-group.label class="required">
                                            @lang('admin::app.task.index.datagrid.category')
                                        </x-admin::form.control-group.label>

                                        <x-admin::form.control-group.control
                                                type="select"
                                                name="category_id"
                                                rules="required"
                                                v-model="task.category_id"
                                                :label="trans('admin::app.task.index.datagrid.category')"
                                        >
                                            <option value="">-- Chọn hạng mục --</option>
                                            <option
                                                    v-for="category in taskCategory"
                                                    :key="category.id"
                                                    :value="category.id"
                                            >
                                                @{{ category.title }}
                                            </option>
                                        </x-admin::form.control-group.control>

                                        <x-admin::form.control-group.error control-name="category_id"/>
                                    </x-admin::form.control-group>
                                    {!! view_render_event('admin.tasks.index.form.category_id.after') !!}
                                </div>

                                <div class="flex gap-4">
                                    {!! view_render_event('admin.tasks.index.form.start_date.before') !!}
                                    <!-- start_date -->
                                    <x-admin::form.control-group class="flex-1">
                                        <x-admin::form.control-group.label>
                                            @lang('admin::app.task.columns.start_date')
                                        </x-admin::form.control-group.label>

                                        <x-admin::form.control-group.control
                                                type="date"
                                                name="start_date"
                                                v-model="task.start_date"
                                                :label="trans('admin::app.task.columns.start_date')"
                                                :placeholder="trans('admin::app.task.columns.start_date')"
                                        />

                                        <x-admin::form.control-group.error control-name="start_date"/>
                                    </x-admin::form.control-group>
                                    {!! view_render_event('admin.tasks.index.form.start_date.after') !!}

                                    {!! view_render_event('admin.tasks.index.form.start_date.before') !!}
                                    <!-- end_date -->
                                    <x-admin::form.control-group class="flex-1">
                                        <x-admin::form.control-group.label>
                                            @lang('admin::app.task.columns.end_date')
                                        </x-admin::form.control-group.label>

                                        <x-admin::form.control-group.control
                                                type="date"
                                                name="end_date"
                                                v-model="task.end_date"
                                                :label="trans('admin::app.task.columns.end_date')"
                                                :placeholder="trans('admin::app.task.columns.end_date')"
                                        />

                                        <x-admin::form.control-group.error control-name="end_date"/>
                                    </x-admin::form.control-group>
                                    {!! view_render_event('admin.tasks.index.form.end_date.after') !!}
                                </div>

                                {!! view_render_event('admin.tasks.index.form.status_id.before') !!}
                                <x-admin::form.control-group v-if="task.id">
                                    <x-admin::form.control-group.label class="required">
                                        @lang('admin::app.task.index.datagrid.status')
                                    </x-admin::form.control-group.label>

                                    <x-admin::form.control-group.control
                                            type="select"
                                            name="status_id"
                                            rules="required"
                                            v-model="task.status_id"
                                            :label="trans('admin::app.task.index.datagrid.status')"
                                    >
                                        <option
                                                v-for="status in taskStatus"
                                                :key="status.id"
                                                :value="status.id"
                                        >
                                            @{{ status.title }}
                                        </option>
                                    </x-admin::form.control-group.control>

                                    <x-admin::form.control-group.error control-name="status_id"/>
                                </x-admin::form.control-group>
                                {!! view_render_event('admin.tasks.index.form.status_id.after') !!}

                            </x-slot:content>

                            <!-- Modal Footer -->
                            <x-slot:footer>
                                {!! view_render_event('admin.tasks.index.modal.footer.save_button.before') !!}

                                <!-- Save Button -->
                                <x-admin::button
                                        button-type="submit"
                                        class="primary-button justify-center"
                                        :title="trans('admin::app.task.create.save-btn')"
                                        ::loading="isProcessing"
                                        ::disabled="isProcessing"
                                />

                                {!! view_render_event('admin.tasks.index.modal.footer.save_button.after') !!}
                            </x-slot:footer>
                        </x-admin::modal>

                        {!! view_render_event('v-model="tas.index.form_controls.after') !!}
                    </form>
                </x-admin::form>
            </script>

            <script type="module">
              app.component('v-tasks', {
                template: '#tasks-template',

                data () {
                  return {
                    isProcessing: false,

                    users: @json([]),

                    taskPriority:  @json($taskPriority ?? []),

                    taskStatus:  @json($taskStatus ?? []),

                    taskCategory:  @json($taskCategory ?? []),

                    project: @json($project ?? []),

                    phase:  @json($phase ?? []),

                    task: {},

                    arrCol: [
                      'mask',
                      'title',
                      'status',
                      'priority',
                      'assignee',
                      'start_date',
                      'end_date',
                      'createdBy',
                      'action'
                    ],

                    parentTask: @json([]),
                  }
                },

                computed: {
                  gridsCount () {
                    let count = this.$refs.datagrid.available.columns.length

                    if (this.$refs.datagrid.available.actions.length) {
                      ++count
                    }

                    if (this.$refs.datagrid.available.massActions.length) {
                      ++count
                    }

                    return count
                  },

                  selectedType () {
                    return this.task.id ? 'edit' : 'create'
                  },
                },

                methods: {
                  fetchInputData () {
                    // fetch assign input
                    this.$axios.get(`{{ route('admin.tasks.getAssignByProjectInput') }}?project_id={{$project->id}}`).then(response => {
                      this.users = response.data.data
                    }).catch(error => {
                      this.users = []
                    })

                    // fetch parent task input
                    this.$axios.get(`{{ route('admin.tasks.getParentTaskByProjectInput') }}?project_id={{$project->id}}&phase_id={{$phase->id}}`).then(response => {
                      this.parentTask = response.data.data
                    }).catch(error => {
                      this.parentTask = []
                    })
                  },

                  openModal () {
                    this.task = {}

                    this.fetchInputData()

                    this.$refs.taskUpdateAndCreateModal.toggle()
                  },

                  updateOrCreate (params, { resetForm, setErrors }) {
                    const tasksForm = new FormData(this.$refs.tasksForm)

                    tasksForm.append('_method', params.id ? 'put' : 'post')

                    this.isProcessing = true

                    this.$axios.post(params.id ? `{{ route('admin.tasks.update', '') }}/${params.id}` : "{{ route('admin.tasks.store') }}", tasksForm).then(response => {
                      this.isProcessing = false

                      this.$refs.taskUpdateAndCreateModal.toggle()

                      this.$emitter.emit('add-flash', { type: 'success', message: response.data.message ?? '' })

                      this.$refs.datagrid.get()

                      resetForm()
                    }).catch(error => {
                      this.isProcessing = false

                      if (error.response.status === 422) {
                        setErrors(error.response.data.errors)
                      } else {
                        this.$emitter.emit('add-flash', { type: 'error', message: response.data.message ?? '' })
                      }
                    })
                  },

                  editModal (action) {
                    this.$axios.get(action.url)
                      .then(response => {
                        this.task = response.data.data
                        this.fetchInputData()
                        this.$refs.taskUpdateAndCreateModal.toggle()
                      })
                      .catch(error => {
                      })

                  },
                },
              })
            </script>
    @endPushOnce
</x-admin::layouts>
