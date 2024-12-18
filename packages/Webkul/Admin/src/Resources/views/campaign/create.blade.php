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

                    <!-- Schedules -->
                    <x-admin::form.control-group>
                        <x-admin::form.control-group.label>
                            @lang('admin::app.campaign.index.datagrid.schedule')
                        </x-admin::form.control-group.label>

                        <v-multi-schedule-component></v-multi-schedule-component>

                    </x-admin::form.control-group>

                    <!-- Customers -->
                    <x-admin::form.control-group>
                        <x-admin::form.control-group.label>
                            @lang('admin::app.campaign.index.datagrid.customer')
                        </x-admin::form.control-group.label>

                        <!-- Participants Multilookup Vue Component -->
                        <v-multi-select-customer-component> </v-multi-select-customer-component>
                    </x-admin::form.control-group>

                    {!! view_render_event('admin.campaign.create.form_controls.after') !!}
                </div>
            </div>
        </div>
    </x-admin::form>

    {!! view_render_event('admin.campaign.create.form.after') !!}

    @pushOnce('scripts')
        <script 
            type="text/x-template"
            id="v-multi-select-customer-component-template"
        >
            <!-- Search Button -->
            <div class="relative">
                <div class="form-search-customer flex items-center">
                    <div class="flex gap-x-1 px-4 py-[9px]">
                        <x-admin::form.control-group.control
                            type="text"
                            name="s-name"
                            id="s-name"
                            v-model="filters.name"
                            label="Tìm theo tên"
                            placeholder="Tìm theo tên"
                        />
                    </div>
                    <div class="flex gap-x-1 px-4 py-[9px]">
                        <x-admin::form.control-group.control
                            type="text"
                            name="s-phone"
                            id="s-phone"
                            v-model="filters.phone"
                            label="Tìm theo số điện thoại"
                            placeholder="Tìm theo số điện thoại"
                        />
                    </div>
                    <div class="flex gap-x-1 px-4 py-[9px]">
                        <x-admin::form.control-group.control
                            type="select"
                            name="s-type"
                            v-model="filters.type"
                        >
                            <option value="">Chọn chi nhánh</option>
                            @foreach ($leadTypes as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </x-admin::form.control-group.control>
                    </div>
                    <div class="flex gap-x-1 px-4 py-[9px]">
                        <x-admin::form.control-group.control
                            type="select"
                            name="s-tag"
                            v-model="filters.tag"
                        >
                            <option value="">Chọn tag</option>
                            @foreach ($leadTags as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </x-admin::form.control-group.control>
                    </div>
                    <div class="flex gap-x-1 px-4 py-[9px]">
                        <x-admin::form.control-group.control
                            type="select"
                            name="s-source"
                            v-model="filters.source"
                        >
                            <option value="">Chọn nguồn</option>
                            @foreach ($leadsources as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </x-admin::form.control-group.control>
                    </div>
                    <div class="flex gap-x-1 px-4 py-[9px]">
                        <button
                            type="button"
                            class="primary-button"
                            @click="search"
                        >
                            Tìm kiếm
                        </button>
                    </div>
                </div>
                <div class="form-result-customer flex items-center">
                    <div v-for="(pCustomer, j) in pCustomers">
                        <div class="flex gap-x-1 px-4 py-[9px] cursor-pointer items-center gap-2.5">
                            <x-admin::form.control-group.control
                                type="checkbox"
                                name="customers[]"
                                ::id="pCustomer.id"
                                ::for="pCustomer.id"
                                ::value="pCustomer.id"
                            />

                            <label class="cursor-pointer !text-gray-600 dark:!text-gray-300" ::for="pCustomer.id">
                                @{{ pCustomer.title }}
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </script>

        <script type="module">
            app.component('v-multi-select-customer-component', {
                template: '#v-multi-select-customer-component-template',

                data() {
                    return {
                        searchEnpoints:  "{{ route('admin.customers.search_campaign') }}",
                        filters: {
                            name: '',
                            phone: '',
                            type: '',
                            tag: '',
                            source: '',
                        },
                        pCustomers: [],
                        customers: [],
                    };
                },

                methods: {
                    search() {

                        this.$axios.get(this.searchEnpoints, {
                                params: {
                                    name: this.filters.name,
                                    phone: this.filters.phone,
                                    type: this.filters.type,
                                    tag: this.filters.tag,
                                    source: this.filters.source,
                                }
                            })
                            .then ((response) => {
                                this.pCustomers = response.data;
                            })
                            .catch (function (error) {

                            });
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
                        <x-admin::table.th class="w-[280px] border">
                            @lang('admin::app.campaign.common.date-time')
                        </x-admin::table.th>
                        <x-admin::table.th class="w-[280px] border">
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
                            :key='index'
                            :schedule="schedule"
                            :index='index'
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
            <x-admin::table.thead.tr class="border">

                <x-admin::table.td class="border">
                    <x-admin::form.control-group>
                        <x-admin::form.control-group.control
                            type="datetime"
                            ::name="`${inputName}[date_time]`"
                            v-model="schedule.date_time"
                            rules="required"
                        />
                    </x-admin::form.control-group>
                </x-admin::table.td>

                <x-admin::table.td class="border">
                    <x-admin::form.control-group>
                        <x-admin::form.control-group.control
                            type="select"
                            ::name="`${inputName}[template_id]`"
                            v-model="schedule.template_id"
                            rules="required"
                            @change="changeSelect"
                        >
                            <option value="">@lang('admin::app.campaign.common.select-template')</option>
                            
                            @foreach ($znsTemplates as $zns)
                                <option value="{{ $zns->template_id }}">{{ $zns->template_name }}</option>
                            @endforeach
                        </x-admin::form.control-group.control>
                    </x-admin::form.control-group>
                </x-admin::table.td>

                <x-admin::table.td class="border">
                    <x-admin::form.control-group>
                        
                        <x-admin::table>
                            <x-admin::table.thead.tr v-for="param in paramsInfo" class="border">
                                <x-admin::table.td class="!w-56 border">
                                @{{ param.name }}
                                </x-admin::table.td>
                                <x-admin::table.td class="border">
                                    <x-admin::form.control-group>
                                        <x-admin::form.control-group.control
                                            type="text"
                                            ::name="`${inputName}[params][${param.name}_${param.id}]`"
                                            class="border"
                                        />
                                    </x-admin::form.control-group>
                                </x-admin::table.td>
                            </x-admin::table.thead.tr>
                        </x-admin::table>
                        
                    </x-admin::form.control-group>
                </x-admin::table.td>

            </x-admin::table.thead.tr>
        </script>
        <script type="module">
            app.component('v-multi-schedule-component', {
                template: '#v-multi-schedule-component-template',

                data() {
                    return {
                        schedules: [], // ở đây nếu là edit thì đẩy từ trong php ra đây luôn dạng @ json ( $ campaign -> schedules )
                    };
                },

                created() {
                    // console.log(this.schedules)
                },

                methods: {

                    removeSchedule(schedule) {
                        const index = this.schedules.indexOf(schedule);
                        this.schedules.splice(index, 1);
                    },

                    addSchedule() {
                        this.schedules.push({
                            id: null,
                            date_time: null,
                            template_id: null,
                            params: [],
                        });
                    },
                },
            });

            app.component('v-schedule-item', {
                template: '#v-schedule-item-template',

                props: ['index', 'schedule'],

                data() {
                    return {
                        paramsInfo: [],
                        znsTemplates: @json($znsTemplates),
                    }
                },

                computed: {
                    inputName() {
                        if (this.schedule.id) {
                            return "schedules[" + this.schedule.id + "]";
                        }

                        return "schedules[schedule_" + this.index + "]";
                    },
                },
                
                created() {
                    // console.log(this.znsTemplates)
                    // console.log(this.schedule)
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
                        this.schedule.template_id = result.template_id;
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
                        this.paramsInfo = [];
                        let tem = this.znsTemplates.filter(item => 
                            item.template_id == this.schedule.template_id
                        );

                        if (tem && tem[0]) {
                            this.paramsInfo = tem[0].info
                        }
                    }
                }
            });
        </script>
    @endPushOnce   
</x-admin::layouts>