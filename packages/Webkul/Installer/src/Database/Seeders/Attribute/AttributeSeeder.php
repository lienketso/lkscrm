<?php

namespace Webkul\Installer\Database\Seeders\Attribute;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttributeSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @param  array  $parameters
     * @return void
     */
    public function run($parameters = [])
    {
        DB::table('attributes')->delete();

        $now = Carbon::now();

        $defaultLocale = $parameters['locale'] ?? config('app.locale');

        DB::table('attributes')->insert([
            /**
             * Leads Attributes
             */
            [
                'code'            => 'title',
                'name'            => trans('installer::app.seeders.attributes.leads.title', [], $defaultLocale),
                'type'            => 'text',
                'entity_type'     => 'leads',
                'lookup_type'     => null,
                'validation'      => null,
                'sort_order'      => '1',
                'is_required'     => '1',
                'is_unique'       => '0',
                'quick_add'       => '1',
                'is_user_defined' => '0',
                'created_at'      => $now,
                'updated_at'      => $now,
            ], [
                'code'            => 'description',
                'name'            => trans('installer::app.seeders.attributes.leads.description', [], $defaultLocale),
                'type'            => 'textarea',
                'entity_type'     => 'leads',
                'lookup_type'     => null,
                'validation'      => null,
                'sort_order'      => '2',
                'is_required'     => '0',
                'is_unique'       => '0',
                'quick_add'       => '1',
                'is_user_defined' => '0',
                'created_at'      => $now,
                'updated_at'      => $now,
            ], [
                'code'            => 'lead_value',
                'name'            => trans('installer::app.seeders.attributes.leads.lead-value', [], $defaultLocale),
                'type'            => 'price',
                'entity_type'     => 'leads',
                'lookup_type'     => null,
                'validation'      => null,
                'sort_order'      => '3',
                'is_required'     => '1',
                'is_unique'       => '0',
                'quick_add'       => '1',
                'is_user_defined' => '0',
                'created_at'      => $now,
                'updated_at'      => $now,
            ], [
                'code'            => 'lead_source_id',
                'name'            => trans('installer::app.seeders.attributes.leads.source', [], $defaultLocale),
                'type'            => 'select',
                'entity_type'     => 'leads',
                'lookup_type'     => 'lead_sources',
                'validation'      => null,
                'sort_order'      => '4',
                'is_required'     => '1',
                'is_unique'       => '0',
                'quick_add'       => '1',
                'is_user_defined' => '0',
                'created_at'      => $now,
                'updated_at'      => $now,
            ], [
                'code'            => 'lead_type_id',
                'name'            => trans('installer::app.seeders.attributes.leads.type', [], $defaultLocale),
                'type'            => 'select',
                'entity_type'     => 'leads',
                'lookup_type'     => 'lead_types',
                'validation'      => null,
                'sort_order'      => '5',
                'is_required'     => '1',
                'is_unique'       => '0',
                'quick_add'       => '1',
                'is_user_defined' => '0',
                'created_at'      => $now,
                'updated_at'      => $now,
            ], [
                'code'            => 'user_id',
                'name'            => trans('installer::app.seeders.attributes.leads.sales-owner', [], $defaultLocale),
                'type'            => 'select',
                'entity_type'     => 'leads',
                'lookup_type'     => 'users',
                'validation'      => null,
                'sort_order'      => '7',
                'is_required'     => '0',
                'is_unique'       => '0',
                'quick_add'       => '1',
                'is_user_defined' => '0',
                'created_at'      => $now,
                'updated_at'      => $now,
            ], [
                'code'            => 'expected_close_date',
                'name'            => trans('installer::app.seeders.attributes.leads.expected-close-date', [], $defaultLocale),
                'type'            => 'date',
                'entity_type'     => 'leads',
                'lookup_type'     => null,
                'validation'      => null,
                'sort_order'      => '8',
                'is_required'     => '0',
                'is_unique'       => '0',
                'quick_add'       => '1',
                'is_user_defined' => '0',
                'created_at'      => $now,
                'updated_at'      => $now,
            ], [
                'code'            => 'lead_pipeline_id',
                'name'            => trans('installer::app.seeders.attributes.leads.pipeline', [], $defaultLocale),
                'type'            => 'lookup',
                'entity_type'     => 'leads',
                'lookup_type'     => 'lead_pipelines',
                'validation'      => null,
                'sort_order'      => '9',
                'is_required'     => '1',
                'is_unique'       => '0',
                'quick_add'       => '1',
                'is_user_defined' => '0',
                'created_at'      => $now,
                'updated_at'      => $now,
            ], [
                'code'            => 'lead_pipeline_stage_id',
                'name'            => trans('installer::app.seeders.attributes.leads.stage', [], $defaultLocale),
                'type'            => 'lookup',
                'entity_type'     => 'leads',
                'lookup_type'     => 'lead_pipeline_stages',
                'validation'      => null,
                'sort_order'      => '10',
                'is_required'     => '1',
                'is_unique'       => '0',
                'quick_add'       => '1',
                'is_user_defined' => '0',
                'created_at'      => $now,
                'updated_at'      => $now,
            ],

            /**
             * Persons Attributes
             */
            [
                'code'            => 'name',
                'name'            => trans('installer::app.seeders.attributes.persons.name', [], $defaultLocale),
                'type'            => 'text',
                'entity_type'     => 'persons',
                'lookup_type'     => null,
                'validation'      => null,
                'sort_order'      => '1',
                'is_required'     => '1',
                'is_unique'       => '0',
                'quick_add'       => '1',
                'is_user_defined' => '0',
                'created_at'      => $now,
                'updated_at'      => $now,
            ], [
                'code'            => 'emails',
                'name'            => trans('installer::app.seeders.attributes.persons.emails', [], $defaultLocale),
                'type'            => 'email',
                'entity_type'     => 'persons',
                'lookup_type'     => null,
                'validation'      => null,
                'sort_order'      => '2',
                'is_required'     => '0',
                'is_unique'       => '1',
                'quick_add'       => '1',
                'is_user_defined' => '0',
                'created_at'      => $now,
                'updated_at'      => $now,
            ], [
                'code'            => 'contact_numbers',
                'name'            => trans('installer::app.seeders.attributes.persons.contact-numbers', [], $defaultLocale),
                'type'            => 'phone',
                'entity_type'     => 'persons',
                'lookup_type'     => null,
                'validation'      => 'numeric',
                'sort_order'      => '3',
                'is_required'     => '0',
                'is_unique'       => '1',
                'quick_add'       => '1',
                'is_user_defined' => '0',
                'created_at'      => $now,
                'updated_at'      => $now,
            ], [
                'code'            => 'job_title',
                'name'            => trans('installer::app.seeders.attributes.persons.job-title', [], $defaultLocale),
                'type'            => 'text',
                'entity_type'     => 'persons',
                'lookup_type'     => null,
                'validation'      => null,
                'sort_order'      => '4',
                'is_required'     => '0',
                'is_unique'       => '0',
                'quick_add'       => '1',
                'is_user_defined' => '0',
                'created_at'      => $now,
                'updated_at'      => $now,
            ], [
                'code'            => 'user_id',
                'name'            => trans('installer::app.seeders.attributes.persons.sales-owner', [], $defaultLocale),
                'type'            => 'lookup',
                'entity_type'     => 'persons',
                'lookup_type'     => 'users',
                'validation'      => null,
                'sort_order'      => '5',
                'is_required'     => '0',
                'is_unique'       => '0',
                'quick_add'       => '1',
                'is_user_defined' => '0',
                'created_at'      => $now,
                'updated_at'      => $now,
            ], [
                'code'            => 'organization_id',
                'name'            => trans('installer::app.seeders.attributes.persons.organization', [], $defaultLocale),
                'type'            => 'lookup',
                'entity_type'     => 'persons',
                'lookup_type'     => 'organizations',
                'validation'      => null,
                'sort_order'      => '6',
                'is_required'     => '0',
                'is_unique'       => '0',
                'quick_add'       => '1',
                'is_user_defined' => '0',
                'created_at'      => $now,
                'updated_at'      => $now,
            ],

            /**
             * Organizations Attributes
             */
            [
                'code'            => 'name',
                'name'            => trans('installer::app.seeders.attributes.organizations.name', [], $defaultLocale),
                'type'            => 'text',
                'entity_type'     => 'organizations',
                'lookup_type'     => null,
                'validation'      => null,
                'sort_order'      => '1',
                'is_required'     => '1',
                'is_unique'       => '1',
                'quick_add'       => '1',
                'is_user_defined' => '0',
                'created_at'      => $now,
                'updated_at'      => $now,
            ], [
                'code'            => 'address',
                'name'            => trans('installer::app.seeders.attributes.organizations.address', [], $defaultLocale),
                'type'            => 'address',
                'entity_type'     => 'organizations',
                'lookup_type'     => null,
                'validation'      => null,
                'sort_order'      => '2',
                'is_required'     => '0',
                'is_unique'       => '0',
                'quick_add'       => '1',
                'is_user_defined' => '0',
                'created_at'      => $now,
                'updated_at'      => $now,
            ], [
                'code'            => 'user_id',
                'name'            => trans('installer::app.seeders.attributes.organizations.sales-owner', [], $defaultLocale),
                'type'            => 'lookup',
                'entity_type'     => 'organizations',
                'lookup_type'     => 'users',
                'validation'      => null,
                'sort_order'      => '3',
                'is_required'     => '0',
                'is_unique'       => '0',
                'quick_add'       => '1',
                'is_user_defined' => '0',
                'created_at'      => $now,
                'updated_at'      => $now,
            ],

            /**
             * Products Attributes
             */
            [
                'code'            => 'name',
                'name'            => trans('installer::app.seeders.attributes.products.name', [], $defaultLocale),
                'type'            => 'text',
                'entity_type'     => 'products',
                'lookup_type'     => null,
                'validation'      => null,
                'sort_order'      => '1',
                'is_required'     => '1',
                'is_unique'       => '0',
                'quick_add'       => '1',
                'is_user_defined' => '0',
                'created_at'      => $now,
                'updated_at'      => $now,
            ], [
                'code'            => 'description',
                'name'            => trans('installer::app.seeders.attributes.products.description', [], $defaultLocale),
                'type'            => 'textarea',
                'entity_type'     => 'products',
                'lookup_type'     => null,
                'validation'      => null,
                'sort_order'      => '2',
                'is_required'     => '0',
                'is_unique'       => '0',
                'quick_add'       => '1',
                'is_user_defined' => '0',
                'created_at'      => $now,
                'updated_at'      => $now,
            ], [
                'code'            => 'sku',
                'name'            => trans('installer::app.seeders.attributes.products.sku', [], $defaultLocale),
                'type'            => 'text',
                'entity_type'     => 'products',
                'lookup_type'     => null,
                'validation'      => null,
                'sort_order'      => '3',
                'is_required'     => '1',
                'is_unique'       => '1',
                'quick_add'       => '1',
                'is_user_defined' => '0',
                'created_at'      => $now,
                'updated_at'      => $now,
            ], [
                'code'            => 'quantity',
                'name'            => trans('installer::app.seeders.attributes.products.quantity', [], $defaultLocale),
                'type'            => 'text',
                'entity_type'     => 'products',
                'lookup_type'     => null,
                'validation'      => 'numeric',
                'sort_order'      => '4',
                'is_required'     => '1',
                'is_unique'       => '0',
                'quick_add'       => '1',
                'is_user_defined' => '0',
                'created_at'      => $now,
                'updated_at'      => $now,
            ], [
                'code'            => 'price',
                'name'            => trans('installer::app.seeders.attributes.products.price', [], $defaultLocale),
                'type'            => 'text',
                'entity_type'     => 'products',
                'lookup_type'     => null,
                'validation'      => 'decimal',
                'sort_order'      => '5',
                'is_required'     => '1',
                'is_unique'       => '0',
                'quick_add'       => '1',
                'is_user_defined' => '0',
                'created_at'      => $now,
                'updated_at'      => $now,
            ],

            /**
             * Quotes Attributes
             */
            [
                'code'            => 'user_id',
                'name'            => trans('installer::app.seeders.attributes.quotes.sales-owner', [], $defaultLocale),
                'type'            => 'select',
                'entity_type'     => 'quotes',
                'lookup_type'     => 'users',
                'validation'      => null,
                'sort_order'      => '1',
                'is_required'     => '1',
                'is_unique'       => '0',
                'quick_add'       => '1',
                'is_user_defined' => '0',
                'created_at'      => $now,
                'updated_at'      => $now,
            ], [
                'code'            => 'subject',
                'name'            => trans('installer::app.seeders.attributes.quotes.subject', [], $defaultLocale),
                'type'            => 'text',
                'entity_type'     => 'quotes',
                'lookup_type'     => null,
                'validation'      => null,
                'sort_order'      => '2',
                'is_required'     => '1',
                'is_unique'       => '0',
                'quick_add'       => '1',
                'is_user_defined' => '0',
                'created_at'      => $now,
                'updated_at'      => $now,
            ], [
                'code'            => 'description',
                'name'            => trans('installer::app.seeders.attributes.quotes.description', [], $defaultLocale),
                'type'            => 'textarea',
                'entity_type'     => 'quotes',
                'lookup_type'     => null,
                'validation'      => null,
                'sort_order'      => '3',
                'is_required'     => '0',
                'is_unique'       => '0',
                'quick_add'       => '1',
                'is_user_defined' => '0',
                'created_at'      => $now,
                'updated_at'      => $now,
            ], [
                'code'            => 'billing_address',
                'name'            => trans('installer::app.seeders.attributes.quotes.billing-address', [], $defaultLocale),
                'type'            => 'address',
                'entity_type'     => 'quotes',
                'lookup_type'     => null,
                'validation'      => null,
                'sort_order'      => '4',
                'is_required'     => '1',
                'is_unique'       => '0',
                'quick_add'       => '1',
                'is_user_defined' => '0',
                'created_at'      => $now,
                'updated_at'      => $now,
            ], [
                'code'            => 'shipping_address',
                'name'            => trans('installer::app.seeders.attributes.quotes.shipping-address', [], $defaultLocale),
                'type'            => 'address',
                'entity_type'     => 'quotes',
                'lookup_type'     => null,
                'validation'      => null,
                'sort_order'      => '5',
                'is_required'     => '0',
                'is_unique'       => '0',
                'quick_add'       => '1',
                'is_user_defined' => '0',
                'created_at'      => $now,
                'updated_at'      => $now,
            ], [
                'code'            => 'discount_percent',
                'name'            => trans('installer::app.seeders.attributes.quotes.discount-percent', [], $defaultLocale),
                'type'            => 'text',
                'entity_type'     => 'quotes',
                'lookup_type'     => null,
                'validation'      => 'decimal',
                'sort_order'      => '6',
                'is_required'     => '0',
                'is_unique'       => '0',
                'quick_add'       => '1',
                'is_user_defined' => '0',
                'created_at'      => $now,
                'updated_at'      => $now,
            ], [
                'code'            => 'discount_amount',
                'name'            => trans('installer::app.seeders.attributes.quotes.discount-amount', [], $defaultLocale),
                'type'            => 'price',
                'entity_type'     => 'quotes',
                'lookup_type'     => null,
                'validation'      => 'decimal',
                'sort_order'      => '7',
                'is_required'     => '0',
                'is_unique'       => '0',
                'quick_add'       => '1',
                'is_user_defined' => '0',
                'created_at'      => $now,
                'updated_at'      => $now,
            ], [
                'code'            => 'tax_amount',
                'name'            => trans('installer::app.seeders.attributes.quotes.tax-amount', [], $defaultLocale),
                'type'            => 'price',
                'entity_type'     => 'quotes',
                'lookup_type'     => null,
                'validation'      => 'decimal',
                'sort_order'      => '8',
                'is_required'     => '0',
                'is_unique'       => '0',
                'quick_add'       => '1',
                'is_user_defined' => '0',
                'created_at'      => $now,
                'updated_at'      => $now,
            ], [
                'code'            => 'adjustment_amount',
                'name'            => trans('installer::app.seeders.attributes.quotes.adjustment-amount', [], $defaultLocale),
                'type'            => 'price',
                'entity_type'     => 'quotes',
                'lookup_type'     => null,
                'validation'      => 'decimal',
                'sort_order'      => '9',
                'is_required'     => '0',
                'is_unique'       => '0',
                'quick_add'       => '1',
                'is_user_defined' => '0',
                'created_at'      => $now,
                'updated_at'      => $now,
            ], [
                'code'            => 'sub_total',
                'name'            => trans('installer::app.seeders.attributes.quotes.sub-total', [], $defaultLocale),
                'type'            => 'price',
                'entity_type'     => 'quotes',
                'lookup_type'     => null,
                'validation'      => 'decimal',
                'sort_order'      => '10',
                'is_required'     => '1',
                'is_unique'       => '0',
                'quick_add'       => '1',
                'is_user_defined' => '0',
                'created_at'      => $now,
                'updated_at'      => $now,
            ], [
                'code'            => 'grand_total',
                'name'            => trans('installer::app.seeders.attributes.quotes.grand-total', [], $defaultLocale),
                'type'            => 'price',
                'entity_type'     => 'quotes',
                'lookup_type'     => null,
                'validation'      => 'decimal',
                'sort_order'      => '11',
                'is_required'     => '1',
                'is_unique'       => '0',
                'quick_add'       => '1',
                'is_user_defined' => '0',
                'created_at'      => $now,
                'updated_at'      => $now,
            ], [
                'code'            => 'expired_at',
                'name'            => trans('installer::app.seeders.attributes.quotes.expired-at', [], $defaultLocale),
                'type'            => 'date',
                'entity_type'     => 'quotes',
                'lookup_type'     => null,
                'validation'      => null,
                'sort_order'      => '12',
                'is_required'     => '1',
                'is_unique'       => '0',
                'quick_add'       => '1',
                'is_user_defined' => '0',
                'created_at'      => $now,
                'updated_at'      => $now,
            ], [
                'code'            => 'person_id',
                'name'            => trans('installer::app.seeders.attributes.quotes.person', [], $defaultLocale),
                'type'            => 'lookup',
                'entity_type'     => 'quotes',
                'lookup_type'     => 'persons',
                'validation'      => null,
                'sort_order'      => '13',
                'is_required'     => '1',
                'is_unique'       => '0',
                'quick_add'       => '1',
                'is_user_defined' => '0',
                'created_at'      => $now,
                'updated_at'      => $now,
            ],

            /**
             * Warehouses Attributes
             */
            [
                'code'            => 'name',
                'name'            => trans('installer::app.seeders.attributes.warehouses.name'),
                'type'            => 'text',
                'entity_type'     => 'warehouses',
                'lookup_type'     => null,
                'validation'      => null,
                'sort_order'      => '1',
                'is_required'     => '1',
                'is_unique'       => '0',
                'quick_add'       => '1',
                'is_user_defined' => '0',
                'created_at'      => $now,
                'updated_at'      => $now,
            ], [
                'code'            => 'description',
                'name'            => trans('installer::app.seeders.attributes.warehouses.description'),
                'type'            => 'textarea',
                'entity_type'     => 'warehouses',
                'lookup_type'     => null,
                'validation'      => null,
                'sort_order'      => '2',
                'is_required'     => '0',
                'is_unique'       => '0',
                'quick_add'       => '1',
                'is_user_defined' => '0',
                'created_at'      => $now,
                'updated_at'      => $now,
            ], [
                'code'            => 'contact_name',
                'name'            => trans('installer::app.seeders.attributes.warehouses.contact-name'),
                'type'            => 'text',
                'entity_type'     => 'warehouses',
                'lookup_type'     => null,
                'validation'      => null,
                'sort_order'      => '3',
                'is_required'     => '1',
                'is_unique'       => '0',
                'quick_add'       => '1',
                'is_user_defined' => '0',
                'created_at'      => $now,
                'updated_at'      => $now,
            ], [
                'code'            => 'contact_emails',
                'name'            => trans('installer::app.seeders.attributes.warehouses.contact-emails'),
                'type'            => 'email',
                'entity_type'     => 'warehouses',
                'lookup_type'     => null,
                'validation'      => null,
                'sort_order'      => '4',
                'is_required'     => '1',
                'is_unique'       => '1',
                'quick_add'       => '1',
                'is_user_defined' => '0',
                'created_at'      => $now,
                'updated_at'      => $now,
            ], [
                'code'            => 'contact_numbers',
                'name'            => trans('installer::app.seeders.attributes.warehouses.contact-numbers'),
                'type'            => 'phone',
                'entity_type'     => 'warehouses',
                'lookup_type'     => null,
                'validation'      => 'numeric',
                'sort_order'      => '5',
                'is_required'     => '0',
                'is_unique'       => '1',
                'quick_add'       => '1',
                'is_user_defined' => '0',
                'created_at'      => $now,
                'updated_at'      => $now,
            ], [
                'code'            => 'contact_address',
                'name'            => trans('installer::app.seeders.attributes.warehouses.contact-address'),
                'type'            => 'address',
                'entity_type'     => 'warehouses',
                'lookup_type'     => null,
                'validation'      => null,
                'sort_order'      => '6',
                'is_required'     => '1',
                'is_unique'       => '0',
                'quick_add'       => '1',
                'is_user_defined' => '0',
                'created_at'      => $now,
                'updated_at'      => $now,
            ],
        ]);
    }
}
