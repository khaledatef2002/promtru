<?php

namespace App\Enum;

enum PermissionsType: string
{
    // website settings
    case website_settings_show = 'website_settings_show';
    case website_settings_edit = 'website_settings_edit';

    // services
    case services_show = 'services_show';
    case services_edit = 'services_edit';
    case services_delete = 'services_delete';
    case services_create = 'services_create';

    // blogs
    case blogs_show = 'blogs_show';
    case blogs_edit = 'blogs_edit';
    case blogs_delete = 'blogs_delete';
    case blogs_create = 'blogs_create';

    // partners
    case partners_show = 'partners_show';
    case partners_edit = 'partners_edit';
    case partners_delete = 'partners_delete';
    case partners_create = 'partners_create';

    // users
    case users_show = 'users_show';
    case users_edit = 'users_edit';
    case users_delete = 'users_delete';
    case users_create = 'users_create';

    // roles
    case roles_show = 'roles_show';
    case roles_edit = 'roles_edit';
    case roles_delete = 'roles_delete';
    case roles_create = 'roles_create';

    // Contact us
    case contact_us_show = 'contact_us_show';
    case contact_us_action = 'contact_us_action';
    case contact_us_delete = 'contact_us_delete';
}
