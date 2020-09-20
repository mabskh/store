<div class="main-menu menu-fixed menu-light menu-accordion   " data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <li class="nav-item active">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="la la-mouse-pointer"></i>
                    <span class="menu-title" data-i18n="nav.add_on_drag_drop.main">{{__('admin/sidebar.dashboard')}} </span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.categories') }}">
                    <i class="la la-th-list"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">الأقسام</span>
                    <span class="badge badge badge-danger badge-pill float-right mr-2"> {{ \App\Models\Category::count() }}</span>
                </a>

                <ul class="menu-content">
                    <li class="menu-item">

                        <a class="menu-item" href="{{ route('admin.categories') }}" data-i18n="nav.dash.ecommerce">  <span>جميع الاقسام</span>
                            <span class="badge badge badge-info badge-pill float-right mr-2"> {{ \App\Models\Category::count() }}</span>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a class="menu-item" href="{{ route('admin.categories.create') }}" data-i18n="nav.dash.ecommerce">اضافة قسم جديد
                            {{--<span class="badge badge badge-primary badge-pill float-right mr-2"> جديد</span>--}}
                        </a>
                    </li>

                </ul>
            </li>

           {{-- <li class="nav-item">
                <a href="{{ route('admin.maincategories') }}">
                    <i class="la la-th-list"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">{{__('admin/sidebar.main_categories')}} </span>
                    <span class="badge badge badge-danger badge-pill float-right mr-2"> {{ \App\Models\Category::parent()->count() }}</span>
                </a>

                <ul class="menu-content">
                    <li class="menu-item">

                        <a class="menu-item" href="{{ route('admin.maincategories') }}" data-i18n="nav.dash.ecommerce">  <span>{{__('admin/sidebar.categories_list')}}</span>
                            <span class="badge badge badge-info badge-pill float-right mr-2"> {{ \App\Models\Category::parent()->count() }}</span>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a class="menu-item" href="{{ route('admin.maincategories.activeCategories') }}" data-i18n="nav.dash.ecommerce"> {{__('admin/sidebar.categories_active')}}
                            <span class="badge badge badge-success badge-pill float-right mr-2"> {{ \App\Models\Category::parent()->where('is_active',1)->count() }}</span>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a class="menu-item" href="{{ route('admin.maincategories.create') }}" data-i18n="nav.dash.ecommerce"> {{__('admin/sidebar.add_new')}}
                            <span class="badge badge badge-primary badge-pill float-right mr-2"> جديد</span>
                        </a>
                    </li>

                </ul>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.subcategories') }}">
                    <i class="la la-list-alt"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">{{__('admin/sidebar.sub_categories')}} </span>
                    <span class="badge badge badge-danger badge-pill float-right mr-2"> {{ \App\Models\Category::child()->count() }}</span>
                </a>

                <ul class="menu-content">
                    <li class="menu-item">
                        <a class="menu-item" href="{{ route('admin.subcategories') }}" data-i18n="nav.dash.ecommerce"> {{__('admin/sidebar.subcategories_list')}}
                            <span class="badge badge badge-info badge-pill float-right mr-2"> {{ \App\Models\Category::child()->count() }}</span>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a class="menu-item" href="{{ route('admin.subcategories.activeCategories') }}" data-i18n="nav.dash.ecommerce">  {{__('admin/sidebar.subcategories_active')}}
                            <span class="badge badge badge-success badge-pill float-right mr-2"> {{ \App\Models\Category::child()->where('is_active',1)->count() }}</span>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a class="menu-item" href="{{ route('admin.subcategories.create') }}" data-i18n="nav.dash.ecommerce"> {{__('admin/sidebar.add_new')}}
                            <span class="badge badge badge-primary badge-pill float-right mr-2"> جديد</span>
                        </a>
                    </li>

                </ul>
            </li>--}}

            <li class="nav-item">
                <a href="{{ route('admin.brands') }}">
                    <i class="la la-trademark"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">{{__('admin/sidebar.brands')}}  </span>
                    <span class="badge badge badge-danger badge-pill float-right mr-2"> {{ \App\Models\Brand::count() }}</span>
                </a>

                <ul class="menu-content">
                    <li class="menu-item">
                        <a class="menu-item" href="{{ route('admin.brands') }}" data-i18n="nav.dash.ecommerce"> {{__('admin/sidebar.brands_list')}}
                            <span class="badge badge badge-info badge-pill float-right mr-2"> {{ \App\Models\Brand::count() }}</span>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a class="menu-item" href="{{ route('admin.brands.active') }}" data-i18n="nav.dash.ecommerce"> {{__('admin/sidebar.brands_active')}}
                            <span class="badge badge badge-success badge-pill float-right mr-2"> {{ \App\Models\Brand::where('is_active',1)->count() }}</span>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a class="menu-item" href="{{ route('admin.brands.create') }}" data-i18n="nav.dash.ecommerce"> {{__('admin/sidebar.add_new')}}
                            <span class="badge badge badge-primary badge-pill float-right mr-2"> Brand</span>
                        </a>
                    </li>

                </ul>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.tags') }}">
                    <i class="la la-tags"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">{{__('admin/sidebar.tags')}} </span>
                    <span class="badge badge badge-danger badge-pill float-right mr-2"> {{ \App\Models\Tag::count() }}</span>
                </a>


                <ul class="menu-content">
                    <li class="menu-item">
                        <a class="menu-item" href="{{ route('admin.tags') }}" data-i18n="nav.dash.ecommerce">{{__('admin/sidebar.tags_list')}}
                            <span class="badge badge badge-info badge-pill float-right mr-2"> {{ \App\Models\Tag::count() }}</span>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a class="menu-item" href="{{ route('admin.brands.active') }}" data-i18n="nav.dash.ecommerce"> العلامات المفعلة
                            <span class="badge badge badge-success badge-pill float-right mr-2"> {{ \App\Models\Brand::where('is_active',1)->count() }}</span>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a class="menu-item" href="{{ route('admin.tags.create') }}" data-i18n="nav.dash.ecommerce"> {{__('admin/sidebar.add_new')}}
                            <span class="badge badge badge-primary badge-pill float-right mr-2"> Tag</span>
                        </a>
                    </li>

                </ul>
            </li>


            <li class=" nav-item">
                <a href="#">
                    <i class="la la-television"></i>
                    <span class="menu-title"data-i18n="nav.templates.main"> {{__('admin/sidebar.settings')}} </span>
                </a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="#" data-i18n="nav.templates.vert.main">{{__('admin/sidebar.shipping methods')}}</a>
                        <ul class="menu-content">
                            <li><a class="menu-item" href="{{ route('edit.shippings.methods','free') }}"
                                   data-i18n="nav.templates.vert.classic_menu">{{__('admin/sidebar.free shipping')}}</a>
                            </li>

                            <li><a class="menu-item" href="{{ route('edit.shippings.methods','inner') }}"
                                   data-i18n="nav.templates.vert.compact_menu">{{__('admin/sidebar.inner shipping')}}</a>
                            </li>
                            <li><a class="menu-item" href="{{ route('edit.shippings.methods','outer') }}"
                                   data-i18n="nav.templates.vert.content_menu">{{__('admin/sidebar.outer shipping')}}</a>
                            </li>

                        </ul>
                    </li>

                </ul>
            </li>

           {{-- <li class="nav-item">

                <a href=""><i class="la la-group"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">الاقسام الرئيسيه </span>
                    <span
                        class="badge badge badge-danger badge-pill float-right mr-2"></span>
                </a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="#" data-i18n="nav.templates.vert.main">{{__('admin/sidebar.shipping methods')}}</a>
                        <ul class="menu-content">
                            <li><a class="menu-item" href="{{ route('edit.shippings.methods','free') }}"
                                   data-i18n="nav.templates.vert.classic_menu">{{__('admin/sidebar.free shipping')}}</a>
                            </li>

                            <li><a class="menu-item" href="{{ route('edit.shippings.methods','inner') }}"
                                   data-i18n="nav.templates.vert.compact_menu">{{__('admin/sidebar.inner shipping')}}</a>
                            </li>
                            <li><a class="menu-item" href="{{ route('edit.shippings.methods','outer') }}"
                                   data-i18n="nav.templates.vert.content_menu">{{__('admin/sidebar.outer shipping')}}</a>
                            </li>
                        </ul>
                    </li>

                    <li><a class="menu-item" href="#" data-i18n="nav.templates.horz.main">Horizontal</a>
                        <ul class="menu-content">
                            <li><a class="menu-item" href="../horizontal-menu-template"
                                   data-i18n="nav.templates.horz.classic">Classic</a>
                            </li>
                            <li><a class="menu-item" href="../horizontal-menu-template-nav"
                                   data-i18n="nav.templates.horz.top_icon">Full Width</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>--}}

        </ul>
    </div>
</div>
