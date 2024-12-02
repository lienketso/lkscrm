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
                            rules="required"
                            :value="old('description') ?? ''"
                            :label="trans('admin::app.campaign.index.datagrid.description')"
                            :placeholder="trans('admin::app.campaign.index.datagrid.description')"
                        />

                        <x-admin::form.control-group.error control-name="description" />
                    </x-admin::form.control-group>

                    <!-- Customers -->
                    <x-admin::form.control-group>
                        <x-admin::form.control-group.label>
                            @lang('admin::app.campaign.index.datagrid.customer')
                        </x-admin::form.control-group.label>

                        <!-- Participants Multilookup Vue Component -->
                        <v-multi-lookup-component>
                            <div 
                                class="relative rounded border border-gray-200 px-2 py-1 hover:border-gray-400 focus:border-gray-400 dark:border-gray-800 dark:hover:border-gray-400 dark:focus:border-gray-400" 
                                role="button"
                            >
                                <ul class="flex flex-wrap items-center gap-1">
                                    <li>
                                        <input
                                            type="text"
                                            class="w-full px-1 py-1 dark:bg-gray-900 dark:text-gray-300"
                                            placeholder="@lang('admin::app.campaign.index.datagrid.customer')"
                                        />
                                    </li>
                                </ul>

                                <span class="icon-down-arrow absolute top-1.5 text-2xl ltr:right-1.5 rtl:left-1.5"></span>
                            </div>
                        </v-multi-lookup-component>
                    </x-admin::form.control-group>

                    <!-- Schedules -->
                    <x-admin::form.control-group>
                        <x-admin::form.control-group.label>
                            @lang('admin::app.campaign.index.datagrid.schedule')
                        </x-admin::form.control-group.label>

                        <v-multi-schedule-component :data="schedules"></v-multi-schedule-component>

                    </x-admin::form.control-group>

                    {!! view_render_event('admin.campaign.create.form_controls.after') !!}
                </div>
            </div>
            <!-- Right -->
            <!-- <div class="flex w-[926px] max-w-full flex-col gap-2 max-sm:w-full">
                <div class="box-shadow rounded-lg border border-gray-200 bg-white p-4 dark:bg-gray-900 dark:border-gray-800">
                    
                </div>
            </div> -->
        </div>
    </x-admin::form>

    {!! view_render_event('admin.campaign.create.form.after') !!}

    @pushOnce('scripts')
        <script 
            type="text/x-template"
            id="v-multi-lookup-component-template"
        >
            <!-- Search Button -->
            <div class="relative">
                <div class="relative rounded border border-gray-200 px-2 py-1 hover:border-gray-400 focus:border-gray-400 dark:border-gray-800" role="button">
                    <ul class="flex flex-wrap items-center gap-1">
                        <!-- Added Customer -->
                        <li
                            class="flex items-center gap-1 rounded-md bg-slate-100 pl-2 dark:bg-slate-950 dark:text-gray-300"
                            v-for="(item, index) in addedCustomers"
                        >
                            <input
                                type="hidden"
                                :name="`customers[]`"
                                :value="item.id"
                            />

                            @{{ item.title }}

                            <span
                                class="icon-cross-large cursor-pointer p-0.5 text-xl"
                                @click="remove(item)"
                            ></span>
                        </li>

                        <!-- Search Input Box -->
                        <li>
                            <input
                                type="text"
                                class="w-full px-1 py-1 dark:bg-gray-900 dark:text-gray-300"
                                placeholder="@lang('admin::app.campaign.index.datagrid.customer')"
                                v-model.lazy="searchTerm"
                                v-debounce="500"
                            />
                        </li>
                    </ul>

                    <!-- Search and Spinner Icon -->
                    <div>
                        <template v-if="!isSearching">
                            <span
                                class="absolute top-1.5 text-2xl ltr:right-1.5 rtl:left-1.5"
                                :class="[searchTerm.length >= 2 ? 'icon-up-arrow' : 'icon-down-arrow']"
                            ></span>
                        </template>

                        <template v-else>
                            <x-admin::spinner class="absolute top-2 ltr:right-2 rtl:left-2" />
                        </template>
                    </div>
                </div>

                <!-- Search Dropdown -->
                <div
                    class="absolute z-10 w-full rounded bg-white shadow-[0px_10px_20px_0px_#0000001F] dark:bg-gray-900"
                    v-if="searchTerm.length >= 2"
                >
                    <ul class="flex flex-col gap-1 p-2">
                        <!-- Searched Customer -->
                        <h3 class="text-sm font-bold text-gray-600 dark:text-gray-400">
                            <template>
                                @lang('admin::app.campaign.index.datagrid.customer')
                            </template>
                        </h3>

                        <ul>
                            <li
                                class="rounded-sm px-5 py-2 text-sm text-gray-800 dark:text-gray-300"
                                v-if="! searchedCustomers.length && ! isSearching"
                            >
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    @lang('admin::app.campaign.no-result-found')
                                </p>
                            </li>

                            <li
                                class="cursor-pointer rounded-sm px-3 py-2 text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-950"
                                v-for="user in searchedCustomers"
                                @click="add(user)"
                            >
                                @{{ user.title }}
                            </li>
                        </ul>
                    </ul>
                </div>
            </div>
        </script>

        <script type="module">
            app.component('v-multi-lookup-component', {
                template: '#v-multi-lookup-component-template',

                data() {
                    return {
                        isSearching: false,
                        searchTerm: '',
                        addedCustomers: [],
                        searchedCustomers: [],
                        searchEnpoints:  "{{ route('admin.customers.search') }}",
                    };
                },

                watch: {
                    searchTerm(newVal, oldVal) {
                        this.search();
                    },
                },

                created() {
                    
                },

                methods: {
                    search() {
                        if (this.searchTerm.length <= 1) {
                            this.searchedCustomers = [];

                            this.isSearching = false;

                            return;
                        }

                        this.isSearching = true;

                        this.$axios.get(this.searchEnpoints, {
                                params: {
                                    search: 'title:' + this.searchTerm,
                                    searchFields: 'title:like',
                                }
                            })
                            .then ((response) => {
                                this.addedCustomers.forEach(addedCus => 
                                    response.data.data = response.data.data.filter(participant => participant.id !== addedCus.id)
                                );

                                this.searchedCustomers = response.data.data;

                                this.isSearching = false;
                            })
                            .catch (function (error) {
                                this.isSearching = false;
                            });
                    },

                    add(customer) {
                        this.addedCustomers.push(customer);

                        this.searchTerm = '';

                        this.searchedCustomers = [];
                    },

                    remove(customer) {
                        this.addedCustomers = this.addedCustomers.filter(addedCus => 
                            addedCus.id !== customer.id
                        );
                    },
                },
            });
        </script>

        <script 
            type="text/x-template"
            id="v-multi-schedule-component-template"
        >
            <!-- create schedule -->
            <div class="flex flex-col gap-4">
                <!-- Table -->
                <x-admin::table>
                    <!-- Table Head -->
                    <x-admin::table.thead>
                        <x-admin::table.th>
                            @lang('admin::app.campaign.common.number')
                        </x-admin::table.th>
                        <x-admin::table.th>
                            @lang('admin::app.campaign.common.date-time')
                        </x-admin::table.th>
                        <x-admin::table.th>
                            @lang('admin::app.campaign.common.template')
                        </x-admin::table.th>
                        <x-admin::table.th>
                            @lang('admin::app.campaign.common.params')
                        </x-admin::table.th>
                    </x-admin::table.thead>
                    <!-- Table Body -->
                    <x-admin::table.tbody>

                        <!-- schedule Item Vue Component -->
                        <v-schedule-item
                            v-for='(schedule, index) in schedules'
                            :schedule="schedule"
                            :key="index"
                            :index="index"
                            @onRemoveSchedule="removeSchedule($event)"
                        ></v-schedule-item>

                    </x-admin::table.tbody>
                </x-admin::table>

                <!-- Add New schedule Item -->
                <button
                    type="button"
                    class="flex max-w-max items-center gap-2 text-brandColor"
                    @click="addSchedule"
                >
                    <i class="icon-add text-md !text-brandColor"></i>

                    @lang('admin::app.campaign.common.add-more')
                </button>
            </div>
        </script>
        <script 
            type="text/x-template" 
            id="v-schedule-item-template"
        >
            <x-admin::table.thead.tr>
                <x-admin::table.td>
                    <x-admin::form.control-group>
                        <x-admin::form.control-group.control
                            type="text"
                            ::name="`${inputName}[number]`"
                            v-model="index"
                            disabled
                        />
                    </x-admin::form.control-group>
                </x-admin::table.td>

                <x-admin::table.td>
                    <x-admin::form.control-group>
                        <x-admin::form.control-group.control
                            type="datetime"
                            ::name="`${inputName}[date-time]`"
                            rules="required"
                        />
                    </x-admin::form.control-group>
                </x-admin::table.td>

                <x-admin::table.td>
                    <x-admin::form.control-group>
                        <x-admin::form.control-group.control
                            type="select"
                            ::name="`${inputName}[template]`"
                            v-model="schedule.product_id"
                            rules="required"
                            @on-change="changeSelect"
                        >
                            <option value="">@lang('admin::app.campaign.common.select-template')</option>
                            
                            @foreach ($znsTemplates as $zns)
                                <option value="{{ $zns->template_id }}">{{ $zns->template_name }}</option>
                            @endforeach
                        </x-admin::form.control-group.control>
                    </x-admin::form.control-group>
                </x-admin::table.td>

                <x-admin::table.td>
                    <x-admin::form.control-group>
                        <x-admin::form.control-group.control
                            type="select"
                            ::name="`${inputName}[template]`"
                            v-model="schedule.product_id"
                            rules="required"
                            @on-change="changeSelect"
                        >
                            
                        </x-admin::form.control-group.control>
                    </x-admin::form.control-group>
                </x-admin::table.td>

            </x-admin::table.thead.tr>
        </script>
        <script type="module">
            app.component('v-multi-schedule-component', {
                template: '#v-multi-schedule-component-template',

                data() {
                    return {
                        schedules: this.data ? this.data : [],
                    };
                },

                methods: {

                    removeSchedule(schedule) {
                        const index = this.schedules.indexOf(schedule);
                        this.schedules.splice(index, 1);
                    },

                    addSchedule() {
                        console.log('1')
                        this.schedules.push({
                            id: null,
                            date_time: null,
                            template_id: null,
                            params_id: null,
                        })
                        console.log('2')
                    },
                },
            });

            app.component('v-schedule-item', {
                template: '#v-schedule-item-template',

                props: ['index', 'schedule'],

                data() {
                    return {
                        schedules: [],
                    }
                },

                computed: {
                    inputName() {
                        if (this.schedules.id) {
                            return "schedules[" + this.schedules.id + "]";
                        }

                        return "schedules[schedules_" + this.index + "]";
                    },
                },

                methods: {
                    /**
                     * Add the schedule.
                     * 
                     * @param {Object} result
                     * 
                     * @return {void}
                     */
                    addSchedule(result) {
                        console.log(result)
                        this.schedule.template_id = result.id;

                        this.schedule.date_time = result.date_time;
                        
                        this.schedule.params_id = result.params_id;
                    },
                    
                    /**
                     * Remove the schedule.
                     * 
                     * @return {void}
                     */
                    removeSchedule () {
                        this.$emit('onRemoveSchedule', this.schedule)
                    },

                    changeSelect() {

                    }
                }
            });
        </script>
    @endPushOnce   
</x-admin::layouts>