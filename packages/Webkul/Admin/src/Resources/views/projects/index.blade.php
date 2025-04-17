<x-admin::layouts>
    <x-slot:title>
        @lang('admin::app.project.index.title')
    </x-slot:title>

    <!-- Header -->
    {!! view_render_event('admin.project.index.header.before') !!}

    <div class="flex items-center justify-between rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300">
        {!! view_render_event('admin.project.index.header.left.before') !!}

        <div class="flex flex-col gap-2">
            <div class="flex cursor-pointer items-center">
                <!-- Bredcrumbs -->
                <x-admin::breadcrumbs name="project"/>
            </div>

            <div class="text-xl font-bold dark:text-white">
                @lang('admin::app.project.index.list')
            </div>
        </div>

        {!! view_render_event('admin.project.index.header.left.after') !!}

        {!! view_render_event('admin.project.index.header.right.before') !!}

        <div class="flex items-center gap-x-2.5">
            <!-- Create button add -->
            <div class="flex items-center gap-x-2.5">
                <button
                        type="button"
                        class="primary-button"
                        @click="$refs.project.openModal()"
                >
                    @lang('admin::app.project.index.create-btn')
                </button>
            </div>
        </div>

        {!! view_render_event('admin.project.index.header.right.after') !!}
    </div>

    {!! view_render_event('admin.project.index.header.after') !!}

    {!! view_render_event('admin.project.index.content.before') !!}

    <!-- Content table list -->
    <div class="mt-3.5">
        <v-project ref="project">
            <x-admin::shimmer.datagrid/>
        </v-project>
    </div>

    {!! view_render_event('admin.campaign.index.content.after') !!}

    @pushOnce('scripts')
        <script
                type="text/x-template"
                id="project-template"
        >
            <x-admin::datagrid
                    :src="route('admin.projects.index')"
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
                                class="grid items-center gap-2 border-b px-4 py-4 text-gray-600 transition-all hover:bg-gray-50 dark:border-gray-800 dark:text-gray-300 dark:hover:bg-gray-950"
                                :style="`grid-template-columns: ${gridColumns}`"
                        >
                            <a class="text-blue-600" :title="record.actions.find(action => action.index === 'listPhase').title" :href="record.actions.find(action => action.index === 'listPhase').url">@{{ record.title }}</a>
                            <p v-bind:title="record.description">@{{ record.description }}</p>
                            <div class="flex items-center gap-1.5">
                                <div
                                        class="border-3 inline-block h-6 w-6 overflow-hidden rounded-full border-gray-800 text-center align-middle"
                                        v-if="record.leader_image"
                                        :title="`record.leader_name`"
                                >
                                    <img
                                            class="h-6 w-6"
                                            :src="record.leader_image"
                                            alt="record.leader_name"
                                    />
                                </div>

                                <div
                                        v-else-if="record.leader_name"
                                >
                                    <x-admin::multi-avatar v-bind:name="record.leader_name[0].toUpperCase()" v-bind:full_name="record.leader_name" />
                                </div>
                                <div v-if="record.leader_name" class="text-sm">
                                    @{{ record.leader_name }}
                                </div>
                            </div>
                            <div v-html="record.status"></div>
                            <div class="flex items-center gap-1">
                                <template v-for="member in record.member">
                                    <div class="flex items-center gap-1.5">
                                        <div
                                                class="border-3 inline-block h-6 w-6 overflow-hidden rounded-full border-gray-800 text-center align-middle"
                                                v-if="member.image"
                                                :title="member.name"
                                        >
                                            <img
                                                    class="h-6 w-6"
                                                    :src="'/storage/' + member.image"
                                                    alt="member?.name"
                                            />
                                        </div>

                                        <div
                                                class="flex"
                                                v-else-if="member.name"
                                        >
                                            <x-admin::multi-avatar v-bind:name="member.name[0].toUpperCase()" v-bind:full_name="member.name" />
                                        </div>
                                    </div>
                                </template>
                            </div>
                            <p>@{{ record.start_date }}</p>
                            <p>@{{ record.end_date }}</p>
                            <div class="flex justify-end">
                                <a :title="record.actions.find(action => action.index === 'listPhase').title" :href="record.actions.find(action => action.index === 'listPhase').url">
                                    <span class="cursor-pointer rounded-md p-1.5 text-2xl transition-all hover:bg-gray-200 dark:hover:bg-gray-800 max-sm:place-self-center"
                                          :class="record.actions.find(action => action.index === 'listPhase')?.icon"></span>
                                </a>
                                <a :title="record.actions.find(action => action.index === 'edit').title" @click="editModal(record.actions.find(action => action.index === 'edit'))">
                                    <span class="cursor-pointer rounded-md p-1.5 text-2xl transition-all hover:bg-gray-200 dark:hover:bg-gray-800 max-sm:place-self-center"
                                          :class="record.actions.find(action => action.index === 'edit')?.icon"></span>
                                </a>

                                <a @click="deleteProject(record.actions.find(action => action.index === 'delete'))">
                                    <span
                                            :class="record.actions.find(action => action.index === 'delete')?.icon"
                                            class="cursor-pointer rounded-md p-1.5 text-2xl transition-all hover:bg-gray-200 dark:hover:bg-gray-800 max-sm:place-self-center"
                                    >
                                    </span>
                                </a>
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
                        ref="projectForm"
                >
                    {!! view_render_event('admin.projects.index.form_controls.before') !!}

                    <x-admin::modal ref="projectUpdateAndCreateModal" size="large">
                        <!-- Modal Header -->
                        <x-slot:header>
                            <p class="text-lg font-bold text-gray-800 dark:text-white">
                                @{{
                                selectedType == 'create'
                                ? "@lang('admin::app.project.create.title')"
                                : "@lang('admin::app.project.edit.title')"
                                }}
                            </p>
                        </x-slot:header>

                        <!-- Modal Content -->
                        <x-slot:content>
                            <x-admin::form.control-group.control
                                    type="hidden"
                                    name="id"
                                    v-model="project.id"
                            />

                            {!! view_render_event('admin.projects.index.form.title.before') !!}

                            <!-- Name -->
                            <x-admin::form.control-group>
                                <x-admin::form.control-group.label class="required">
                                    @lang('admin::app.project.columns.title')
                                </x-admin::form.control-group.label>

                                <x-admin::form.control-group.control
                                        type="text"
                                        name="title"
                                        rules="required"
                                        v-model="project.title"
                                        :label="trans('admin::app.project.columns.title')"
                                        :placeholder="trans('admin::app.project.columns.title')"
                                />

                                <x-admin::form.control-group.error control-name="title"/>
                            </x-admin::form.control-group>

                            {!! view_render_event('admin.projects.index.form.title.after') !!}

                            {!! view_render_event('admin.projects.index.form.description.before') !!}
                            <!-- Description -->
                            <x-admin::form.control-group>
                                <x-admin::form.control-group.label>
                                    @lang('admin::app.project.index.datagrid.description')
                                </x-admin::form.control-group.label>

                                <x-admin::form.control-group.control
                                        type="textarea"
                                        name="description"
                                        v-model="project.description"
                                        :label="trans('admin::app.project.index.datagrid.description')"
                                        :placeholder="trans('admin::app.project.index.datagrid.description')"
                                />

                                <x-admin::form.control-group.error control-name="description"/>
                            </x-admin::form.control-group>
                            {!! view_render_event('admin.tasks.index.form.description.after') !!}

                            {!! view_render_event('admin.tasks.index.form.leader_id.before') !!}
                            <x-admin::form.control-group>
                                <x-admin::form.control-group.label class="required">
                                    @lang('admin::app.project.index.datagrid.leader')
                                </x-admin::form.control-group.label>

                                <x-admin::form.control-group.control
                                        type="select"
                                        name="leader_id"
                                        v-model="project.leader_id"
                                        @change="fetchMember"
                                        rules="required"
                                        :label="trans('admin::app.project.index.datagrid.leader')"
                                >
                                    <option value="">-- Chọn leader --</option>
                                    <option
                                            v-for="user in leaders"
                                            :key="user.id"
                                            :value="user.id"
                                    >
                                        @{{ user.name }} - @{{ user.email }}
                                    </option>
                                </x-admin::form.control-group.control>

                                <x-admin::form.control-group.error control-name="leader_id"/>
                            </x-admin::form.control-group>
                            {!! view_render_event('admin.projects.index.form.leader_id.after') !!}

                            {!! view_render_event('admin.tasks.index.form.member_type.before') !!}
                            <x-admin::form.control-group>
                                <x-admin::form.control-group.label class="required">
                                    @lang('admin::app.project.index.datagrid.member_type')
                                </x-admin::form.control-group.label>

                                <x-admin::form.control-group.control
                                        type="select"
                                        name="member_type"
                                        v-model="project.member_type"
                                        @change="fetchTypeMember"
                                        rules="required"
                                        :label="trans('admin::app.project.index.datagrid.member_type')"
                                >
                                    <option value="">-- Chọn kiểu thành viên tham gia --</option>
                                    @foreach(\Webkul\Project\Models\Project::TYPE as $key => $type)
                                        <option value="{{$key}}">{{$type}}</option>
                                    @endforeach
                                </x-admin::form.control-group.control>

                                <x-admin::form.control-group.error control-name="member_type"/>
                            </x-admin::form.control-group>
                            {!! view_render_event('admin.projects.index.form.member_type.after') !!}

                            {!! view_render_event('admin.tasks.index.form.group_id.before') !!}
                            <x-admin::form.control-group v-if="isShowGroup">
                                <x-admin::form.control-group.label class="required">
                                    @lang('admin::app.project.index.datagrid.group')
                                </x-admin::form.control-group.label>

                                <x-admin::form.control-group.control
                                        type="select"
                                        name="group_id"
                                        v-model="project.group_id"
                                        @change="fetchMember"
                                        rules="required"
                                        :label="trans('admin::app.project.index.datagrid.group')"
                                >
                                    <option value="">-- Chọn Nhóm --</option>
                                    <option
                                            v-for="group in groups"
                                            :key="group.id"
                                            :value="group.id"
                                    >
                                        @{{ group.name }}
                                    </option>
                                </x-admin::form.control-group.control>

                                <x-admin::form.control-group.error control-name="group_id"/>
                            </x-admin::form.control-group>
                            {!! view_render_event('admin.projects.index.form.group_id.after') !!}

                            {!! view_render_event('admin.projects.index.form.member_id.before') !!}
                            <x-admin::form.control-group>
                                <x-admin::form.control-group.label>
                                    @lang('admin::app.project.index.datagrid.member')
                                </x-admin::form.control-group.label>

                                <x-admin::form.control-group.control
                                        id="member_id"
                                        type="multiselect"
                                        name="member_id[]"
                                >
                                    <option
                                            v-for="user in members"
                                            :key="user.id"
                                            :value="user.id"
                                            :selected="selectedMember.includes(user.id)"
                                    >
                                        @{{ user.name }} - @{{ user.email }}
                                    </option>
                                </x-admin::form.control-group.control>
                                <x-admin::form.control-group.error control-name="member_id[]"/>
                            </x-admin::form.control-group>

                            {!! view_render_event('admin.projects.index.form.member_id.after') !!}

                            <div class="flex gap-4">
                                {!! view_render_event('admin.projects.index.form.start_date.before') !!}
                                <!-- start_date -->
                                <x-admin::form.control-group class="flex-1">
                                    <x-admin::form.control-group.label>
                                        @lang('admin::app.project.index.datagrid.start_date')
                                    </x-admin::form.control-group.label>

                                    <x-admin::form.control-group.control
                                            type="date"
                                            name="start_date"
                                            v-model="project.start_date"
                                            :label="trans('admin::app.project.index.datagrid.start_date')"
                                            :placeholder="trans('admin::app.project.index.datagrid.start_date')"
                                    />

                                    <x-admin::form.control-group.error control-name="start_date"/>
                                </x-admin::form.control-group>
                                {!! view_render_event('admin.projects.index.form.start_date.after') !!}

                                {!! view_render_event('admin.projects.index.form.end_date.before') !!}
                                <!-- end_date -->
                                <x-admin::form.control-group class="flex-1">
                                    <x-admin::form.control-group.label>
                                        @lang('admin::app.task.columns.end_date')
                                    </x-admin::form.control-group.label>

                                    <x-admin::form.control-group.control
                                            type="date"
                                            name="end_date"
                                            v-model="project.end_date"
                                            :label="trans('admin::app.project.index.datagrid.end_date')"
                                            :placeholder="trans('admin::app.project.index.datagrid.end_date')"
                                    />

                                    <x-admin::form.control-group.error control-name="end_date"/>
                                </x-admin::form.control-group>
                                {!! view_render_event('admin.projects.index.form.end_date.after') !!}
                            </div>

                            <x-admin::form.control-group>
                                <x-admin::form.control-group.label>
                                    @lang('admin::app.project.index.datagrid.status')
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
                                            :checked="parseInt(project.status || 0)"
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
        @php
            $isAllMember = \Webkul\Project\Models\Project::ALL_MEMBER_TYPE;
            $isGroupMember = \Webkul\Project\Models\Project::GROUP_MEMBER_TYPE;
        @endphp
        <script type="module">
          app.component('v-project', {
            template: '#project-template',

            data () {
              return {
                isProcessing: false,

                leaders: @json($leaders ?? []),

                groups: @json($groups ?? []),

                phases:  @json([]),

                members:  @json([]),

                selectedMember: @json([]),

                task: {},

                project: {},

                isShowGroup: false,

                isAllMember: @json($isAllMember),

                isGroupMember: @json($isGroupMember),
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

                console.log(gridColumns.join(' '));
                return gridColumns.join(' ');
              },

              selectedType () {
                return this.project.id ? 'edit' : 'create'
              },
            },

            methods: {
              fetchMember () {
                this.$axios.get(`{{ route('admin.projects.getMemberByLeader') }}?leader_id=${this.project.leader_id ?? ''}&group_id=${this.project.group_id ?? ''}&member_type=${this.project.member_type ?? ''}`).then(response => {
                  this.members = response.data.data
                }).catch(error => {
                  this.members = []
                })
              },

              fetchTypeMember() {
                this.isShowGroup = (this.project.member_type == this.isGroupMember);
                this.project.group_id = '';
                this.fetchMember();
              },

              openModal () {
                this.members = [];
                this.project = {};
                this.isShowGroup = false;
                this.$refs.projectUpdateAndCreateModal.toggle();
              },

              updateOrCreate (params, { resetForm, setErrors }) {
                const projectForm = new FormData(this.$refs.projectForm);

                projectForm.append('_method', params.id ? 'put' : 'post');

                this.isProcessing = true;

                this.$axios.post(params.id ? `{{ route('admin.projects.update', '') }}/${params.id}` : "{{ route('admin.projects.store') }}", projectForm).then(response => {
                  this.isProcessing = false;

                  this.$refs.projectUpdateAndCreateModal.toggle();

                  this.$emitter.emit('add-flash', { type: 'success', message: response.data.message ?? '' });

                  this.$refs.datagrid.get();

                  resetForm();

                }).catch(error => {
                  this.isProcessing = false

                  if (error.response.status === 422) {
                    setErrors(error.response.data.errors)
                  } else {
                    this.$emitter.emit('add-flash', { type: 'error', message: error.response.data.message ?? 'Có lỗi xảy ra vui lòng thử lại sau.' })
                  }
                })
              },

              editModal (action) {
                this.$axios.get(action.url)
                  .then(response => {
                    this.project = response.data.data;
                    this.selectedMember = response.data.selectedMember;

                    this.$axios.get(`{{ route('admin.projects.getMemberByLeader') }}?leader_id=${this.project.leader_id ?? ''}&group_id=${this.project.group_id ?? ''}&member_type=${this.project.member_type ?? ''}`).then(response => {
                      this.members = response.data.data
                    }).catch(error => {
                      this.members = []
                    });

                    this.isShowGroup = (this.project.member_type == this.isGroupMember)

                    this.$refs.projectUpdateAndCreateModal.toggle();
                  })
                  .catch(error => {
                    this.$emitter.emit('add-flash', { type: 'error', message: error.response.data.message ?? 'Có lỗi xảy ra vui lòng thử lại sau.' })
                  });
              },

              deleteProject(action) {
                this.$emitter.emit('open-confirm-modal', {
                  message: 'Tất cả dũ liệu bao gồm Project, Phase, Task sẽ bị xoá. Bạn có chắc chắn muốn thực hiện hành động này?',
                  agree: () => {
                    this.$axios.post(`${action.url}`, {
                      _method: `${action.method}`,
                    })
                      .then(response => {
                        this.$refs.datagrid.get();

                        this.$emitter.emit('add-flash', { type: 'success', message: response.data.message });
                      })
                      .catch(error => {
                        this.$emitter.emit('add-flash', { type: 'error', message: error.response.data.message ?? 'Có lỗi xảy ra vui lòng thử lại sau.' })
                      });
                  },
                });
              },
            },
          })
        </script>
    @endPushOnce
</x-admin::layouts>