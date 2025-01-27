<aside class="app-sidebar sticky" id="sidebar">



    <!-- Start::main-sidebar-header -->
    <div class="main-sidebar-header">
        {{-- Check if the logo exists in the database --}}
        @php
            $setting = \App\Models\Setting::first(); // Assuming you have access to the Setting model
        @endphp
    
        {{-- Use the setting's logo path if available, otherwise fallback to default logo --}}
        @if ($setting && $setting->logo)
            <img src="{{ asset('uploads/logo/' . $setting->logo) }}" alt="logo" class="toggle-white" width="20%">
        @else
            <img src="{{ asset('backend/images/brand-logos/favicon.ico') }}" alt="logo" class="toggle-white" width="20%">
        @endif
    </div>
    
    

    <!-- Start::main-sidebar -->

    <div class="main-sidebar" id="sidebar-scroll">



        <!-- Start::nav -->

        <nav class="main-menu-container nav nav-pills flex-column sub-open">

            <div class="slide-left" id="slide-left">

                <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24"
                    viewBox="0 0 24 24">

                    <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path>

                </svg>

            </div>

            <ul class="main-menu">

                <!-- Start::slide__category -->

                <li class="slide__category"><span class="category-name">Main</span></li>

                <!-- End::slide__category -->



                <!-- Start::slide -->

                <li class="slide">

                    <a href="{{ route('dashboard') }}"
                        class="side-menu__item {{ request()->routeIs('dashboard') ? 'active' : '' }}">

                        <i class="bx bx-store-alt side-menu__icon"></i>

                        <span class="side-menu__label">Dashboard</span>

                    </a>

                </li>



                @php
                    $videoCategoryRoutes = [
                        'list.category',
                        'add.category',
                        'edit.category',
                        'video-category.index',
                        'video-category.create',
                        'video-category.edit',
                        'service.index',
                        'service.create',
                        'service.edit',
                        'difficulty.index',
                        'difficulty.create',
                        'difficulty.edit',
                        'tag.index',
                        'tag.create',
                        'tag.edit',
                        'ads.index',
                        'ads.create',
                        'ads.edit',
                        'sports.index',
                        'sports.create',
                        'sports.edit',
                    ];
                @endphp

                <li class="slide has-sub active  {{ request()->routeIs($videoCategoryRoutes) ? 'open' : '' }}">

                    <a href="javascript:void(0);" class="side-menu__item ">
                        <i class="bx bx-file-blank side-menu__icon"></i>
                        <span class="side-menu__label">Masters</span>
                        <i class="fe fe-chevron-right side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1 {{ request()->routeIs($videoCategoryRoutes) ? 'active' : '' }}">
                        <li class="slide side-menu__label1">
                            <a href="javascript:void(0)">Masters</a>
                        </li>

                        <li class="slide">
                            <a href="{{ route('list.category') }}"
                                class="side-menu__item {{ request()->routeIs('list.category') || request()->routeIs('add.category') || request()->routeIs('edit.category') ? 'active' : '' }}">Category
                                Master</a>
                        </li>

                        <li class="slide">

                            <a href="{{ route('video-category.index') }}"
                                class="side-menu__item {{ request()->routeIs('video-category.index') || request()->routeIs('video-category.create') || request()->routeIs('video-category.edit') ? 'active' : '' }}">Video

                                Category</a>

                        </li>

                        <li class="slide">
                            <a href="{{ route('service.index') }}"
                                class="side-menu__item {{ request()->routeIs('service.index') || request()->routeIs('service.create') || request()->routeIs('service.edit') ? 'active' : '' }}">Services
                            </a>
                        </li>

                        <li class="slide">
                            <a href="{{ route('difficulty.index') }}"
                                class="side-menu__item {{ request()->routeIs('difficulty.index') || request()->routeIs('difficulty.create') || request()->routeIs('difficulty.edit') ? 'active' : '' }}">Difficulties
                            </a>
                        </li>

                        <li class="slide">
                            <a href="{{ route('tag.index') }}"
                                class="side-menu__item {{ request()->routeIs('tag.index') || request()->routeIs('tag.create') || request()->routeIs('tag.edit') ? 'active' : '' }}">Tags
                            </a>
                        </li>

                        <li class="slide">
                            <a href="{{ route('ads.index') }}"
                                class="side-menu__item {{ request()->routeIs('ads.index') || request()->routeIs('ads.create') || request()->routeIs('ads.edit') ? 'active' : '' }}">Ads
                                {{-- <i class="ti ti-brand-tabler side-menu__icon"></i> --}}
                            </a>
                        </li>

                        <li class="slide">
                            <a href="{{ route('sports.index') }}"
                                class="side-menu__item {{ request()->routeIs('sports.index') || request()->routeIs('sports.create') || request()->routeIs('sports.edit') ? 'active' : '' }}">Sports
                            </a>
                        </li>

                    </ul>
                </li>

                @php
                    $userRoutes = [
                        'user.add',
                        'user.edit',
                        'user.index',
                        'user.create',
                        'user.visitor.index',
                        'user.visitor.create',
                        'user.visitor.store',
                        'user.visitor.show',
                        'user.visitor.edit',
                        'user.visitor.update',
                        'user.visitor.destroy',
                    ];
                @endphp

                <li class="slide has-sub active  {{ request()->routeIs($userRoutes) ? 'open' : '' }}">
                    <a href="javascript:void(0);" class="side-menu__item ">
                        <i class="bx bx-file-blank side-menu__icon"></i>
                        <span class="side-menu__label"> Users</span>
                        <i class="fe fe-chevron-right side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1 {{ request()->routeIs($userRoutes) ? 'active' : '' }}">
                        <li class="slide side-menu__label1">
                            <a href="javascript:void(0)">Profession Users
                            </a>
                        </li>
                        <li class="slide">
                            <a href="{{ route('user.index') }}"
                                class="side-menu__item {{ request()->routeIs('user.index') || request()->routeIs('user.create') || request()->routeIs('user.edit') ? 'active' : '' }}">
                                Professional Users

                            </a>
                        </li>

                        <li class="slide">
                            <a href="{{ route('user.visitor.index') }}"
                                class="side-menu__item {{ request()->routeIs('user.visitor.index') || request()->routeIs('user.visitor.create') || request()->routeIs('user.visitor.edit') ? 'active' : '' }}">
                                Visitor user
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="slide">
                    <a href="{{ route('videos.index') }}"
                        class="side-menu__item {{ request()->routeIs('videos.index') || request()->routeIs('videos.create') || request()->routeIs('videos.edit') ? 'active' : '' }}">
                        <i class="bx bi-camera-video-fill side-menu__icon"></i>
                        <span class="side-menu__label">Manage Videos</span>
                    </a>
                </li>

                <li class="slide">
                    <a href="{{ route('badge.index') }}"
                        class="side-menu__item {{ request()->routeIs('badge.index') || request()->routeIs('badge.create') || request()->routeIs('badge.edit') ? 'active' : '' }}">
                        <i class="las la-users side-menu__icon"></i>
                        <span class="side-menu__label">Manage Badge </span>
                    </a>
                </li>


                <li class="slide">

                    <a href="{{ route('subscriptions.index') }}"
                        class="side-menu__item {{ request()->routeIs('subscriptions.index') || request()->routeIs('subscriptions.create') || request()->routeIs('subscriptions.edit') ? 'active' : '' }}">

                        <i class="ti ti-brand-tabler side-menu__icon"></i>

                        <span class="side-menu__label">Subscriptions</span>

                    </a>

                </li>


                <li class="slide">

                    <a href="{{ route('news-letter.index') }}"
                        class="side-menu__item {{ request()->routeIs('news-letter.index') || request()->routeIs('news-letter.create') || request()->routeIs('news-letter.edit') ? 'active' : '' }}">

                        <i class="side-menu__icon las la-sort"></i>

                        <span class="side-menu__label">Newsletters</span>

                    </a>

                </li>


                @php
                    $userRoutes = [
                        'page.edit',
                        'page.index',
                        'page.create',
                        'homepage.index',
                        'homepage.show',
                        'homepage.edit',
                        'homepage.update',
                    ];
                @endphp

                <li class="slide has-sub active  {{ request()->routeIs($userRoutes) ? 'open' : '' }}">
                    <a href="javascript:void(0);"
                        class="side-menu__item {{ request()->routeIs($userRoutes) ? 'active' : '' }} ">
                        <i class="bx bx-file-blank side-menu__icon"></i>
                        <span class="side-menu__label"> Pages</span>
                        <i class="fe fe-chevron-right side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1 {{ request()->routeIs($userRoutes) ? 'active' : '' }}">
                        <li class="slide">
                            <a href="{{ route('page.index') }}"
                                class="side-menu__item {{ request()->routeIs('page.index') || request()->routeIs('page.create') || request()->routeIs('page.edit') ? 'active' : '' }}">
                                CMS Pages
                            </a>
                        </li>

                        <li class="slide">
                            <a href="{{ route('homepage.index') }}"
                                class="side-menu__item {{ request()->routeIs('homepage.index') || request()->routeIs('homepage.edit') ? 'active' : '' }}">
                                Homepage Banner
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- <li class="slide">

                    <a href="{{ route('module.index') }}"
                        class="side-menu__item {{ request()->routeIs('module.*') ? 'active' : '' }}">

                        <i class="bx bx-info-circle side-menu__icon"></i>

                        <span class="side-menu__label">Manage Access</span>

                    </a>

                </li> --}}
                <li class="slide">

                    <a href="{{ route('information.index') }}"
                        class="side-menu__item {{ request()->routeIs('information.index') ? 'active' : '' }}">

                        <i class="bx bx-info-circle side-menu__icon"></i>

                        <span class="side-menu__label">Getin Touch</span>

                    </a>

                </li>


                {{-- <li class="slide">
                    <a href="{{ route('user.index') }}"
                        class="side-menu__item {{ request()->routeIs('user.index') || request()->routeIs('user.create') || request()->routeIs('user.edit') ? 'active' : '' }}">
                        <i class="bx bi-people  side-menu__icon"></i>
                        <span class="side-menu__label">Manage Users</span>
                    </a>
                </li> --}}



                <li class="slide">
                    <a href="{{ route('client.index') }}"
                        class="side-menu__item {{ request()->routeIs('client.index') || request()->routeIs('client.create') || request()->routeIs('client.edit') ? 'active' : '' }}">
                        {{-- <i class="bx bx-cog side-menu__icon"></i> --}}
                        <i class="las la-users side-menu__icon"></i>
                        <span class="side-menu__label">Our Clients</span>
                    </a>
                </li>


                <li class="slide">
                    <a href="{{ route('setting.index') }}"
                        class="side-menu__item {{ request()->routeIs('setting.index') || request()->routeIs('setting.create') || request()->routeIs('setting.edit') ? 'active' : '' }}">

                        {{-- <i class="bx bi-camera-video-fill side-menu__icon"></i> --}}

                        {{-- <i class="bx bi-settings-2-line side-menu__icon"></i> --}}

                        <i class="bx bx-cog side-menu__icon"></i>

                        <span class="side-menu__label">Settings</span>
                    </a>
                </li>

                {{-- <li class="slide">
                    <a href="{{ route('badge.index') }}"
                        class="side-menu__item {{ request()->routeIs('badge.index') || request()->routeIs('badge.create') || request()->routeIs('badge.edit') ? 'active' : '' }}">
                        <i class="las la-users side-menu__icon"></i>
                        <span class="side-menu__label">Manage Badge </span>
                    </a>
                </li> --}}

                <li class="slide">

                    <a href="{{ route('logout') }}"
                        class="side-menu__item {{ request()->routeIs('logout') ? 'active' : '' }}">

                        <i class="ti ti-logout fs-18 me-2 op-7"></i>

                        <span class="side-menu__label">Logout</span>

                    </a>

                </li>





            </ul>

            <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191"
                    width="24" height="24" viewBox="0 0 24 24">

                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path>

                </svg></div>

        </nav>

        <!-- End::nav -->



    </div>

    <!-- End::main-sidebar -->



</aside>
