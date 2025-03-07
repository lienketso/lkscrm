<x-admin::layouts>
    <x-slot:title>
        @lang('admin::app.project.index.title'): {{$project->title}} - @lang('admin::app.phase.index.title')
    </x-slot:title>

    <!-- Header -->
    {!! view_render_event('admin.phase.index.header.before') !!}

    <div class="flex items-center justify-between rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300">
        {!! view_render_event('admin.phase.index.header.left.before') !!}

        <div class="flex flex-col gap-2">
            <div class="flex cursor-pointer items-center">
                <!-- Bredcrumbs -->
                <x-admin::breadcrumbs name="phase" :entity="['project_id' => $project->id]"/>
            </div>

            <div class="text-xl font-bold dark:text-white">
                @lang('admin::app.project.index.title'): {{$project->title}} - @lang('admin::app.phase.index.list')
            </div>
        </div>

        {!! view_render_event('admin.phase.index.header.left.after') !!}

        {!! view_render_event('admin.phase.index.header.right.before') !!}

        <div class="flex items-center gap-x-2.5">
            <!-- Create button add -->
            <div class="flex items-center gap-x-2.5">
                <button
                        type="button"
                        class="primary-button"
                        @click="$refs.phase.openModal()"
                >
                    @lang('admin::app.phase.index.create-btn')
                </button>
            </div>
        </div>

        {!! view_render_event('admin.phase.index.header.right.after') !!}
    </div>

    {!! view_render_event('admin.phase.index.header.after') !!}

    {!! view_render_event('admin.phase.index.content.before') !!}

    <!-- Content table list -->
    <div class="mt-3.5">
        <v-phase ref="phase">
            <x-admin::shimmer.datagrid/>
        </v-phase>
    </div>

    {!! view_render_event('admin.campaign.index.content.after') !!}

    @pushOnce('scripts')
        <script
                type="text/x-template"
                id="phase-template"
        >
            <x-admin::datagrid
                    :src="route('admin.phases.index', request('projectId'))"
                    ref="datagrid"
            >
                <template #body="{
                    isLoading,
                    available,
                    applied,
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
                            <p>@{{ record.title }}</p>
                            <p>@{{ record.project_name }}</p>
                            <p>@{{ record.start_date }}</p>
                            <p>@{{ record.end_date }}</p>
                            <div v-html="record.status"></div>
                            <p>@{{ record.created_at }}</p>
                            <div class="flex justify-end">
                                <a :title="record.actions.find(action => action.index === 'listTask').title" :href="record.actions.find(action => action.index === 'listTask').url">
                                    <span class="icon-note cursor-pointer rounded-md p-1.5 text-2xl transition-all hover:bg-gray-200 dark:hover:bg-gray-800 max-sm:place-self-center"></span>
                                </a>
                                <a :title="record.actions.find(action => action.index === 'edit').title" @click="editModal(record.actions.find(action => action.index === 'edit'))">
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
                        </div>
                    </template>
                </template>
            </x-admin::datagrid>

            <x-admin::form
                    v-slot="{ meta, values, errors, handleSubmit }"
                    as="div"
                    ref="modalForm"
            >
                <form
                        @submit="handleSubmit($event, updateOrCreate)"
                        ref="formData"
                >
                    {!! view_render_event('admin.phases.index.form_controls.before') !!}

                    <x-admin::modal ref="phaseUpdateAndCreateModal">
                        <!-- Modal Header -->
                        <x-slot:header>
                            <p class="text-lg font-bold text-gray-800 dark:text-white">
                                @{{
                                selectedType == 'create'
                                ? "@lang('admin::app.phase.create.title')"
                                : "@lang('admin::app.phase.edit.title')"
                                }}
                            </p>
                        </x-slot:header>

                        <!-- Modal Content -->
                        <x-slot:content>
                            <x-admin::form.control-group.control
                                    type="hidden"
                                    name="id"
                                    v-model="phase.id"
                            />
                            <x-admin::form.control-group.control
                                    type="hidden"
                                    name="project_id"
                                    v-model="project.id"
                            />

                            {!! view_render_event('admin.phases.index.form.title.before') !!}

                            <!-- Name -->
                            <x-admin::form.control-group>
                                <x-admin::form.control-group.label class="required">
                                    @lang('admin::app.phase.columns.title')
                                </x-admin::form.control-group.label>

                                <x-admin::form.control-group.control
                                        type="text"
                                        name="title"
                                        rules="required"
                                        v-model="phase.title"
                                        :label="trans('admin::app.phase.columns.title')"
                                        :placeholder="trans('admin::app.phase.columns.title')"
                                />

                                <x-admin::form.control-group.error control-name="title"/>
                            </x-admin::form.control-group>

                            {!! view_render_event('admin.phases.index.form.title.after') !!}

                            {!! view_render_event('admin.phases.index.form.description.before') !!}
                            <!-- Description -->
                            <x-admin::form.control-group>
                                <x-admin::form.control-group.label>
                                    @lang('admin::app.phase.index.datagrid.description')
                                </x-admin::form.control-group.label>

                                <x-admin::form.control-group.control
                                        type="textarea"
                                        name="description"
                                        v-model="phase.description"
                                        :label="trans('admin::app.phase.index.datagrid.description')"
                                        :placeholder="trans('admin::app.phase.index.datagrid.description')"
                                />

                                <x-admin::form.control-group.error control-name="description"/>
                            </x-admin::form.control-group>
                            {!! view_render_event('admin.tasks.index.form.description.after') !!}

                            {!! view_render_event('admin.tasks.index.form.leader_id.before') !!}
                            <x-admin::form.control-group>
                                <x-admin::form.control-group.label class="required">
                                    @lang('admin::app.phase.index.datagrid.project')
                                </x-admin::form.control-group.label>

                                <x-admin::form.control-group.control
                                        type="select"
                                        name="project_id"
                                        rules="required"
                                        :value="$project->id"
                                        disabled
                                >
                                    <option value="{{$project->id}}">
                                        {{$project->title}}
                                    </option>
                                </x-admin::form.control-group.control>

                                <x-admin::form.control-group.error control-name="project_id"/>
                            </x-admin::form.control-group>
                            {!! view_render_event('admin.phases.index.form.project_id.after') !!}

                            <div class="flex gap-4">
                                {!! view_render_event('admin.phases.index.form.start_date.before') !!}
                                <!-- start_date -->
                                <x-admin::form.control-group class="flex-1">
                                    <x-admin::form.control-group.label>
                                        @lang('admin::app.phase.index.datagrid.start_date')
                                    </x-admin::form.control-group.label>

                                    <x-admin::form.control-group.control
                                            type="date"
                                            name="start_date"
                                            v-model="phase.start_date"
                                            :label="trans('admin::app.phase.index.datagrid.start_date')"
                                            :placeholder="trans('admin::app.phase.index.datagrid.start_date')"
                                    />

                                    <x-admin::form.control-group.error control-name="start_date"/>
                                </x-admin::form.control-group>
                                {!! view_render_event('admin.phases.index.form.start_date.after') !!}

                                {!! view_render_event('admin.phases.index.form.end_date.before') !!}
                                <!-- end_date -->
                                <x-admin::form.control-group class="flex-1">
                                    <x-admin::form.control-group.label>
                                        @lang('admin::app.task.columns.end_date')
                                    </x-admin::form.control-group.label>

                                    <x-admin::form.control-group.control
                                            type="date"
                                            name="end_date"
                                            v-model="phase.end_date"
                                            :label="trans('admin::app.phase.index.datagrid.end_date')"
                                            :placeholder="trans('admin::app.phase.index.datagrid.end_date')"
                                    />

                                    <x-admin::form.control-group.error control-name="end_date"/>
                                </x-admin::form.control-group>
                                {!! view_render_event('admin.phases.index.form.end_date.after') !!}
                            </div>

                            <x-admin::form.control-group>
                                <x-admin::form.control-group.label>
                                    @lang('admin::app.phase.index.datagrid.status')
                                </x-admin::form.control-group.label>

                                <input
                                        type="hidden"
                                        name="status"
                                        :value="0"
                                />

                                <label class="relative inline-flex cursor-pointer items-center">
                                    <input
                                            type="checkbox"
                                            name="status"
                                            :value="1"
                                            id="status"
                                            class="peer sr-only"
                                            :checked="parseInt(phase.status || 0)"
                                    >

                                    <div class="peer h-5 w-9 cursor-pointer rounded-full bg-gray-200 after:absolute after:top-0.5 after:h-4 after:w-4 after:rounded-full after:border after:border-gray-300 after:bg-white after:transition-all after:content-[''] peer-checked:bg-blue-600 peer-checked:after:border-white peer-focus:outline-none peer-focus:ring-blue-300 dark:bg-gray-800 dark:after:border-white dark:after:bg-white dark:peer-checked:bg-gray-950 after:ltr:left-0.5 peer-checked:after:ltr:translate-x-full after:rtl:right-0.5 peer-checked:after:rtl:-translate-x-full"></div>
                                </label>
                            </x-admin::form.control-group>

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
            app.component('v-phase', {
                template: '#phase-template',

                data() {
                    {{--console.log(@json($project ?? []))--}}
                    return {
                        isProcessing: false,

                        leaders: @json($leaders ?? []),

                        phase:  @json([]),

                        members:  @json([]),

                        task: {},

                        project: @json($project ?? []),
                    }
                },

                computed: {
                    gridsCount() {
                        let count = this.$refs.datagrid.available.columns.length

                        if (this.$refs.datagrid.available.actions.length) {
                            ++count
                        }

                        if (this.$refs.datagrid.available.massActions.length) {
                            ++count
                        }

                        return count
                    },

                    selectedType() {
                        return this.phase.id ? 'edit' : 'create'
                    },
                },

                methods: {

                    openModal() {
                        this.phase = {}

                        this.$refs.phaseUpdateAndCreateModal.toggle()
                    },

                    updateOrCreate(params, {resetForm, setErrors}) {
                        const formData = new FormData(this.$refs.formData)

                        formData.append('_method', params.id ? 'put' : 'post')

                        this.isProcessing = true

                        this.$axios.post(params.id ? `{{ route('admin.phases.update', '') }}/${params.id}` : "{{ route('admin.phases.store') }}", formData).then(response => {
                            this.isProcessing = false

                            this.$refs.phaseUpdateAndCreateModal.toggle()

                            this.$emitter.emit('add-flash', {type: 'success', message: response.data.message ?? ''})

                            this.$refs.datagrid.get()

                            resetForm()

                        }).catch(error => {
                            this.isProcessing = false

                            if (error.response.status === 422) {
                                setErrors(error.response.data.errors)
                            } else {
                                this.$emitter.emit('add-flash', {type: 'error', message: response.data.message})
                            }
                        })
                    },

                    editModal(action) {
                        this.$axios.get(action.url)
                            .then(response => {
                                this.phase = response.data.data;

                                this.$refs.phaseUpdateAndCreateModal.toggle();
                            })
                            .catch(error => {
                            });
                    },
                },
            })
        </script>
    @endPushOnce
</x-admin::layouts>