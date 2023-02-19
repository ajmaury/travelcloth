<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <!-- Dashboard -->
                <li class="{{ (request()->is('admin/dashboard*')) ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('dashboard') }}" aria-expanded="false">
                        <i data-feather="book-open"></i>
                        <span>
                            Dashboard
                        </span>
                    </a>
                </li>
                <!-- /Dashboard -->

                <!-- CMS 
                @if(auth()->user()->can('cmspage-list') || auth()->user()->can('cmscategory-list'))
                    <li class="submenu">
                        <a class="" href="javascript:void(0)" aria-expanded="false">
                            <i class="fa fa-file-text"></i>
                            <span class="hide-menu">CMS</span>
                            <span class="menu-arrow"></span>
                        </a>

                        <ul style="display: none;">
                            @can('cmscategory-list')
                                <li>
                                    <a href="{{ route('cmscategories.index') }}" title="{{__('sidebar.category')}}" class="sidebar-link {{ (request()->is('admin/cmscategories*')) ? 'active' : '' }}">
                                        <span class="hide-menu">Category</span>
                                    </a>
                                </li>
                            @endcan

                            @can('cmspage-list')
                                <li>
                                    <a href="{{ route('cmspages.index') }}" title="{{__('sidebar.cms-pages')}}" class="sidebar-link {{ (request()->is('admin/cmspage*')) ? 'active' : '' }}">
                                        <span class="hide-menu">CMS Pages</span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endif
                 /CMS -->

                 @if(auth()->user()->can('customer-list') || auth()->user()->can('associate-list') || auth()->user()->can('partneragent-list') || 
                 auth()->user()->can('hotelpartner-list'))
                 <li class="submenu">
                     <a class="" href="javascript:void(0)" aria-expanded="false">
                         <i class="fa fa-users"></i>
                         <span class="hide-menu">Users </span>
                         <span class="menu-arrow"></span>
                     </a>
 
                     <ul style="display: none;">
                         @can('customer-list')
                         <li>
                             <a href="{{ route('customer.index') }}" title="Customer Master"
                                 class="sidebar-link {{ (request()->is('admin/customer*')) ? 'active' : '' }}">
                                 <span class="hide-menu">Customer Master</span>
                             </a>
                         </li>
                         @endcan
 
                         @can('associate-list')
                         <li>
                             <a href="{{ route('associate.index') }}" title="Associate Master"
                                 class="sidebar-link {{ (request()->is('admin/associate*')) ? 'active' : '' }}">
                                 <span class="hide-menu">Associate Master</span>
                             </a>
                         </li>
                         @endcan
 
                         @can('partneragent-list')
                         <li>
                             <a href="{{ route('partneragent.index') }}" title="Partner Agent Master"
                                 class="sidebar-link {{ (request()->is('admin/partneragent*')) ? 'active' : '' }}">
                                 <span class="hide-menu">Partner Agent Master</span>
                             </a>
                         </li>
                         @endcan
 
                         @can('hotelpartner-list')
                         <li>
                             <a href="{{ route('hotelpartner.index') }}" title="Hotel Partner Master"
                                 class="sidebar-link {{ (request()->is('admin/hotelpartner*')) ? 'active' : '' }}">
                                 <span class="hide-menu">Hotel Partner Master</span>
                             </a>
                         </li>
                         @endcan
 
                     </ul>
                 </li>
                 @endif
                <!-- Logistic -->
                @can('logistic-list')
                <li class="{{ (request()->is('admin/logistic*')) ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('logistic.index') }}" aria-expanded="false">
                        <i class="fas fa-truck"></i>
                        <span>
                            Logistic
                        </span>
                    </a>
                </li>
                @endcan
                <!-- /logistic -->
                <!--location-->
                @if(auth()->user()->can('state-list') || auth()->user()->can('zone-list') ||
                 auth()->user()->can('city-list'))
                 <li class="submenu">
                     <a class="" href="javascript:void(0)" aria-expanded="false">
                         <i class="fa fa-map"></i>
                         <span class="hide-menu">Location </span>
                         <span class="menu-arrow"></span>
                     </a>
 
                     <ul style="display: none;">
                         @can('country-list')
                         <li>
                             <a href="{{ route('country.index') }}" title="State"
                                 class="sidebar-link {{ (request()->is('admin/country*')) ? 'active' : '' }}">
                                 <span class="hide-menu">Country</span>
                             </a>
                         </li>
                         @endcan
                         
                         @can('state-list')
                         <li>
                             <a href="{{ route('states.index') }}" title="State"
                                 class="sidebar-link {{ (request()->is('admin/states*')) ? 'active' : '' }}">
                                 <span class="hide-menu">State</span>
                             </a>
                         </li>
                         @endcan
 
 
                         @can('city-list')
                         <li>
                             <a href="{{ route('citys.index') }}" title="City"
                                 class="sidebar-link {{ (request()->is('admin/citys*')) ? 'active' : '' }}">
                                 <span class="hide-menu">City</span>
                             </a>
                         </li>
                         @endcan
                         @can('pincode-list')
                         <li>
                             <a href="{{ route('pincode.index') }}" title="Pincode"
                                 class="sidebar-link {{ (request()->is('admin/pincode*')) ? 'active' : '' }}">
                                 <span class="hide-menu">Pincode</span>
                             </a>
                         </li>
                         @endcan
                     </ul>
                 </li>
                 @endif
                <!--/location-->
                <!-- Pricing -->
                @can('pricing-list')
                <li class="{{ (request()->is('admin/price*')) ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('price.index') }}" aria-expanded="false">
                        <i class="fas fa-rupee-sign"></i>
                        <span>
                            Pricing
                        </span>
                    </a>
                </li>
                @endcan
                <!-- /Pricing -->
                <!-- Quote -->
                @can('quotes')
                <li class="{{ (request()->is('admin/quotes*')) ? 'active1' : '' }}">
                    <a class="sidebar-link" href="{{ route('quotes') }}" aria-expanded="false">
                        <i class="fas fa-edit"></i>
                        <span>
                            Quotes
                        </span>
                    </a>
                </li>
                @endcan
                <!-- /Quote -->
                <!-- Order Management -->
                <li class="{{ (request()->is('admin/dashboard*')) ? 'active1' : '' }}">
                    <a class="sidebar-link" href="#" aria-expanded="false">
                        <i class="fab fa-first-order"></i>
                        <span>
                            Order Management
                        </span>
                    </a>
                </li>
                <!-- /Order Management -->
                <!-- Coupon -->
                <li class="submenu">
                    <a class="" href="javascript:void(0)" aria-expanded="false">
                        <i class="fa fa-tag"></i>
                        <span class="hide-menu">Coupon</span>
                        <span class="menu-arrow"></span>
                    </a>

                    <ul style="display: none;">
                        <li>
                            <a href="#" title="Website Setting"
                                class="sidebar-link {{ (request()->is('admin/setting/website-setting*')) ? 'active' : '' }}">
                                <span class="hide-menu">Customer</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" title="File Manager"
                                class="sidebar-link {{ (request()->is('admin/setting/file-manager*')) ? 'active' : '' }}">
                                <span class="hide-menu">Agent</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- /Coupon -->
                <!-- Reports -->
                <li class="{{ (request()->is('admin/dashboard*')) ? 'active1' : '' }}">
                    <a class="sidebar-link" href="#" aria-expanded="false">
                        <i class="fa fa-file"></i>
                        <span>
                            Reports
                        </span>
                    </a>
                </li>
                <!-- /Reports -->
                <!-- Payout -->
                <li class="{{ (request()->is('admin/dashboard*')) ? 'active1' : '' }}">
                    <a class="sidebar-link" href="#" aria-expanded="false">
                        <i class="fa fa-credit-card"></i>
                        <span>
                            Payout
                        </span>
                    </a>
                </li>
                <!-- /Payout -->
                <!-- Users -->
                @if(auth()->user()->can('user-list') || auth()->user()->can('role-list') ||
                auth()->user()->can('permission-list') || auth()->user()->can('user-activity'))
                <li class="submenu">
                    <a class="" href="javascript:void(0)" aria-expanded="false">
                        <i class="fa fa-users"></i>
                        <span class="hide-menu">Staff </span>
                        <span class="menu-arrow"></span>
                    </a>

                    <ul style="display: none;">
                        @can('user-list')
                        <li>
                            <a href="{{ route('users.index') }}" title="User"
                                class="sidebar-link {{ (request()->is('admin/user*')) ? 'active' : '' }}">
                                <span class="hide-menu">Staff</span>
                            </a>
                        </li>
                        @endcan

                        @can('role-list')
                        <li>
                            <a href="{{ route('roles.index') }}" title="Role"
                                class="sidebar-link {{ (request()->is('admin/roles*')) ? 'active' : '' }}">
                                <span class="hide-menu">Role</span>
                            </a>
                        </li>
                        @endcan

                        @can('permission-list')
                        <li>
                            <a href="{{ route('permissions.index') }}" title="Permission"
                                class="sidebar-link {{ (request()->is('admin/permissions*')) ? 'active' : '' }}">
                                <span class="hide-menu">Permission</span>
                            </a>
                        </li>
                        @endcan

                        @can('user-activity')
                        <li>
                            <a href="/admin/user-activity" title="User Activity"
                                class="sidebar-link {{ (request()->is('admin/setting/useractivity*')) ? 'active' : '' }}">
                                <span class="hide-menu">User Activity</span>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endif
                <!-- /Users -->
                <!-- Site Management -->
                <li class="submenu">
                    <a class="" href="javascript:void(0)" aria-expanded="false">
                        <i class="fa fa-cog"></i>
                        <span class="hide-menu">Site Management</span>
                        <span class="menu-arrow"></span>
                    </a>

                    <ul style="display: none;">
                        <li>
                            <a href="#" title="Website Setting"
                                class="sidebar-link {{ (request()->is('admin/setting/website-setting*')) ? 'active' : '' }}">
                                <span class="hide-menu">Youtube Video</span>
                            </a>
                        </li>

                    </ul>
                </li>
                <!-- /Site management -->
                <!-- Settings -->
                @if(auth()->user()->can('file-manager') || auth()->user()->can('websetting-edit') ||
                auth()->user()->can('log-view'))
                <li class="submenu">
                    <a class="" href="javascript:void(0)" aria-expanded="false">
                        <i class="fa fa-cog"></i>
                        <span class="hide-menu">Setting</span>
                        <span class="menu-arrow"></span>
                    </a>

                    <ul style="display: none;">

                        @can('websetting-edit')
                        <li>
                            <a href="{{route('website-setting.edit')}}" title="Website Setting"
                                class="sidebar-link {{ (request()->is('admin/setting/website-setting*')) ? 'active' : '' }}">
                                <span class="hide-menu">Website Setting</span>
                            </a>
                        </li>
                        @endcan

                        @can('log-view')
                        <li>
                            <a href="/admin/log-reader" title="Read Logs"
                                class="sidebar-link {{ (request()->is('admin/setting/log*')) ? 'active' : '' }}">
                                <span class="hide-menu">Read Logs</span>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endif
                <!-- /Settings -->

            </ul>
        </div> <!-- /Sidebar-Menu -->
    </div> <!-- /Sidebar-inner -->
</div><!-- /Sidebar -->