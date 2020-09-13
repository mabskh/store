<div class="main-menu menu-fixed menu-light menu-accordion   " data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <li class="nav-item active">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="la la-mouse-pointer"></i>
                    <span class="menu-title" data-i18n="nav.add_on_drag_drop.main">الرئيسية </span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.maincategories') }}">
                    <i class="la la-group"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">الاقسام الرئيسيه </span>
                    <span class="badge badge badge-danger badge-pill float-right mr-2"> {{ \App\Models\Category::parent()->count() }}</span>
                </a>

                <ul class="menu-content">
                    <li class="menu-item">
                        <a class="menu-item" href="{{ route('admin.maincategories') }}" data-i18n="nav.dash.ecommerce"> عرض جميع الاقسام
                            <span class="badge badge badge-info badge-pill float-right mr-2"> {{ \App\Models\Category::parent()->count() }}</span>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a class="menu-item" href="{{ route('admin.maincategories.activeCategories') }}" data-i18n="nav.dash.ecommerce"> الاقسام المفعلة
                            <span class="badge badge badge-success badge-pill float-right mr-2"> {{ \App\Models\Category::parent()->where('is_active',1)->count() }}</span>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a class="menu-item" href="{{ route('admin.maincategories.create') }}" data-i18n="nav.dash.ecommerce"> إضافة قسم جديد
                            {{--<span class="badge badge badge-primary badge-pill float-right mr-2"> جديد</span>--}}
                        </a>
                    </li>

                </ul>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.subcategories') }}">
                    <i class="la la-group"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">الاقسام الفرعية </span>
                    <span class="badge badge badge-danger badge-pill float-right mr-2"> {{ \App\Models\Category::child()->count() }}</span>
                </a>

                <ul class="menu-content">
                    <li class="menu-item">
                        <a class="menu-item" href="{{ route('admin.subcategories') }}" data-i18n="nav.dash.ecommerce"> عرض الأقسام الفرعية
                            <span class="badge badge badge-info badge-pill float-right mr-2"> {{ \App\Models\Category::child()->count() }}</span>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a class="menu-item" href="{{ route('admin.subcategories.activeCategories') }}" data-i18n="nav.dash.ecommerce"> الاقسام المفعلة
                            <span class="badge badge badge-success badge-pill float-right mr-2"> {{ \App\Models\Category::child()->where('is_active',1)->count() }}</span>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a class="menu-item" href="{{ route('admin.subcategories.create') }}" data-i18n="nav.dash.ecommerce"> إضافة قسم جديد
                            {{--<span class="badge badge badge-primary badge-pill float-right mr-2"> جديد</span>--}}
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
