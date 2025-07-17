<x-admin::layouts>
    <x-slot:title>
        @lang('admin::app.project.index.title'): {{$project->title}} - @lang('admin::app.phase.title'): {{$phase->title}} - @lang('admin::app.task.index.title')
    </x-slot:title>

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
        <v-filter ref="filter">

        </v-filter>


        <v-tasks ref="task">
            <!-- DataGrid Shimmer -->
            <x-admin::shimmer.datagrid/>
        </v-tasks>

    </div>

    @pushOnce('scripts')
        <script type="text/x-template" id="filter-template">
            <div class="flex flex-col gap-4">
                <div class="rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300">
                    <div class="flex items-center gap-2">
                        <div class="text-xl font-bold dark:text-white">
                            Bộ lọc
                        </div>
                    </div>
                    <x-admin::form
                            v-slot="{ meta, values, errors, handleSubmit }"
                            as="div"
                            ref="modalForm"
                    >
                        <form
                                class="flex items-center gap-2 mt-2"
                                @submit="handleSubmit($event, submitFilter)"
                                ref="filterForm"
                        >
                            <x-admin::form.control-group class="flex-1">
                                <x-admin::form.control-group.label>
                                    @lang('admin::app.task.index.datagrid.assignee')
                                </x-admin::form.control-group.label>

                                <x-admin::form.control-group.control
                                        type="select"
                                        name="assignee_id"
                                        v-model="filter.assignee_id"
                                        :label="trans('admin::app.task.index.datagrid.assignee')"
                                        value="{{request('assignee_id', '')}}"
                                >
                                    <option value="">-- Chọn người thực hiện --</option>
                                    <option
                                            v-for="user in userByProject"
                                            :key="user.id"
                                            :value="user.id"
                                    >
                                        @{{ user.name }} - @{{ user.email }}
                                    </option>
                                </x-admin::form.control-group.control>

                                <x-admin::form.control-group.error control-name="assignee_id"/>
                            </x-admin::form.control-group>

                            <x-admin::form.control-group class="flex-1">
                                <x-admin::form.control-group.label>
                                    @lang('admin::app.task.index.datagrid.status')
                                </x-admin::form.control-group.label>

                                <x-admin::form.control-group.control
                                        type="select"
                                        name="status_id"
                                        v-model="filter.status_id"
                                        value="{{request('status_id', '')}}"
                                        :label="trans('admin::app.task.index.datagrid.status')"
                                >
                                    <option value="">--Chọn trạng thái--</option>
                                    <option
                                            v-for="status in taskStatus"
                                            :key="status.id"
                                            :value="status.id"
                                    >
                                        @{{ status.title }}
                                    </option>
                                </x-admin::form.control-group.control>
                            </x-admin::form.control-group>
                            <x-admin::form.control-group class="flex-1">
                                <x-admin::form.control-group.label>
                                    @lang('admin::app.task.index.datagrid.priority')
                                </x-admin::form.control-group.label>

                                <x-admin::form.control-group.control
                                        type="select"
                                        name="priority_id"
                                        v-model="filter.priority_id"
                                        :label="trans('admin::app.task.index.datagrid.priority')"
                                        value="{{request('priority_id', '')}}"
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
                            <x-admin::form.control-group class="flex-1 mt-2">
                                <x-admin::button
                                        button-type="submit"
                                        class="primary-button justify-center"
                                        :title="trans('admin::app.task.view.filter_btn')"
                                />
                            </x-admin::form.control-group>
                        </form>
                    </x-admin::form>
                </div>
            </div>
        </script>
        <script
                type="text/x-template"
                id="tasks-template"
        >
            {!! view_render_event('admin.tasks.index.datagrid.before') !!}

            <!-- Datagrid -->
            <x-admin::datagrid-custom
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
                                class="grid items-center gap-2 border-b-10 px-4 py-4 text-gray-600 transition-all hover:bg-gray-50 dark:border-gray-800 dark:text-gray-300 dark:hover:bg-gray-950"
                                :style="`grid-template-columns: ${gridColumns}`"
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

                            <p :class="{ 'text-line-through': record.is_done == true }">@{{ record.title }}</p>

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
                            <div class="flex items-center gap-1">
                                <div
                                        class="border-3 inline-block h-6 w-6 overflow-hidden rounded-full border-gray-800 text-center align-middle"
                                        v-if="record.assignee_img"
                                >
                                    <img
                                            class="h-6 w-6"
                                            :src="record.assignee_img"
                                            alt="record.assignee_name"
                                    />
                                </div>

                                <div
                                        class="profile-info-icon"
                                        v-else-if="record.assignee_name"
                                >
                                    <x-admin::multi-avatar.index v-bind:name="record.assignee_name[0].toUpperCase()" v-bind:full_name="record.assignee_name"/>
                                </div>
                                <div v-if="record.assignee_name" class="text-sm">
                                    @{{ record.assignee_name }}
                                </div>
                            </div>
                            </p>

                            <p>
                            <div class="flex items-center gap-1">
                                <template v-for="user in record.userSupport">
                                    <div class="flex items-center gap-1.5">
                                        <div
                                                class="border-3 inline-block h-6 w-6 overflow-hidden rounded-full border-gray-800 text-center align-middle"
                                                v-if="user.image"
                                                :title="user.name"
                                        >
                                            <img
                                                    class="h-6 w-6"
                                                    :src="'/storage/' + user.image"
                                                    alt="user.name"
                                            />
                                        </div>

                                        <div
                                                class="flex"
                                                v-else-if="user.name"
                                        >
                                            <x-admin::multi-avatar v-bind:name="user.name[0].toUpperCase()" v-bind:full_name="user.name"/>
                                        </div>
                                    </div>
                                </template>
                            </div>
                            </p>


                            <p>@{{ record.start_date }}</p>
                            <p>@{{ record.end_date }}</p>
                            <p>
                                <span
                                        v-if="record.time_remaining"
                                        :class="record.time_remaining.css_class"
                                >
                                @{{ record.time_remaining.txt }}
                            </span>
                            </p>

                            <p>
                            <div class="flex items-center gap-1.5">
                                <div
                                        class="border-3 inline-block h-6 w-6 overflow-hidden rounded-full border-gray-800 text-center align-middle"
                                        v-if="record.createdBy_img"
                                >
                                    <img
                                            class="h-6 w-6"
                                            :src="record.createdBy_img"
                                            alt="record.createdBy_name"
                                    />
                                </div>

                                <div
                                        class="profile-info-icon"
                                        v-else-if="record.createdBy_name"
                                >
                                    <x-admin::multi-avatar.index v-bind:name="record.createdBy_name[0].toUpperCase()" v-bind:full_name="record.createdBy_name"/>
                                </div>
                            </div>
                            </p>

                            <!-- Actions -->
                            <div class="flex justify-end">
                                <a @click="createSubTask(record.actions.find(action => action.index === 'createSubTask'))">
                                        <span class="cursor-pointer rounded-md p-1.5 text-2xl transition-all hover:bg-gray-200 dark:hover:bg-gray-800 max-sm:place-self-center"
                                              :class="record.actions.find(action => action.index === 'createSubTask')?.icon"
                                              :title="record.actions.find(action => action.index === 'createSubTask')?.title"
                                        ></span>
                                </a>
                                <a @click="openModalComment(record.actions.find(action => action.index === 'comment'))">
                                        <span class="cursor-pointer rounded-md p-1.5 text-2xl transition-all hover:bg-gray-200 dark:hover:bg-gray-800 max-sm:place-self-center"
                                              :class="record.actions.find(action => action.index === 'comment')?.icon"
                                              :title="record.actions.find(action => action.index === 'comment')?.title"
                                        ></span>
                                </a>
                                <a @click="editModal(record.actions.find(action => action.index === 'edit'))">
                                        <span class="cursor-pointer rounded-md p-1.5 text-2xl transition-all hover:bg-gray-200 dark:hover:bg-gray-800 max-sm:place-self-center"
                                              :class="record.actions.find(action => action.index === 'edit')?.icon"
                                              :title="record.actions.find(action => action.index === 'edit')?.title"
                                        ></span>
                                </a>

                                <a @click="deleteTask(record.actions.find(action => action.index === 'delete'))">
                                        <span
                                                :class="record.actions.find(action => action.index === 'delete')?.icon"
                                                :title="record.actions.find(action => action.index === 'delete')?.title"
                                                class="cursor-pointer rounded-md p-1.5 text-2xl transition-all hover:bg-gray-200 dark:hover:bg-gray-800 max-sm:place-self-center"
                                        >
                                        </span>
                                </a>
                            </div>
                            <template v-for="record in record.sub_tasks">
                                <template v-for="col in arrCol">
                                    <table>
                                        <tr>
                                            <td v-if="col == 'mask'">
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
                                            </td>
                                            <td v-if="col == 'title'">
                                                <p class="ml-4" :class="{ 'text-line-through': record.is_done == true }">@{{ record.title }}</p>
                                            </td>
                                            {{--                                                <td v-if="col == 'step'">--}}
                                            {{--                                                    <p class="ml-4">@{{ record.step }}</p>--}}
                                            {{--                                                </td>--}}
                                            <td v-if="col == 'status'">
                                                <span
                                                        :class="record.status_css_class"
                                                >
                                                @{{ record.task_status }}
                                                </span>
                                            </td>
                                            <td v-if="col == 'priority'">
                                                <span
                                                        :class="record.priority_css_class"
                                                >
                                                @{{ record.task_priority }}
                                                </span>
                                            </td>
                                            <td v-if="col == 'assignee'">
                                                <p>
                                                <div class="flex items-center gap-1">
                                                    <div
                                                            class="border-3 inline-block h-6 w-6 overflow-hidden rounded-full border-gray-800 text-center align-middle"
                                                            v-if="record.assignee_img"
                                                    >
                                                        <img
                                                                class="h-6 w-6"
                                                                :src="record.assignee_img"
                                                                alt="record.assignee_name"
                                                        />
                                                    </div>

                                                    <div
                                                            class="profile-info-icon"
                                                            v-else-if="record.assignee_name"
                                                    >
                                                        <x-admin::multi-avatar.index v-bind:name="record.assignee_name[0].toUpperCase()"/>
                                                    </div>
                                                    <div v-if="record.assignee_name" class="text-sm">
                                                        @{{ record.assignee_name }}
                                                    </div>
                                                </div>
                                                </p>
                                            </td>
                                            <td v-if="col == 'support_id'">
                                                <div class="flex items-center gap-1">
                                                    <template v-for="user in record.userSupport">
                                                        <div class="flex items-center gap-1.5">
                                                            <div
                                                                    class="border-3 inline-block h-6 w-6 overflow-hidden rounded-full border-gray-800 text-center align-middle"
                                                                    v-if="user.image"
                                                                    :title="user?.name"
                                                            >
                                                                <img
                                                                        class="h-6 w-6"
                                                                        :src="'/storage/' +user.image"
                                                                        alt="user.name"
                                                                />
                                                            </div>

                                                            <div
                                                                    class="flex"
                                                                    v-else-if="user.name"
                                                            >
                                                                <x-admin::multi-avatar v-bind:name="user.name[0].toUpperCase()" v-bind:full_name="user.name"/>
                                                            </div>
                                                        </div>
                                                    </template>
                                                </div>
                                            </td>
                                            <td v-if="col == 'start_date'">
                                                <p>@{{ record.start_date }}</p>
                                            </td>
                                            <td v-if="col == 'end_date'">
                                                <p>@{{ record.end_date }}</p>
                                            </td>
                                            <td v-if="col == 'time_remaining'">
                                                <span
                                                        v-if="record.time_remaining"
                                                        :class="record.time_remaining.css_class"
                                                >
                                                @{{ record.time_remaining.txt }}
                                                </span>
                                            </td>
                                            <td v-if="col == 'createdBy'">
                                                <p>
                                                <div class="flex items-center gap-1.5">
                                                    <div
                                                            class="border-3 inline-block h-6 w-6 overflow-hidden rounded-full border-gray-800 text-center align-middle"
                                                            v-if="record.createdBy_img"
                                                    >
                                                        <img
                                                                class="h-6 w-6"
                                                                :src="record.createdBy_img"
                                                                alt="record?.createdBy_name"
                                                        />
                                                    </div>

                                                    <div
                                                            class="profile-info-icon"
                                                            v-else-if="record.createdBy_name"
                                                    >
                                                        <x-admin::multi-avatar.index v-bind:name="record.createdBy_name[0].toUpperCase()" v-bind:full_name="record.createdBy_name"/>
                                                    </div>
                                                </div>
                                                </p>
                                            </td>
                                            <td v-if="col == 'action'">
                                                <div class="flex justify-end">
                                                    <a @click="openModalComment(record.actions.find(action => action.index === 'comment'))">
                                                        <span class="cursor-pointer rounded-md p-1.5 text-2xl transition-all hover:bg-gray-200 dark:hover:bg-gray-800 max-sm:place-self-center"
                                                        :class="record.actions.find(action => action.index === 'comment')?.icon"
                                                        :title="record.actions.find(action => action.index === 'comment')?.title"
                                                        ></span>
                                                    </a>

                                                    <a @click="editModal(record.actions.find(action => action.index === 'edit'))">
                                                        <span class="icon-edit cursor-pointer rounded-md p-1.5 text-2xl transition-all hover:bg-gray-200 dark:hover:bg-gray-800 max-sm:place-self-center"></span>
                                                    </a>

                                                    <a @click="deleteTask(record.actions.find(action => action.index === 'delete'))">
                                                        <span
                                                                :class="record.actions.find(action => action.index === 'delete')?.icon"
                                                                class="cursor-pointer rounded-md p-1.5 text-2xl transition-all hover:bg-gray-200 dark:hover:bg-gray-800 max-sm:place-self-center"
                                                        >
                                                        </span>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </template>
                            </template>
                        </div>
                    </template>
                </template>
            </x-admin::datagrid-custom>

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

                    <x-admin::modal size="large" ref="taskUpdateAndCreateModal">
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
                                        @change="fetchUserSupport"
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

                            {!! view_render_event('admin.tasks.index.form.support_id.before') !!}
                            <x-admin::form.control-group>
                                <x-admin::form.control-group.label>
                                    @lang('admin::app.task.index.datagrid.support')
                                </x-admin::form.control-group.label>

                                <x-admin::form.control-group.control
                                        id="support_id"
                                        type="multiselect"
                                        name="support_id[]"
                                >
                                    <option
                                            v-for="user in userSupport"
                                            :key="user.id"
                                            :value="user.id"
                                            :selected="selectedUserSp.includes(user.id)"
                                    >
                                        @{{ user.name }} - @{{ user.email }}
                                    </option>
                                </x-admin::form.control-group.control>
                                <x-admin::form.control-group.error control-name="support_id[]"/>
                            </x-admin::form.control-group>

                            {!! view_render_event('admin.projects.index.form.support_id.after') !!}

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
                                        v-bind:disabled="!canUpdateParentTask"
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

            <x-admin::form
                    v-slot="{ meta, values, errors, handleSubmit }"
                    as="div"
                    ref="modalForm"
            >
                <form
                        @submit="handleSubmit($event, createdOrUpdateComment)"
                        ref="commentForm"
                >
                    {!! view_render_event('admin.tasks.index.form_controls.before') !!}

                    <x-admin::modal.comment size="large" ref="taskCommentModal">
                        <!-- Modal Header -->
                        <x-slot:header>
                            <p class="text-lg font-bold text-gray-800 dark:text-white">
                                @lang('admin::app.task.comment.title')
                            </p>
                        </x-slot:header>

                        <!-- Modal Content -->
                        <x-slot:content>
                            <template v-for="record in taskCommentList">
                                <!-- Admin Accordion -->
                                <x-admin::accordion.custom>
                                    <x-slot:header>
                                        <div class="flex items-center gap-1">
                                            <div class="flex items-center gap-1.5">
                                                <div
                                                        class="border-3 inline-block h-6 w-6 overflow-hidden rounded-full border-gray-800 text-center align-middle"
                                                        v-if="record.user_img"
                                                        :title="record?.user?.name"
                                                >
                                                    <img
                                                            class="h-6 w-6"
                                                            :src="record.user_img"
                                                            alt="record?.user?.name"
                                                    />
                                                </div>

                                                <div
                                                        class="flex"
                                                        v-else-if="record.user.name"
                                                >
                                                    <x-admin::multi-avatar v-bind:name="record.user.name[0].toUpperCase()" v-bind:full_name="record.user.name"/>
                                                </div>
                                                <div v-if="record.user.name" class="text-sm text-blue-600">
                                                    @{{ record.user.name }}
                                                </div>
                                                <div class="text-sm">
                                                    đã thêm một nhận xét - @{{ record.created_at }}
                                                </div>
                                            </div>
                                        </div>
                                    </x-slot:header>

                                    <x-slot:content>
                                        @{{record.content}}
                                        <div class="mt-1.2">
                                            <a @click="editModalComment(record.actions.find(action => action.index === 'edit'))">
                                        <span class="cursor-pointer rounded-md text-2xl transition-all hover:bg-gray-200 dark:hover:bg-gray-800 max-sm:place-self-center"
                                              :class="record.actions.find(action => action.index === 'edit')?.icon"
                                              :title="record.actions.find(action => action.index === 'edit')?.title"
                                        ></span>
                                            </a>

                                            <a @click="deleteComment(record.actions.find(action => action.index === 'delete'))">
                                        <span
                                                :class="record.actions.find(action => action.index === 'delete')?.icon"
                                                :title="record.actions.find(action => action.index === 'delete')?.title"
                                                class="cursor-pointer rounded-md text-2xl transition-all hover:bg-gray-200 dark:hover:bg-gray-800 max-sm:place-self-center"
                                        >
                                        </span>
                                            </a>
                                        </div>
                                    </x-slot:content>
                                </x-admin::accordion.custom>
                            </template>

                        </x-slot:content>

                        <!-- Modal Footer -->
                        <x-slot:footer>
                            {!! view_render_event('admin.tasks.index.modal.footer.save_button.before') !!}
                            <x-admin::form.control-group.control
                                    type="hidden"
                                    name="id"
                                    v-model="taskComment.id"
                            />
                            <x-admin::form.control-group.control
                                    type="hidden"
                                    name="task_id"
                                    v-model="taskComment.task_id"
                            />
                            <x-admin::form.control-group.control
                                    type="hidden"
                                    name="project_id"
                                    v-model="taskComment.project_id"
                            />
                            {!! view_render_event('admin.tasks.index.form.content.before') !!}
                            <!-- Description -->
                            <x-admin::form.control-group>
                                <x-admin::form.control-group.label class="required">
                                    @lang('admin::app.task.index.datagrid.comment')
                                </x-admin::form.control-group.label>

                                <x-admin::form.control-group.control
                                        type="textarea"
                                        name="content"
                                        rules="required"
                                        v-model="taskComment.content"
                                        :label="trans('admin::app.task.index.datagrid.comment')"
                                        :placeholder="trans('admin::app.task.index.datagrid.comment')"
                                />

                                <x-admin::form.control-group.error control-name="content"/>
                            </x-admin::form.control-group>
                            {!! view_render_event('admin.tasks.index.form.content.after') !!}
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
                    </x-admin::modal.comment>

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

                userSupport: @json([]),

                selectedUserSp: @json([]),

                taskCommentList: @json([]),

                taskComment: {},

                canUpdateParentTask: true,

                task: {},

                arrCol: [
                  'mask',
                  'title',
                  'status',
                  'priority',
                  'assignee',
                  'support_id',
                  'start_date',
                  'end_date',
                  'time_remaining',
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

              gridColumns(){
                let gridColumns = [];
                if (this.$refs.datagrid.available.massActions.length) {
                    gridColumns.push('minmax(0, 1fr)');
                }
                this.$refs.datagrid.available.columns.forEach((column) => {
                  gridColumns.push(column.custom_grid.length ? column.custom_grid : 'minmax(0, 1fr)');
                });
                if (this.$refs.datagrid.available.actions.length) {
                    gridColumns.push('minmax(0, 1fr)');
                }

                return gridColumns.join(' ');
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

              fetchUserSupport () {
                this.$axios.get(`{{ route('admin.tasks.getUserSupportInput') }}?project_id={{$project->id}}&assignee_id=${this.task.assignee_id}`).then(response => {
                  this.userSupport = response.data.data
                }).catch(error => {
                  this.userSupport = []
                })
              },

              fetchTaskComment (url) {
                this.$axios.get(`${url}`).then(response => {
                  this.taskCommentList = response?.data?.data
                }).catch(error => {
                  this.$emitter.emit('add-flash', { type: 'error', message: error.data.message ?? '' })
                })
              },

              openModalComment (action) {
                this.fetchTaskComment(action.url)
                this.taskComment.task_id = action.task_id
                this.taskComment.project_id = action.project_id
                this.$refs.taskCommentModal.toggle()
              },

              editModalComment (action) {
                this.$axios.get(action.url)
                  .then(response => {
                    this.taskComment = response.data.data
                  })
                  .catch(error => {
                    this.$emitter.emit('add-flash', { type: 'error', message: error.response.data.message ?? 'Có lỗi xảy ra vui lòng thử lại sau.' })
                  })

              },

              createdOrUpdateComment (params, { resetForm, setErrors }) {
                const commentForm = new FormData(this.$refs.commentForm)
                commentForm.append('_method', params.id ? 'put' : 'post')
                this.isProcessing = true
                this.$axios.post(params.id ? `{{ route('admin.tasks.updateComment', '') }}` : "{{ route('admin.tasks.storeComment') }}", commentForm).then(response => {
                  this.isProcessing = false

                  this.$emitter.emit('add-flash', { type: 'success', message: response.data.message ?? '' })
                  this.fetchTaskComment(`{{route('admin.tasks.getCommentByTaskId')}}?task_id=${this.taskComment.task_id}`)

                  this.taskComment.content = null
                  this.taskComment.id = null
                }).catch(error => {
                  this.isProcessing = false

                  if (error.response.status === 422) {
                    setErrors(error.response.data.errors)
                  } else {
                    this.$emitter.emit('add-flash', { type: 'error', message: error.response.data.message ?? '' })
                  }
                })
              },

              openModal () {
                this.task = {}

                this.fetchInputData()
                this.fetchUserSupport()
                this.canUpdateParentTask = true
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
                    this.$emitter.emit('add-flash', { type: 'error', message: error.response.data.message ?? '' })
                  }
                })
              },

              editModal (action) {
                this.$axios.get(action.url)
                  .then(response => {
                    this.task = response.data.data
                    this.canUpdateParentTask = response.data.canUpdateParentTask
                    this.fetchInputData()
                    this.fetchUserSupport()
                    this.selectedUserSp = response.data.selectedUserSp
                    this.$refs.taskUpdateAndCreateModal.toggle()
                  })
                  .catch(error => {
                    this.$emitter.emit('add-flash', { type: 'error', message: error.response.data.message ?? 'Có lỗi xảy ra vui lòng thử lại sau.' })
                  })

              },

              createSubTask (action) {
                this.$axios.get(action.url)
                  .then(response => {
                    this.task = {}
                    this.task.parent_id = response.data?.data?.id
                    this.fetchInputData()
                    this.fetchUserSupport()
                    this.$refs.taskUpdateAndCreateModal.toggle()
                  })
                  .catch(error => {
                    this.$emitter.emit('add-flash', { type: 'error', message: error.response.data.message ?? 'Có lỗi xảy ra vui lòng thử lại sau.' })
                  })
              },

              deleteTask (action) {
                this.$emitter.emit('open-confirm-modal', {
                  message: 'Tất cả dũ liệu bao gồm Task, Subtask sẽ bị xoá. Bạn có chắc chắn muốn thực hiện hành động này?',
                  agree: () => {
                    this.$axios.post(`${action.url}`, {
                      _method: `${action.method}`,
                    })
                      .then(response => {
                        this.$refs.datagrid.get()

                        this.$emitter.emit('add-flash', { type: 'success', message: response.data.message })
                      })
                      .catch(error => {
                        this.$emitter.emit('add-flash', { type: 'error', message: error.response.data.message ?? 'Có lỗi xảy ra vui lòng thử lại sau.' })
                      })
                  },
                })
              },
              deleteComment (action) {
                this.$emitter.emit('open-confirm-modal', {
                  message: 'Bạn có chắc chắn muốn thực hiện hành động này?',
                  agree: () => {
                    this.$axios.post(`${action.url}`, {
                      _method: `${action.method}`,
                    })
                      .then(response => {
                        this.fetchTaskComment(`{{route('admin.tasks.getCommentByTaskId')}}?task_id=${this.taskComment.task_id}`)

                        this.taskComment.content = null
                        this.taskComment.id = null

                        this.$emitter.emit('add-flash', { type: 'success', message: response.data.message })
                      })
                      .catch(error => {
                        this.$emitter.emit('add-flash', { type: 'error', message: error.response.data.message ?? 'Có lỗi xảy ra vui lòng thử lại sau.' })
                      })
                  },
                })
              },
            },
          })
        </script>
        <script type="module">
          app.component('v-filter', {
            template: '#filter-template',
            data () {
              return {
                taskPriority:  @json($taskPriority ?? []),

                taskStatus:  @json($taskStatus ?? []),

                userByProject: @json($userByProject ?? []),

                filter: {}
              }
            },
            methods: {
              submitFilter (params, { resetForm, setErrors }) {
                let url = `{!! route('admin.tasks.index', ['project_id' => $project->id, 'phase_id' => $phase->id]) !!}`
                Object.entries(params).forEach(([k, item]) => {
                  if (item !== undefined) {
                    url += `&${k}=${item}`
                  }
                })
                window.location.href = `${url}`
              }
            },
            computed: {}
          })
        </script>
    @endPushOnce
</x-admin::layouts>
