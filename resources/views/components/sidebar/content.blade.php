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
        @can('category_access')
            <x-sidebar.sublink title="{{ __('Categories') }}" href="{{ route('admin.categories') }}"
                :active="request()->routeIs('admin.categories')" />
        @endcan
        
        @can('subcategory_access')
            <x-sidebar.sublink title="{{ __('SubCategories') }}" href="{{ route('admin.subcategories') }}"
                :active="request()->routeIs('admin.subcategories')" />
        @endcan

        <x-sidebar.sublink title="{{ __('All Products') }}" href="{{ route('admin.products') }}" :active="request()->routeIs('admin.products')" />
       
        @can('brand_access')
            <x-sidebar.sublink title="{{ __('Brands') }}" href="{{ route('admin.brands') }}" :active="request()->routeIs('admin.brands')" />
        @endcan
    
    </x-sidebar.dropdown>

    <x-sidebar.dropdown title="{{ __('Orders') }}" :active="Str::startsWith(
        request()
            ->route()
            ->uri(),
        'admin.orders',
    )">
        <x-slot name="icon">
            <span class="inline-block mr-3">
                <i class="fas fa-shopping-cart w-5 h-5"></i>
            </span>
        </x-slot>
        @can('order_access')
        <x-sidebar.sublink title="{{ __('All Orders') }}" href="{{ route('admin.orders') }}" :active="request()->routeIs('admin.orders')" />
        <x-sidebar.sublink title="{{ __('Order Forms') }}" href="{{ route('admin.orderforms') }}" :active="request()->routeIs('admin.orderforms')" />
        @endcan
    </x-sidebar.dropdown>
    
    <x-sidebar.dropdown title="{{('Blog')}}" :active="Str::startsWith(
        request()
            ->route()
            ->uri(),
        'Blog',
    )">
        <x-slot name="icon">
            <span class="inline-block mr-3">
                <i class="fas fa-blog w-5 h-5"></i>
            </span>
        </x-slot>
        @can('blog_access')
        <x-sidebar.sublink title="{{ __('All Blog') }}" href="{{ route('admin.blogs') }}" :active="request()->routeIs('admin.blogs')" />
        <x-sidebar.sublink title="{{ __('Blog Settings') }}" href="{{ route('admin.blog.settings') }}" :active="request()->routeIs('admin.blog.settings')" />
        <x-sidebar.sublink title="{{ __('Blog Categories') }}" href="{{ route('admin.blogcategories') }}" :active="request()->routeIs('admin.blogcategories')" />
        @endcan
    </x-sidebar.dropdown>
{{-- Settings --}}

    @can('user_access')
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
            @can('user_access')
                <x-sidebar.sublink title="{{ __('Users') }}" href="{{ route('admin.users') }}" :active="request()->routeIs('admin.users')" />
            @endcan
            @can('role_access') 
                <x-sidebar.sublink title="{{ __('Roles') }}" href="{{ route('admin.roles') }}" :active="request()->routeIs('admin.roles')" />
            @endcan
            @can('permission_access')
                <x-sidebar.sublink title="{{ __('Permissions') }}" href="{{ route('admin.permissions') }}"
                    :active="request()->routeIs('admin.permissions')" />
            @endcan
        </x-sidebar.dropdown>
    @endcan

    <x-sidebar.dropdown title="{{ __('Pages Settings') }}" :active="Str::startsWith( request()->route()->uri(), 'pages', )">
        <x-slot name="icon">
            <span class="inline-block mr-3">
                <i class="fas fa-file-alt w-5 h-5"></i>
            </span>
        </x-slot>
        <x-sidebar.sublink title="{{ __('Pages') }}" href="{{ route('admin.pages') }}" :active="request()->routeIs('admin.pages')" />
        <x-sidebar.sublink title="{{ __('Sections') }}" href="{{ route('admin.sections') }}" :active="request()->routeIs('admin.sections')" />
        <x-sidebar.sublink title="{{ __('Sliders') }}" href="{{ route('admin.sliders') }}" :active="request()->routeIs('admin.sliders')" />
        <x-sidebar.sublink title="{{ __('Featured Banners') }}" href="{{ route('admin.featuredBanners') }}" :active="request()->routeIs('admin.featuredBanners')" />
        
        <x-sidebar.sublink title="{{ __('Contact Us Page') }}" href="{{ route('admin.page.contact') }}" :active="request()->routeIs('admin.page.contact')" />
        <x-sidebar.sublink title="{{ __('Site Content') }}" href="{{ route('admin.setting.content') }}" :active="request()->routeIs('admin.setting.content')" />
        <x-sidebar.sublink title="{{ __('Home Page Customization') }}" href="{{ route('admin.setting.customize') }}" :active="request()->routeIs('admin.setting.customize')" />
        <x-sidebar.sublink title="{{ __('Customize Menu Links') }}" href="{{ route('admin.page.menulinks') }}" :active="request()->routeIs('admin.page.menulinks')" />
    </x-sidebar.dropdown>

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
            @can('setting_access')
            <x-sidebar.sublink title="{{ __('Settings') }}" href="{{ route('admin.settings') }}" :active="request()->routeIs('admin.settings')" />
            @endcan
            <x-sidebar.sublink title="{{ __('Shipping') }}" href="{{ route('admin.setting.shipping') }}" :active="request()->routeIs('admin.setting.shipping')" />

        </x-sidebar.dropdown>


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
