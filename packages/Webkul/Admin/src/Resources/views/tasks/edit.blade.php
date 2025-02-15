<x-admin::layouts>
    <x-slot:title>
        @lang('admin::app.campaign.edit.title')
    </x-slot>

    {!! view_render_event('admin.campaign.edit.form.before') !!}

    <!-- Create campaign Form -->
    <x-admin::form :action="route('admin.campaign.store')">
        <div class="flex flex-col gap-4">
            <div class="flex items-center justify-between rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300">
                <div class="flex flex-col gap-2">
                    <div class="flex cursor-pointer items-center">
                        <x-admin::breadcrumbs name="campaign.edit" :entity="$campaign"/>
                    </div>

                    <div class="text-xl font-bold dark:text-white">
                        @lang('admin::app.campaign.edit.title')
                    </div>
                </div>

                {!! view_render_event('admin.campaign.edit.save_button.before') !!}

                <div class="flex items-center gap-x-2.5">
                    <!-- Save button for person -->
                    <div class="flex items-center gap-x-2.5">
                        {!! view_render_event('admin.campaign.edit.form_buttons.before') !!}

                        <button
                            type="submit"
                            class="primary-button"
                        >
                            @lang('admin::app.campaign.edit.save-btn')
                        </button>

                        {!! view_render_event('admin.campaign.edit.form_buttons.after') !!}
                    </div>
                </div>

                {!! view_render_event('admin.campaign.edit.save_button.after') !!}
            </div>
        </div>

        <!-- Form Content -->
        <div class="flex mt-3.5 gap-2.5 max-xl:flex-wrap">
            <!-- Left -->
            <div class="flex flex-1 flex-col gap-2 max-xl:flex-auto">
                <div class="box-shadow rounded-lg border border-gray-200 bg-white p-4 dark:bg-gray-900 dark:border-gray-800">
                    {!! view_render_event('admin.campaign.edit.form_controls.before') !!}
                    <x-admin::form.control-group>
                        <x-admin::form.control-group.label class="required">
                            @lang('admin::app.campaign.index.datagrid.name')
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="text"
                            name="name"
                            id="name"
                            rules="required"
                            :value="old('name') ?? $campaign->name"
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
                            :value="old('description') ?? $campaign->description"
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

                    {!! view_render_event('admin.campaign.edit.form_controls.after') !!}
                </div>
            </div>
            <!-- Right -->
            <div class="flex w-[926px] max-w-full flex-col gap-2 max-sm:w-full">
                <div class="box-shadow rounded-lg border border-gray-200 bg-white p-4 dark:bg-gray-900 dark:border-gray-800">
                    
                </div>
            </div>
        </div>
    </x-admin::form>

    {!! view_render_event('admin.campaign.edit.form.after') !!}

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
                    @json($customers).forEach(customer => {
                        this.addedCustomers.push(customer);
                    });
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
    @endPushOnce   
</x-admin::layouts>