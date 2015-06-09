<div id="sidebar" class="sidebar">
    <!-- begin sidebar scrollbar -->
    <div style="position: relative; overflow: hidden; width: auto; height: 100%;" class="slimScrollDiv"><div style="overflow: hidden; width: auto; height: 100%;" data-scrollbar="true" data-height="100%">
            <!-- begin sidebar user -->
            @include('admin::_partials.side_bar.user')
            <!-- end sidebar user -->
            <!-- begin sidebar nav -->
            <ul class="nav">
                @foreach ($menu as $item)
                    @if ($item->isSeparator() == true)
                        <li><hr></li>
                    @else
                        {!! $item->render() !!}
                    @endif
                @endforeach
            </ul>
            <!-- end sidebar nav -->
        </div><div style="background: rgb(0, 0, 0) none repeat scroll 0% 0%; width: 7px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 898px;" class="slimScrollBar ui-draggable"></div><div style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51) none repeat scroll 0% 0%; opacity: 0.2; z-index: 90; right: 1px;" class="slimScrollRail"></div></div>
    <!-- end sidebar scrollbar -->
</div>


{{--
                <li class="has-sub active">
                    <a href="javascript:;">
                        <b class="caret pull-right"></b>
                        <i class="fa fa-laptop"></i>
                        <span>Dashboard</span>
                    </a>
                    <ul class="sub-menu">
                        <li class="active"><a href="index.html">Dashboard v1</a></li>
                        <li><a href="index_v2.html">Dashboard v2</a></li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a href="javascript:;">
                        <span class="badge pull-right">10</span>
                        <i class="fa fa-inbox"></i>
                        <span>Email</span>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="email_inbox.html">Inbox v1</a></li>
                        <li><a href="email_inbox_v2.html">Inbox v2</a></li>
                        <li><a href="email_compose.html">Compose</a></li>
                        <li><a href="email_detail.html">Detail</a></li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a href="javascript:;">
                        <b class="caret pull-right"></b>
                        <i class="fa fa-suitcase"></i>
                        <span>UI Elements <span class="label label-theme m-l-5">NEW</span></span>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="ui_general.html">General</a></li>
                        <li><a href="ui_typography.html">Typography</a></li>
                        <li><a href="ui_tabs_accordions.html">Tabs &amp; Accordions</a></li>
                        <li><a href="ui_unlimited_tabs.html">Unlimited Nav Tabs</a></li>
                        <li><a href="ui_modal_notification.html">Modal &amp; Notification</a></li>
                        <li><a href="ui_widget_boxes.html">Widget Boxes</a></li>
                        <li><a href="ui_media_object.html">Media Object</a></li>
                        <li><a href="ui_buttons.html">Buttons</a></li>
                        <li><a href="ui_icons.html">Icons</a></li>
                        <li><a href="ui_simple_line_icons.html">Simple Line Icons</a></li>
                        <li><a href="ui_ionicons.html">Ionicons</a></li>
                        <li><a href="ui_tree.html">Tree View <i class="fa fa-paper-plane text-theme m-l-5"></i></a></li>
                        <li><a href="ui_language_bar_icon.html">Language Bar &amp; Icon <i class="fa fa-paper-plane text-theme m-l-5"></i></a></li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a href="javascript:;">
                        <b class="caret pull-right"></b>
                        <i class="fa fa-file-o"></i>
                        <span>Form Stuff <span class="label label-theme m-l-5">NEW</span></span>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="form_elements.html">Form Elements</a></li>
                        <li><a href="form_plugins.html">Form Plugins <i class="fa fa-paper-plane text-theme"></i></a></li>
                        <li><a href="form_slider_switcher.html">Form Slider + Switcher</a></li>
                        <li><a href="form_validation.html">Form Validation</a></li>
                        <li><a href="form_wizards.html">Wizards</a></li>
                        <li><a href="form_wizards_validation.html">Wizards + Validation</a></li>
                        <li><a href="form_wysiwyg.html">WYSIWYG</a></li>
                        <li><a href="form_editable.html">X-Editable</a></li>
                        <li><a href="form_multiple_upload.html">Multiple File Upload</a></li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a href="javascript:;">
                        <b class="caret pull-right"></b>
                        <i class="fa fa-th"></i>
                        <span>Tables</span>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="table_basic.html">Basic Tables</a></li>
                        <li class="has-sub">
                            <a href="javascript:;"><b class="caret pull-right"></b> Managed Tables</a>
                            <ul class="sub-menu">
                                <li><a href="table_manage.html">Default</a></li>
                                <li><a href="table_manage_autofill.html">Autofill</a></li>
                                <li><a href="table_manage_colreorder.html">ColReorder</a></li>
                                <li><a href="table_manage_colvis.html">ColVis</a></li>
                                <li><a href="table_manage_fixed_columns.html">Fixed Column</a></li>
                                <li><a href="table_manage_fixed_header.html">Fixed Header</a></li>
                                <li><a href="table_manage_keytable.html">KeyTable</a></li>
                                <li><a href="table_manage_responsive.html">Responsive</a></li>
                                <li><a href="table_manage_scroller.html">Scroller</a></li>
                                <li><a href="table_manage_tabletools.html">TableTools</a></li>
                                <li><a href="table_manage_combine.html">Extension Combination</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a href="javascript:;">
                        <b class="caret pull-right"></b>
                        <i class="fa fa-star"></i>
                        <span>Front End</span>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="../../frontend/one-page-parallax/index.html" target="_blank">One Page Parallax</a></li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a href="javascript:;">
                        <b class="caret pull-right"></b>
                        <i class="fa fa-envelope"></i>
                        <span>Email Template</span>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="email_system.html">System Template</a></li>
                        <li><a href="email_newsletter.html">Newsletter Template</a></li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a href="javascript:;">
                        <b class="caret pull-right"></b>
                        <i class="fa fa-area-chart"></i>
                        <span>Chart</span>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="chart-flot.html">Flot Chart</a></li>
                        <li><a href="chart-morris.html">Morris Chart</a></li>
                        <li><a href="chart-js.html">Chart JS</a></li>
                    </ul>
                </li>
                <li><a href="calendar.html"><i class="fa fa-calendar"></i> <span>Calendar</span></a></li>
                <li class="has-sub">
                    <a href="javascript:;">
                        <b class="caret pull-right"></b>
                        <i class="fa fa-map-marker"></i>
                        <span>Map</span>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="map_vector.html">Vector Map</a></li>
                        <li><a href="map_google.html">Google Map</a></li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a href="javascript:;">
                        <b class="caret pull-right"></b>
                        <i class="fa fa-camera"></i>
                        <span>Gallery</span>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="gallery.html">Gallery v1</a></li>
                        <li><a href="gallery_v2.html">Gallery v2</a></li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a href="javascript:;">
                        <b class="caret pull-right"></b>
                        <i class="fa fa-cogs"></i>
                        <span>Page Options <span class="label label-theme m-l-5">NEW</span></span>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="page_blank.html">Blank Page</a></li>
                        <li><a href="page_with_footer.html">Page with Footer</a></li>
                        <li><a href="page_without_sidebar.html">Page without Sidebar</a></li>
                        <li><a href="page_with_right_sidebar.html">Page with Right Sidebar</a></li>
                        <li><a href="page_with_minified_sidebar.html">Page with Minified Sidebar</a></li>
                        <li><a href="page_with_two_sidebar.html">Page with Two Sidebar</a></li>
                        <li><a href="page_with_line_icons.html">Page with Line Icons</a></li>
                        <li><a href="page_with_ionicons.html">Page with Ionicons</a></li>
                        <li><a href="page_full_height.html">Full Height Content</a></li>
                        <li><a href="page_with_wide_sidebar.html">Page with Wide Sidebar <i class="fa fa-paper-plane text-theme"></i></a></li>
                        <li><a href="page_with_light_sidebar.html">Page with Light Sidebar <i class="fa fa-paper-plane text-theme"></i></a></li>
                        <li><a href="page_with_mega_menu.html">Page with Mega Menu <i class="fa fa-paper-plane text-theme"></i></a></li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a href="javascript:;">
                        <b class="caret pull-right"></b>
                        <i class="fa fa-gift"></i>
                        <span>Extra <span class="label label-theme m-l-5">NEW</span></span>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="extra_timeline.html">Timeline</a></li>
                        <li><a href="extra_coming_soon.html">Coming Soon Page</a></li>
                        <li><a href="extra_search_results.html">Search Results</a></li>
                        <li><a href="extra_invoice.html">Invoice</a></li>
                        <li><a href="extra_404_error.html">404 Error Page</a></li>
                        <li><a href="extra_profile.html">Profile Page <i class="fa fa-paper-plane text-theme"></i></a></li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a href="javascript:;">
                        <b class="caret pull-right"></b>
                        <i class="fa fa-key"></i>
                        <span>Login &amp; Register <span class="label label-theme m-l-5">NEW</span></span>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="login.html">Login</a></li>
                        <li><a href="login_v2.html">Login v2</a></li>
                        <li><a href="login_v3.html">Login v3 <i class="fa fa-paper-plane text-theme"></i></a></li>
                        <li><a href="register_v3.html">Register v3 <i class="fa fa-paper-plane text-theme"></i></a></li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a href="javascript:;">
                        <b class="caret pull-right"></b>
                        <i class="fa fa-cubes"></i>
                        <span>Version</span>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="javascript:;">HTML</a></li>
                        <li><a href="../template_content_ajax/index.html">AJAX</a></li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a href="javascript:;">
                        <b class="caret pull-right"></b>
                        <i class="fa fa-medkit"></i>
                        <span>Helper</span>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="helper_css.html">Predefined CSS Classes</a></li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a href="javascript:;">
                        <b class="caret pull-right"></b>
                        <i class="fa fa-align-left"></i>
                        <span>Menu Level</span>
                    </a>
                    <ul class="sub-menu">
                        <li class="has-sub">
                            <a href="javascript:;">
                                <b class="caret pull-right"></b>
                                Menu 1.1
                            </a>
                            <ul class="sub-menu">
                                <li class="has-sub">
                                    <a href="javascript:;">
                                        <b class="caret pull-right"></b>
                                        Menu 2.1
                                    </a>
                                    <ul class="sub-menu">
                                        <li><a href="javascript:;">Menu 3.1</a></li>
                                        <li><a href="javascript:;">Menu 3.2</a></li>
                                    </ul>
                                </li>
                                <li><a href="javascript:;">Menu 2.2</a></li>
                                <li><a href="javascript:;">Menu 2.3</a></li>
                            </ul>
                        </li>
                        <li><a href="javascript:;">Menu 1.2</a></li>
                        <li><a href="javascript:;">Menu 1.3</a></li>
                    </ul>
                </li>
                <!-- begin sidebar minify button -->
                <li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
                <!-- end sidebar minify button -->
--}}