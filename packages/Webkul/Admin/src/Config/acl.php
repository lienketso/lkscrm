<?php

return [
    [
        'key'   => 'dashboard',
        'name'  => 'admin::app.layouts.dashboard',
        'route' => 'admin.dashboard.index',
        'sort'  => 1,
    ],  
    
    
    [
        'key'   => 'leads',
        'name'  => 'admin::app.acl.leads',
        'route' => 'admin.leads.index',
        'sort'  => 2,
    ], [
        'key'   => 'leads.create',
        'name'  => 'admin::app.acl.create',
        'route' => ['admin.leads.create', 'admin.leads.store'],
        'sort'  => 1,
    ], [
        'key'   => 'leads.view',
        'name'  => 'admin::app.acl.view',
        'route' => 'admin.leads.view',
        'sort'  => 2,
    ], [
        'key'   => 'leads.edit',
        'name'  => 'admin::app.acl.edit',
        'route' => ['admin.leads.edit', 'admin.leads.update', 'admin.leads.mass_update'],
        'sort'  => 3,
    ], [
        'key'   => 'leads.delete',
        'name'  => 'admin::app.acl.delete',
        'route' => ['admin.leads.delete', 'admin.leads.mass_delete'],
        'sort'  => 4,
    ], 



    [
        'key'   => 'customers',
        'name'  => 'admin::app.acl.customers',
        'route' => 'admin.customers.index',
        'sort'  => 2,
    ], [
        'key'   => 'customers.create',
        'name'  => 'admin::app.acl.create',
        'route' => ['admin.customers.create', 'admin.customers.store'],
        'sort'  => 1,
    ], [
        'key'   => 'customers.view',
        'name'  => 'admin::app.acl.view',
        'route' => 'admin.customers.view',
        'sort'  => 2,
    ], [
        'key'   => 'customers.edit',
        'name'  => 'admin::app.acl.edit',
        'route' => ['admin.customers.edit', 'admin.customers.update', 'admin.customers.mass_update'],
        'sort'  => 3,
    ], [
        'key'   => 'customers.delete',
        'name'  => 'admin::app.acl.delete',
        'route' => ['admin.customers.delete', 'admin.customers.mass_delete'],
        'sort'  => 4,
    ], 
    
    
    
    
    [
        'key'   => 'quotes',
        'name'  => 'admin::app.acl.quotes',
        'route' => 'admin.quotes.index',
        'sort'  => 3,
    ], [
        'key'   => 'quotes.create',
        'name'  => 'admin::app.acl.create',
        'route' => ['admin.quotes.create', 'admin.quotes.store'],
        'sort'  => 1,
    ], [
        'key'   => 'quotes.edit',
        'name'  => 'admin::app.acl.edit',
        'route' => ['admin.quotes.edit', 'admin.quotes.update'],
        'sort'  => 2,
    ], [
        'key'   => 'quotes.print',
        'name'  => 'admin::app.acl.print',
        'route' => 'admin.quotes.print',
        'sort'  => 3,
    ], [
        'key'   => 'quotes.delete',
        'name'  => 'admin::app.acl.delete',
        'route' => ['admin.quotes.delete', 'admin.quotes.mass_delete'],
        'sort'  => 4,
    ],  [
        'key'   => 'mail',
        'name'  => 'admin::app.acl.mail',
        'route' => 'admin.mail.index',
        'sort'  => 4,
    ], [
        'key'   => 'mail.inbox',
        'name'  => 'admin::app.acl.inbox',
        'route' => 'admin.mail.index',
        'sort'  => 1,
    ], [
        'key'   => 'mail.draft',
        'name'  => 'admin::app.acl.draft',
        'route' => 'admin.mail.index',
        'sort'  => 2,
    ], [
        'key'   => 'mail.outbox',
        'name'  => 'admin::app.acl.outbox',
        'route' => 'admin.mail.index',
        'sort'  => 3,
    ], [
        'key'   => 'mail.sent',
        'name'  => 'admin::app.acl.sent',
        'route' => 'admin.mail.index',
        'sort'  => 4,
    ], [
        'key'   => 'mail.trash',
        'name'  => 'admin::app.acl.trash',
        'route' => 'admin.mail.index',
        'sort'  => 5,
    ], [
        'key'   => 'mail.compose',
        'name'  => 'admin::app.acl.create',
        'route' => ['admin.mail.store'],
        'sort'  => 6,
    ], [
        'key'   => 'mail.view',
        'name'  => 'admin::app.acl.view',
        'route' => 'admin.mail.view',
        'sort'  => 7,
    ], [
        'key'   => 'mail.edit',
        'name'  => 'admin::app.acl.edit',
        'route' => 'admin.mail.update',
        'sort'  => 8,
    ], [
        'key'   => 'mail.delete',
        'name'  => 'admin::app.acl.delete',
        'route' => ['admin.mail.delete', 'admin.mail.mass_delete'],
        'sort'  => 9,
    ], [
        'key'   => 'activities',
        'name'  => 'admin::app.acl.activities',
        'route' => 'admin.activities.index',
        'sort'  => 5,
    ], [
        'key'   => 'activities.create',
        'name'  => 'admin::app.acl.create',
        'route' => ['admin.activities.create', 'admin.activities.store'],
        'sort'  => 1,
    ], [
        'key'   => 'activities.edit',
        'name'  => 'admin::app.acl.edit',
        'route' => ['admin.activities.edit', 'admin.activities.update', 'admin.activities.mass_update'],
        'sort'  => 2,
    ], [
        'key'   => 'activities.delete',
        'name'  => 'admin::app.acl.delete',
        'route' => ['admin.activities.delete', 'admin.activities.mass_delete'],
        'sort'  => 3,
    ], [
        'key'   => 'contacts',
        'name'  => 'admin::app.acl.contacts',
        'route' => 'admin.contacts.users.index',
        'sort'  => 6,
    ],  [
        'key'   => 'contacts.persons',
        'name'  => 'admin::app.acl.persons',
        'route' => 'admin.contacts.persons.index',
        'sort'  => 1,
    ], [
        'key'   => 'contacts.persons.create',
        'name'  => 'admin::app.acl.create',
        'route' => ['admin.contacts.persons.create', 'admin.contacts.persons.store'],
        'sort'  => 2,
    ], [
        'key'   => 'contacts.persons.edit',
        'name'  => 'admin::app.acl.edit',
        'route' => ['admin.contacts.persons.edit', 'admin.contacts.persons.update'],
        'sort'  => 3,
    ], [
        'key'   => 'contacts.persons.delete',
        'name'  => 'admin::app.acl.delete',
        'route' => ['admin.contacts.persons.delete', 'admin.contacts.persons.mass_delete'],
        'sort'  => 4,
    ], [
        'key'   => 'contacts.persons.export',
        'name'  => 'admin::app.acl.export',
        'route' => 'ui.datagrid.export',
        'sort'  => 4,
    ],  [
        'key'   => 'contacts.persons.view',
        'name'  => 'admin::app.acl.view',
        'route' => 'admin.contacts.persons.view',
        'sort'  => 5,
    ], [
        'key'   => 'contacts.organizations',
        'name'  => 'admin::app.acl.organizations',
        'route' => 'admin.contacts.organizations.index',
        'sort'  => 2,
    ], [
        'key'   => 'contacts.organizations.create',
        'name'  => 'admin::app.acl.create',
        'route' => ['admin.contacts.organizations.create', 'admin.contacts.organizations.store'],
        'sort'  => 1,
    ], [
        'key'   => 'contacts.organizations.edit',
        'name'  => 'admin::app.acl.edit',
        'route' => ['admin.contacts.organizations.edit', 'admin.contacts.organizations.update'],
        'sort'  => 2,
    ], [
        'key'   => 'contacts.organizations.delete',
        'name'  => 'admin::app.acl.delete',
        'route' => ['admin.contacts.organizations.delete', 'admin.contacts.organizations.mass_delete'],
        'sort'  => 3,
    ],  [
        'key'   => 'products',
        'name'  => 'admin::app.acl.products',
        'route' => 'admin.products.index',
        'sort'  => 7,
    ], [
        'key'   => 'products.create',
        'name'  => 'admin::app.acl.create',
        'route' => ['admin.products.create', 'admin.products.store'],
        'sort'  => 1,
    ], [
        'key'   => 'products.edit',
        'name'  => 'admin::app.acl.edit',
        'route' => ['admin.products.edit', 'admin.products.update'],
        'sort'  => 2,
    ], [
        'key'   => 'products.delete',
        'name'  => 'admin::app.acl.delete',
        'route' => ['admin.products.delete', 'admin.products.mass_delete'],
        'sort'  => 3,
    ], [
        'key'   => 'products.view',
        'name'  => 'admin::app.acl.view',
        'route' => 'admin.products.view',
        'sort'  => 3,
    ], [
        'key'   => 'settings',
        'name'  => 'admin::app.acl.settings',
        'route' => 'admin.settings.index',
        'sort'  => 8,
    ], [
        'key'   => 'settings.user',
        'name'  => 'admin::app.acl.user',
        'route' => ['admin.settings.groups.index', 'admin.settings.roles.index', 'admin.settings.users.index'],
        'sort'  => 1,
    ], [
        'key'   => 'settings.user.groups',
        'name'  => 'admin::app.acl.groups',
        'route' => 'admin.settings.groups.index',
        'sort'  => 1,
    ], [
        'key'   => 'settings.user.groups.create',
        'name'  => 'admin::app.acl.create',
        'route' => ['admin.settings.groups.create', 'admin.settings.groups.store'],
        'sort'  => 1,
    ], [
        'key'   => 'settings.user.groups.edit',
        'name'  => 'admin::app.acl.edit',
        'route' => ['admin.settings.groups.edit', 'admin.settings.groups.update'],
        'sort'  => 2,
    ], [
        'key'   => 'settings.user.groups.delete',
        'name'  => 'admin::app.acl.delete',
        'route' => 'admin.settings.groups.delete',
        'sort'  => 3,
    ], [
        'key'   => 'settings.user.roles',
        'name'  => 'admin::app.acl.roles',
        'route' => 'admin.settings.roles.index',
        'sort'  => 2,
    ], [
        'key'   => 'settings.user.roles.create',
        'name'  => 'admin::app.acl.create',
        'route' => ['admin.settings.roles.create', 'admin.settings.roles.store'],
        'sort'  => 1,
    ], [
        'key'   => 'settings.user.roles.edit',
        'name'  => 'admin::app.acl.edit',
        'route' => ['admin.settings.roles.edit', 'admin.settings.roles.update'],
        'sort'  => 2,
    ], [
        'key'   => 'settings.user.roles.delete',
        'name'  => 'admin::app.acl.delete',
        'route' => 'admin.settings.roles.delete',
        'sort'  => 3,
    ],  [
        'key'   => 'settings.user.users',
        'name'  => 'admin::app.acl.users',
        'route' => 'admin.settings.users.index',
        'sort'  => 3,
    ], [
        'key'   => 'settings.user.users.create',
        'name'  => 'admin::app.acl.create',
        'route' => ['admin.settings.users.create', 'admin.settings.users.store'],
        'sort'  => 1,
    ], [
        'key'   => 'settings.user.users.edit',
        'name'  => 'admin::app.acl.edit',
        'route' => ['admin.settings.users.edit', 'admin.settings.users.update', 'admin.settings.users.mass_update'],
        'sort'  => 2,
    ], [
        'key'   => 'settings.user.users.delete',
        'name'  => 'admin::app.acl.delete',
        'route' => ['admin.settings.users.delete', 'admin.settings.users.mass_delete'],
        'sort'  => 3,
    ], [
        'key'   => 'settings.lead',
        'name'  => 'admin::app.acl.lead',
        'route' => ['admin.settings.pipelines.index', 'admin.settings.sources.index', 'admin.settings.types.index'],
        'sort'  => 2,
    ], [
        'key'   => 'settings.lead.pipelines',
        'name'  => 'admin::app.acl.pipelines',
        'route' => 'admin.settings.pipelines.index',
        'sort'  => 1,
    ], [
        'key'   => 'settings.lead.pipelines.create',
        'name'  => 'admin::app.acl.create',
        'route' => ['admin.settings.pipelines.create', 'admin.settings.pipelines.store'],
        'sort'  => 1,
    ], [
        'key'   => 'settings.lead.pipelines.edit',
        'name'  => 'admin::app.acl.edit',
        'route' => ['admin.settings.pipelines.edit', 'admin.settings.pipelines.update'],
        'sort'  => 2,
    ], [
        'key'   => 'settings.lead.pipelines.delete',
        'name'  => 'admin::app.acl.delete',
        'route' => 'admin.settings.pipelines.delete',
        'sort'  => 3,
    ], [
        'key'   => 'settings.lead.sources',
        'name'  => 'admin::app.acl.sources',
        'route' => 'admin.settings.sources.index',
        'sort'  => 2,
    ], [
        'key'   => 'settings.lead.sources.create',
        'name'  => 'admin::app.acl.create',
        'route' => ['admin.settings.sources.store'],
        'sort'  => 1,
    ], [
        'key'   => 'settings.lead.sources.edit',
        'name'  => 'admin::app.acl.edit',
        'route' => ['admin.settings.sources.edit', 'admin.settings.sources.update'],
        'sort'  => 2,
    ], [
        'key'   => 'settings.lead.sources.delete',
        'name'  => 'admin::app.acl.delete',
        'route' => 'admin.settings.sources.delete',
        'sort'  => 3,
    ], [
        'key'   => 'settings.lead.types',
        'name'  => 'admin::app.acl.types',
        'route' => 'admin.settings.types.index',
        'sort'  => 3,
    ], [
        'key'   => 'settings.lead.types.create',
        'name'  => 'admin::app.acl.create',
        'route' => ['admin.settings.types.store'],
        'sort'  => 1,
    ], [
        'key'   => 'settings.lead.types.edit',
        'name'  => 'admin::app.acl.edit',
        'route' => ['admin.settings.types.edit', 'admin.settings.types.update'],
        'sort'  => 2,
    ], [
        'key'   => 'settings.lead.types.delete',
        'name'  => 'admin::app.acl.delete',
        'route' => 'admin.settings.types.delete',
        'sort'  => 3,
    ], [
        'key'   => 'settings.automation',
        'name'  => 'admin::app.acl.automation',
        'route' => ['admin.settings.attributes.index', 'admin.settings.email_templates.index', 'admin.settings.workflows.index'],
        'sort'  => 3,
    ], [
        'key'   => 'settings.automation.attributes',
        'name'  => 'admin::app.acl.attributes',
        'route' => 'admin.settings.attributes.index',
        'sort'  => 1,
    ], [
        'key'   => 'settings.automation.attributes.create',
        'name'  => 'admin::app.acl.create',
        'route' => ['admin.settings.attributes.create', 'admin.settings.attributes.store'],
        'sort'  => 1,
    ], [
        'key'   => 'settings.automation.attributes.edit',
        'name'  => 'admin::app.acl.edit',
        'route' => ['admin.settings.attributes.edit', 'admin.settings.attributes.update', 'admin.settings.attributes.mass_update'],
        'sort'  => 2,
    ], [
        'key'   => 'settings.automation.attributes.delete',
        'name'  => 'admin::app.acl.delete',
        'route' => 'admin.settings.attributes.delete',
        'sort'  => 3,
    ], [
        'key'   => 'settings.automation.email_templates',
        'name'  => 'admin::app.acl.email-templates',
        'route' => 'admin.settings.email_templates.index',
        'sort'  => 7,
    ], [
        'key'   => 'settings.automation.email_templates.create',
        'name'  => 'admin::app.acl.create',
        'route' => ['admin.settings.email_templates.create', 'admin.settings.email_templates.store'],
        'sort'  => 1,
    ], [
        'key'   => 'settings.automation.email_templates.edit',
        'name'  => 'admin::app.acl.edit',
        'route' => ['admin.settings.email_templates.edit', 'admin.settings.email_templates.update'],
        'sort'  => 2,
    ], [
        'key'   => 'settings.automation.email_templates.delete',
        'name'  => 'admin::app.acl.delete',
        'route' => 'admin.settings.email_templates.delete',
        'sort'  => 3,
    ], [
        'key'   => 'settings.automation.workflows',
        'name'  => 'admin::app.acl.workflows',
        'route' => 'admin.settings.workflows.index',
        'sort'  => 2,
    ], [
        'key'   => 'settings.automation.workflows.create',
        'name'  => 'admin::app.acl.create',
        'route' => ['admin.settings.workflows.create', 'admin.settings.workflows.store'],
        'sort'  => 1,
    ], [
        'key'   => 'settings.automation.workflows.edit',
        'name'  => 'admin::app.acl.edit',
        'route' => ['admin.settings.workflows.edit', 'admin.settings.workflows.update'],
        'sort'  => 2,
    ], [
        'key'   => 'settings.automation.workflows.delete',
        'name'  => 'admin::app.acl.delete',
        'route' => 'admin.settings.workflows.delete',
        'sort'  => 3,
    ],
    [
        'key'   => 'settings.automation.webhooks',
        'name'  => 'admin::app.acl.webhook',
        'route' => 'admin.settings.webhooks.index',
        'sort'  => 1,
    ], [
        'key'   => 'settings.automation.webhooks.create',
        'name'  => 'admin::app.acl.create',
        'route' => ['admin.settings.webhooks.create', 'admin.settings.webhooks.store'],
        'sort'  => 1,
    ], [
        'key'   => 'settings.automation.webhooks.edit',
        'name'  => 'admin::app.acl.edit',
        'route' => ['admin.settings.webhooks.edit', 'admin.settings.webhooks.update'],
        'sort'  => 2,
    ], [
        'key'   => 'settings.automation.webhooks.delete',
        'name'  => 'admin::app.acl.delete',
        'route' => 'admin.settings.webhooks.delete',
        'sort'  => 3,
    ], [
        'key'   => 'settings.other_settings',
        'name'  => 'admin::app.acl.other-settings',
        'route' => 'admin.settings.tags.index',
        'sort'  => 4,
    ], [
        'key'   => 'settings.other_settings.tags',
        'name'  => 'admin::app.acl.tags',
        'route' => 'admin.settings.tags.index',
        'sort'  => 1,
    ], [
        'key'   => 'settings.other_settings.tags.create',
        'name'  => 'admin::app.acl.create',
        'route' => ['admin.settings.tags.create', 'admin.settings.tags.store', 'admin.leads.tags.attach'],
        'sort'  => 1,
    ], [
        'key'   => 'settings.other_settings.tags.edit',
        'name'  => 'admin::app.acl.edit',
        'route' => ['admin.settings.tags.edit', 'admin.settings.tags.update'],
        'sort'  => 1,
    ], [
        'key'   => 'settings.other_settings.tags.delete',
        'name'  => 'admin::app.acl.delete',
        'route' => ['admin.settings.tags.delete', 'admin.settings.tags.mass_delete', 'admin.leads.tags.detach'],
        'sort'  => 2,
    ], [
        'key'   => 'configuration',
        'name'  => 'admin::app.acl.configuration',
        'route' => 'admin.configuration.index',
        'sort'  => 9,
    ],
    [
        'key'   => 'zalo',
        'name'  => 'admin::app.acl.zalo',
        'route' => 'admin.leads.index',
        'sort'  => 10,
    ], [
        'key'   => 'zalo.template',
        'name'  => 'admin::app.acl.zalo-template',
        'route' => 'admin.zalo.template.index',
        'sort'  => 1,
    ], [
        'key'   => 'zalo.template.create',
        'name'  => 'admin::app.acl.create',
        'route' => ['admin.zalo.template.create', 'admin.zalo.template.store'],
        'sort'  => 1,
    ], [
        'key'   => 'zalo.template.view',
        'name'  => 'admin::app.acl.view',
        'route' => 'admin.zalo.template.view',
        'sort'  => 2,
    ], [
        'key'   => 'zalo.template.edit',
        'name'  => 'admin::app.acl.edit',
        'route' => ['admin.zalo.template.edit', 'admin.zalo.template.update', 'admin.zalo.template.mass_update'],
        'sort'  => 3,
    ], [
        'key'   => 'zalo.template.delete',
        'name'  => 'admin::app.acl.delete',
        'route' => ['admin.zalo.template.delete', 'admin.zalo.template.mass_delete'],
        'sort'  => 4,
    ], [
        'key'   => 'zalo.campaign',
        'name'  => 'admin::app.acl.zalo-campaign',
        'route' => 'admin.campaign.index',
        'sort'  => 2,
    ], [
        'key'   => 'zalo.campaign.create',
        'name'  => 'admin::app.acl.create',
        'route' => ['admin.campaign.create', 'admin.campaign.store'],
        'sort'  => 1,
    ], [
        'key'   => 'zalo.campaign.view',
        'name'  => 'admin::app.acl.view',
        'route' => 'admin.campaign.view',
        'sort'  => 2,
    ], [
        'key'   => 'zalo.campaign.edit',
        'name'  => 'admin::app.acl.edit',
        'route' => ['admin.campaign.edit', 'admin.campaign.update', 'admin.campaign.mass_update'],
        'sort'  => 3,
    ], [
        'key'   => 'zalo.campaign.delete',
        'name'  => 'admin::app.acl.delete',
        'route' => ['admin.campaign.delete', 'admin.campaign.mass_delete'],
        'sort'  => 4,
    ], 
    [
        'key'   => 'project',
        'name'  => 'admin::app.acl.projects',
        'route' => 'admin.projects.index',
        'sort'  => 12,
    ], [
        'key'   => 'project.create',
        'name'  => 'admin::app.acl.create',
        'route' => ['admin.projects.create', 'admin.projects.store'],
        'sort'  => 1,
    ], [
        'key'   => 'project.view',
        'name'  => 'admin::app.acl.view',
        'route' => 'admin.projects.view',
        'sort'  => 2,
    ], [
        'key'   => 'project.edit',
        'name'  => 'admin::app.acl.edit',
        'route' => ['admin.projects.edit', 'admin.projects.update', 'admin.projects.mass_update'],
        'sort'  => 3,
    ], [
        'key'   => 'project.delete',
        'name'  => 'admin::app.acl.delete',
        'route' => ['admin.projects.delete', 'admin.projects.mass_delete'],
        'sort'  => 4,
    ], 
    [
        'key'   => 'phase',
        'name'  => 'admin::app.acl.phases',
        'route' => 'admin.phases.index',
        'sort'  => 13,
    ], [
        'key'   => 'phase.create',
        'name'  => 'admin::app.acl.create',
        'route' => ['admin.phases.create', 'admin.phases.store'],
        'sort'  => 1,
    ], [
        'key'   => 'phase.view',
        'name'  => 'admin::app.acl.view',
        'route' => 'admin.phases.view',
        'sort'  => 2,
    ], [
        'key'   => 'phase.edit',
        'name'  => 'admin::app.acl.edit',
        'route' => ['admin.phases.edit', 'admin.phases.update', 'admin.phases.mass_update'],
        'sort'  => 3,
    ], [
        'key'   => 'phase.delete',
        'name'  => 'admin::app.acl.delete',
        'route' => ['admin.phases.delete', 'admin.phases.mass_delete'],
        'sort'  => 4,
    ], 
    [
        'key'   => 'task',
        'name'  => 'admin::app.acl.tasks',
        'route' => 'admin.tasks.index',
        'sort'  => 14,
    ], [
        'key'   => 'task.create',
        'name'  => 'admin::app.acl.create',
        'route' => ['admin.tasks.create', 'admin.tasks.store'],
        'sort'  => 1,
    ], [
        'key'   => 'task.view',
        'name'  => 'admin::app.acl.view',
        'route' => 'admin.tasks.view',
        'sort'  => 2,
    ], [
        'key'   => 'task.edit',
        'name'  => 'admin::app.acl.edit',
        'route' => ['admin.tasks.edit', 'admin.tasks.update', 'admin.tasks.mass_update'],
        'sort'  => 3,
    ], [
        'key'   => 'task.delete',
        'name'  => 'admin::app.acl.delete',
        'route' => ['admin.tasks.delete', 'admin.tasks.mass_delete'],
        'sort'  => 4,
    ], [
        'key'   => 'task.change-status',
        'name'  => 'admin::app.acl.change-status',
        'route' => ['admin.tasks.changeTaskStatus'],
        'sort'  => 5,
    ], [
        'key'   => 'task.comment',
        'name'  => 'admin::app.acl.comment',
        'route' => ['admin.tasks.getCommentByTaskId'],
        'sort'  => 6,
    ], [
        'key'   => 'task.comment.create',
        'name'  => 'admin::app.acl.create',
        'route' => ['admin.tasks.storeComment'],
        'sort'  => 1,
    ], [
        'key'   => 'task.comment.edit',
        'name'  => 'admin::app.acl.edit',
        'route' => ['admin.tasks.editComment', 'admin.tasks.updateComment'],
        'sort'  => 2,
    ], [
        'key'   => 'task.comment.delete',
        'name'  => 'admin::app.acl.delete',
        'route' => ['admin.tasks.deleteComment'],
        'sort'  => 3,
    ],
    [
        'key'   => 'my_task',
        'name'  => 'admin::app.acl.my-tasks',
        'route' => 'admin.my-tasks.index',
        'sort'  => 15,
    ], [
        'key'   => 'my_task.create',
        'name'  => 'admin::app.acl.create',
        'route' => ['admin.my-tasks.create', 'admin.my-tasks.store'],
        'sort'  => 1,
    ], [
        'key'   => 'my_task.view',
        'name'  => 'admin::app.acl.view',
        'route' => 'admin.my-tasks.view',
        'sort'  => 2,
    ], [
        'key'   => 'my_task.edit',
        'name'  => 'admin::app.acl.edit',
        'route' => ['admin.my-tasks.edit', 'admin.my-tasks.update', 'admin.my-tasks.mass_update'],
        'sort'  => 3,
    ], [
        'key'   => 'my_task.delete',
        'name'  => 'admin::app.acl.delete',
        'route' => ['admin.my-tasks.delete', 'admin.my-tasks.mass_delete'],
        'sort'  => 4,
    ], [
        'key'   => 'my_task.change-status',
        'name'  => 'admin::app.acl.change-status',
        'route' => ['admin.my-tasks.changeTaskStatus'],
        'sort'  => 5,
    ], 
    [
        'key'   => 'my_task.comment',
        'name'  => 'admin::app.acl.comment',
        'route' => ['admin.my-tasks.getCommentByTaskId'],
        'sort'  => 6,
    ], [
        'key'   => 'my_task.comment.create',
        'name'  => 'admin::app.acl.create',
        'route' => ['admin.my-tasks.storeComment'],
        'sort'  => 1,
    ], [
        'key'   => 'my_task.comment.edit',
        'name'  => 'admin::app.acl.edit',
        'route' => ['admin.my-tasks.editComment', 'admin.my-tasks.updateComment'],
        'sort'  => 2,
    ], [
        'key'   => 'my_task.comment.delete',
        'name'  => 'admin::app.acl.delete',
        'route' => ['admin.my-tasks.deleteComment'],
        'sort'  => 3,
    ],
];
