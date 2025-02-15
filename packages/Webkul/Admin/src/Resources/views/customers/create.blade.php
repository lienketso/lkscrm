<x-admin::layouts>
    <x-slot:title>
        @lang('admin::app.customers.create.title')
    </x-slot>

    {!! view_render_event('admin.customers.create.form.before') !!}

    <!-- Create Lead Form -->
    <x-admin::form :action="route('admin.customers.store')">
        <div class="flex flex-col gap-4">
            <div class="flex items-center justify-between rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300">
                <div class="flex flex-col gap-2">
                    <div class="flex cursor-pointer items-center">
                        <x-admin::breadcrumbs name="customers.create" />
                    </div>

                    <div class="text-xl font-bold dark:text-white">
                        @lang('admin::app.customers.create.title')
                    </div>
                </div>

                {!! view_render_event('admin.customers.create.save_button.before') !!}

                <div class="flex items-center gap-x-2.5">
                    <!-- Save button for person -->
                    <div class="flex items-center gap-x-2.5">
                        {!! view_render_event('admin.customers.create.form_buttons.before') !!}

                        <button
                            type="submit"
                            class="primary-button"
                        >
                            @lang('admin::app.customers.create.save-btn')
                        </button>

                        {!! view_render_event('admin.customers.create.form_buttons.after') !!}
                    </div>
                </div>

                {!! view_render_event('admin.customers.create.save_button.after') !!}
            </div>

            @if (request('stage_id'))
                <input 
                    type="hidden" 
                    id="lead_pipeline_stage_id" 
                    name="lead_pipeline_stage_id" 
                    value="{{ request('stage_id') }}" 
                />
            @endif

            <!-- Lead Create Component -->
            <v-lead-create></v-lead-create>

            <div class="flex items-center gap-x-2.5">

                <button
                    type="submit"
                    class="primary-button"
                >
                    @lang('admin::app.customers.create.save-btn')
                </button>
            </div>
        </div>
    </x-admin::form>

    {!! view_render_event('admin.customers.create.form.after') !!}

    @pushOnce('scripts')
        <script 
            type="text/x-template"
            id="v-lead-create-template"
        >
            <div class="box-shadow flex flex-col gap-4 rounded-lg border border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-900 max-xl:flex-wrap">
                {!! view_render_event('admin.customers.edit.form_controls.before') !!}
                
                <div class="flex gap-2 border-b border-gray-200 dark:border-gray-800">
                    <!-- Tabs -->
                    <template v-for="tab in tabs" :key="tab.id">
                        {!! view_render_event('admin.customers.create.tabs.before') !!}

                        <a
                            :href="'#' + tab.id"
                            :class="[
                                'inline-block px-3 py-2.5 border-b-2  text-sm font-medium ',
                                activeTab === tab.id
                                ? 'text-brandColor border-brandColor dark:brandColor dark:brandColor'
                                : 'text-gray-600 dark:text-gray-300  border-transparent hover:text-gray-800 hover:border-gray-400 dark:hover:border-gray-400  dark:hover:text-white'
                            ]"
                            :text="tab.label"
                        ></a>

                        {!! view_render_event('admin.customers.create.tabs.after') !!}
                    </template>
                </div>

                <div class="flex flex-col gap-4 px-4 py-2">
                    {!! view_render_event('admin.customers.create.details.before') !!}

                    <!-- Details section -->
                    <div 
                        class="flex flex-col gap-4" 
                        id="lead-details"
                    >
                        <div class="flex flex-col gap-1">
                            <p class="text-base font-semibold dark:text-white">
                                @lang('admin::app.customers.create.details')
                            </p>

                            <p class="text-gray-600 dark:text-white">
                                @lang('admin::app.customers.create.details-info')
                            </p>
                        </div>

                        <div class="w-1/2">
                            {!! view_render_event('admin.customers.create.details.attributes.before') !!}

                            <!-- Lead Details Title and Description -->
                            <!-- <x-admin::attributes
                                :custom-attributes="app('Webkul\Attribute\Repositories\AttributeRepository')->findWhere([
                                    ['code', 'NOTIN', ['lead_value', 'lead_type_id', 'lead_source_id', 'expected_close_date', 'user_id', 'lead_pipeline_id', 'lead_pipeline_stage_id']],
                                    'entity_type' => 'leads',
                                    'quick_add'   => 1
                                ])"
                                :custom-validations="[
                                    'expected_close_date' => [
                                        'date_format:yyyy-MM-dd',
                                        'after:' .  \Carbon\Carbon::yesterday()->format('Y-m-d')
                                    ],
                                ]"
                            /> -->

                            <x-admin::attributes
                                :custom-attributes="app('Webkul\Attribute\Repositories\AttributeRepository')->findWhere([
                                    ['code', 'NOTIN', ['lead_value', 'lead_type_id', 'lead_source_id', 'expected_close_date', 'user_id', 'lead_pipeline_stage_id']],
                                    'entity_type' => 'leads',
                                    'quick_add'   => 1
                                ])"
                                :custom-validations="[
                                    'expected_close_date' => [
                                        'date_format:yyyy-MM-dd',
                                        'after:' .  \Carbon\Carbon::yesterday()->format('Y-m-d')
                                    ],
                                ]"
                            />

                            <!-- Lead Details Oter input fields -->
                            <div class="flex gap-4 max-sm:flex-wrap">
                                <div class="w-full">
                                    <x-admin::attributes
                                        :custom-attributes="app('Webkul\Attribute\Repositories\AttributeRepository')->findWhere([
                                            ['code', 'IN', ['lead_value', 'lead_type_id', 'lead_source_id']],
                                            'entity_type' => 'leads',
                                            'quick_add'   => 1
                                        ])"
                                        :custom-validations="[
                                            'expected_close_date' => [
                                                'date_format:yyyy-MM-dd',
                                                'after:' .  \Carbon\Carbon::yesterday()->format('Y-m-d')
                                            ],
                                        ]"
                                    />
                                </div>
                                    
                                <div class="w-full">
                                    <x-admin::attributes
                                        :custom-attributes="app('Webkul\Attribute\Repositories\AttributeRepository')->findWhere([
                                            ['code', 'IN', ['expected_close_date', 'user_id']],
                                            'entity_type' => 'leads',
                                            'quick_add'   => 1
                                        ])"
                                        :custom-validations="[
                                            'expected_close_date' => [
                                                'date_format:yyyy-MM-dd',
                                                'after:' .  \Carbon\Carbon::yesterday()->format('Y-m-d')
                                            ],
                                        ]"
                                    />
                                </div>
                            </div>

                            {!! view_render_event('admin.customers.create.details.attributes.after') !!}
                        </div>
                    </div>

                    {!! view_render_event('admin.customers.create.details.after') !!}

                    {!! view_render_event('admin.customers.create.contact_person.before') !!}

                    <!-- Contact Person -->
                    <div 
                        class="flex flex-col gap-4" 
                        id="contact-person"
                    >
                        <div class="flex flex-col gap-1">
                            <p class="text-base font-semibold dark:text-white">
                                @lang('admin::app.customers.create.contact-person')
                            </p>

                            <p class="text-gray-600 dark:text-white">
                                @lang('admin::app.customers.create.contact-info')
                            </p>
                        </div>

                        <div class="w-1/2">
                            
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li class='mt-1 text-xs italic text-red-600'>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <br />
                                </div>
                            @endif

                            <!-- Contact Person Component -->
                            @include('admin::customers.common.contact')
                        </div>
                    </div>

                    {!! view_render_event('admin.customers.create.contact_person.after') !!}

                    <!-- Product Section -->
                    <div 
                        class="flex flex-col gap-4" 
                        id="products"
                    >
                        <div class="flex flex-col gap-1">
                            <p class="text-base font-semibold dark:text-white">
                                @lang('admin::app.customers.create.products')
                            </p>

                            <p class="text-gray-600 dark:text-white">
                                @lang('admin::app.customers.create.products-info')
                            </p>
                        </div>

                        <div>
                            <!-- Product Component -->
                            @include('admin::customers.common.products')
                        </div>
                    </div>
                </div>
                
                {!! view_render_event('admin.customers.form_controls.after') !!}
            </div>
        </script>

        <script type="module">
            app.component('v-lead-create', {
                template: '#v-lead-create-template',

                data() {
                    return {
                        activeTab: 'lead-details',

                        tabs: [
                            { id: 'lead-details', label: '@lang('admin::app.customers.create.details')' },
                            { id: 'contact-person', label: '@lang('admin::app.customers.create.contact-person')' },
                            { id: 'products', label: '@lang('admin::app.customers.create.products')' }
                        ],
                    };
                },

                methods: {
                    /**
                     * Scroll to the section.
                     * 
                     * @param {String} tabId
                     * 
                     * @returns {void}
                     */
                    scrollToSection(tabId) {
                        const section = document.getElementById(tabId);

                        if (section) {
                            section.scrollIntoView({ behavior: 'smooth' });
                        }
                    },
                },
            });
        </script>
    @endPushOnce

    @pushOnce('styles')
        <style>
            html {
                scroll-behavior: smooth;
            }
        </style>
    @endPushOnce    
</x-admin::layouts>