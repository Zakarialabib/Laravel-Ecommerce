<x-perfect-scrollbar as="nav" aria-label="main" class="flex flex-col flex-1 gap-4 px-3">

    <x-sidebar.link title="{{ __('Dashboard') }}" href="{{ route('admin.dashboard') }}" :isActive="request()->routeIs('home')">
        <x-slot name="icon">
            <span class="inline-block mr-3">
                <x-icons.dashboard class="w-5 h-5" aria-hidden="true" />
            </span>
        </x-slot>
    </x-sidebar.link>

    <x-sidebar.dropdown title="{{ __('Products') }}" :active="Str::startsWith(
        request()
            ->route()
            ->uri(),
        'Products',
    )">
        <x-slot name="icon">
            <span class="inline-block mr-3">
                <i class="fas fa-boxes w-5 h-5"></i>
            </span>
        </x-slot>
        @can('access_product_categories')
            <x-sidebar.sublink title="{{ __('Categories') }}" href="{{ route('admin.categories') }}"
                :active="request()->routeIs('admin.categories')" />
        @endcan
        
        @can('access_product_categories')
            <x-sidebar.sublink title="{{ __('SubCategories') }}" href="{{ route('admin.subcategories') }}"
                :active="request()->routeIs('admin.subcategories')" />
        @endcan

        <x-sidebar.sublink title="{{ __('All Products') }}" href="{{ route('admin.products') }}" :active="request()->routeIs('admin.products')" />
       
        @can('access_product_brands')
            <x-sidebar.sublink title="{{ __('Brands') }}" href="{{ route('admin.brands') }}" :active="request()->routeIs('admin.brands')" />
        @endcan
    
    </x-sidebar.dropdown>

    <x-sidebar.dropdown title="{{ __('Orders') }}" :active="Str::startsWith(
        request()
            ->route()
            ->uri(),
        'Orders',
    )">
        <x-slot name="icon">
            <span class="inline-block mr-3">
                <i class="fas fa-shopping-cart w-5 h-5"></i>
            </span>
        </x-slot>
        <x-sidebar.sublink title="{{ __('All Orders') }}" href="{{ route('admin.orders') }}" :active="request()->routeIs('admin.orders')" />
    </x-sidebar.dropdown>

    




    @can('access_user_management')
        <x-sidebar.dropdown title="{{ __('People') }}" :active="Str::startsWith(
            request()
                ->route()
                ->uri(),
            'people',
        )">
            <x-slot name="icon">
                <span class="inline-block mr-3">
                    <i class="fas fa-users w-5 h-5"></i>
                </span>
            </x-slot>
            @can('access_users')
                <x-sidebar.sublink title="{{ __('Users') }}" href="{{ route('admin.users') }}" :active="request()->routeIs('admin.users')" />
            @endcan
            @can('access_roles')
                <x-sidebar.sublink title="{{ __('Roles') }}" href="{{ route('admin.roles') }}" :active="request()->routeIs('admin.roles')" />
            @endcan
            @can('access_permissions')
                <x-sidebar.sublink title="{{ __('Permissions') }}" href="{{ route('admin.permissions') }}"
                    :active="request()->routeIs('admin.permissions')" />
            @endcan
        </x-sidebar.dropdown>
    @endcan
    @can('access_currencies|access_settings')
        <x-sidebar.dropdown title="{{ __('Settings') }}" :active="Str::startsWith(
            request()
                ->route()
                ->uri(),
            'Settings',
        )">
            <x-slot name="icon">
                <span class="inline-block mr-3">
                    <i class="fas fa-cog w-5 h-5"></i>
                </span>
            </x-slot>
            @can('access_currencies')
                <x-sidebar.sublink title="{{ __('Currencies') }}" href="{{ route('admin.currencies') }}" :active="request()->routeIs('admin.currencies')" />
            @endcan
            @can('access_settings')
                <x-sidebar.sublink title="{{ __('Settings') }}" href="{{ route('admin.settings') }}" :active="request()->routeIs('admin.settings')" />
            @endcan
        </x-sidebar.dropdown>
    @endcan

    <x-sidebar.link title="{{ __('Logout') }}"
        onclick="event.preventDefault();
                        document.getElementById('logoutform').submit();"
        href="#">
        <x-slot name="icon">
            <span class="inline-block mr-3">
                <i class="fas fa-sign-out-alt w-5 h-5" aria-hidden="true"></i>
            </span>
        </x-slot>
    </x-sidebar.link>

</x-perfect-scrollbar>
