<nav class="bg-white sidebar sidebar-offcanvas " id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
                <div class="nav-profile-image">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-linecap="round" stroke-linejoin="round" width="29" height="40" stroke-width="2">
                        <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                        <path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                        <path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855"></path>
                    </svg>
                    <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>

                </div>
                <div class="nav-profile-text d-flex flex-column">
                    <span class="mb-2 font-weight-bold">{{ Auth::user()->name }}</span>
                    <span class="text-black text-small">{{ Auth::user()->email }}</span>
                </div>
            </a>
        </li>






        @can('View Dashboard')
            <li class="">
                <a class="nav-link text-black   {{ request()->routeIs('dashboard') ? 'bg-black text-white w-full ' : '' }}"
                    href="{{ route('dashboard') }}">
                    <span class="menu-title">
                        <i class="mdi  mdi-home menu-icon  {{ request()->routeIs('dashboard') ? 'text-white' : 'text-black' }}  "
                            style="font-size: 20px"></i>
                        <span class="pb-1 ps-1">
                            Dashboard
                        </span>
                    </span>
                </a>
            </li>
        @endcan

        <style>
            li .nav-link {
                padding-inline: 40px;

            }

            li:hover {
                background-color: rgb(230, 230, 230)
            }
        </style>


        @can('View Banner')
            <li class="">
                <a class="nav-link  text-black   {{ request()->routeIs('banner.index') ? 'bg-black text-white w-full ' : '' }}"
                    href="{{ route('banner.index') }}">
                    <span class="menu-title ">
                        <i class="fa fa-sliders menu-icon  py-2 {{ request()->routeIs('banner.index') ? 'text-white' : 'text-black' }}  "
                            style="font-size: 20px"></i>
                        <span class="pb-1 ps-1">
                            Banner
                        </span>
                    </span>
                </a>
            </li>
        @endcan


        <li class="">
            <a class="nav-link  text-black   {{ request()->routeIs('province') ? 'bg-black text-white w-full ' : '' }}"
                href="{{ route('province') }}">
                <span class="menu-title ">
                    <i class="fa fa-sliders menu-icon  py-2 {{ request()->routeIs('province') ? 'text-white' : 'text-black' }}  "
                        style="font-size: 20px"></i>
                    <span class="pb-1 ps-1">
                        Manage Address
                    </span>
                </span>
            </a>
        </li>




        @can('View Product')
            <li class="nav-item ">
                <a class="nav-link" data-bs-toggle="collapse" href="#products" aria-expanded="false"
                    aria-controls="products">
                    <span class="menu-title"><i class="p-1 pt-1 text-black fa fa-product-hunt menu-icon "></i>
                        Products</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="" id="products">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('product.index') }}">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('productcat.index') }}">Categories</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('brand.index') }}">Brands</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('productcolor.index') }}">Product Colors</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('productsize.index') }}">Product Sizes</a>
                        </li>
                    </ul>
                </div>
            </li>
        @endcan




        @can('View Page')
            <li class="nav-item ">
                <a class="nav-link" data-bs-toggle="collapse" href="#pages" aria-expanded="false" aria-controls="pages">
                    <span class="menu-title"><i class="p-1 pt-1 text-black fa fa-pagelines menu-icon"></i> Pages</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="pages">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('page.index') }}">Pages</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('page.create') }}">Create New</a>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('faqs.index') }}">Faqs</a>
                        </li>



                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('blog.index') }}">Blogs</a>
                        </li>

                    </ul>
                </div>
            </li>
        @endcan



        @can('View Posts')
            <li class="nav-item ">
                <a class="nav-link" data-bs-toggle="collapse" href="#posts" aria-expanded="false" aria-controls="posts">
                    <span class="menu-title"><i class="p-1 pt-1 text-black fa fa-newspaper-o menu-icon"></i> Posts</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="posts">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('post.index') }}">Posts</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('category.index') }}">Categories</a>
                        </li>
                    </ul>
                </div>
            </li>
        @endcan

        <!-- <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#orders" aria-expanded="false" aria-controls="orders">
                <span class="menu-title"><i class="fa fa-first-order menu-icon"></i> Orders & Reviews</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="orders">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('order.index') }}">Product Orders</a>
                  </li>
                   <li class="nav-item">
                    <a class="nav-link" href="{{ route('review.index') }}">Product Reviews</a>
                  </li>

                </ul>
              </div>
            </li> -->

        @can('View Order')
            <li class="">
                <a class="nav-link text-black   {{ request()->routeIs('order.index') ? 'bg-black text-white w-full ' : '' }}"
                    href="{{ route('order.index') }}">
                    <span class="menu-title">
                        <i class="fa fa-first-order menu-icon  py-2 {{ request()->routeIs('order.index') ? 'text-white' : 'text-black' }}"
                            style="font-size: 18px"></i>
                        <span class="ps-2">
                            Product Orders
                        </span>
                    </span>
                </a>
            </li>
        @endcan
        @can('View Order')
            <li class="">
                <a class="nav-link text-black   {{ request()->routeIs('admin.exchangeorreturn') ? 'bg-black text-white w-full ' : '' }}"
                    href="{{ route('admin.exchangeorreturn') }}">
                    <span class="menu-title">
                        <i class="fa fa-first-order menu-icon  py-2 {{ request()->routeIs('admin.exchangeorreturn') ? 'text-white' : 'text-black' }}"
                            style="font-size: 18px"></i>
                        <span class="ps-2">
                            Cancel
                        </span>
                    </span>
                </a>
            </li>
        @endcan
        @can('View Order')
            <li class="">
                <a class="nav-link text-black   {{ request()->routeIs('admin.exchange') ? 'bg-black text-white w-full ' : '' }}"
                    href="{{ route('admin.exchange') }}">
                    <span class="menu-title">
                        <i class="fa fa-first-order menu-icon  py-2 {{ request()->routeIs('admin.exchange') ? 'text-white' : 'text-black' }}"
                            style="font-size: 18px"></i>
                        <span class="ps-2">
                            Exchange
                        </span>
                    </span>
                </a>
            </li>
        @endcan


        @can('View AdminUser')
            <li class="">
                <a class="nav-link text-black   {{ request()->routeIs('user.index') ? 'bg-black text-white w-full ' : '' }}"
                    href="{{ route('user.index') }}">
                    <span class="menu-title">
                        <i class="fa fa-user menu-icon py-2  {{ request()->routeIs('user.index') ? 'text-white' : 'text-black' }} "
                            style="font-size: 18px"></i>


                        <span class="ps-2">
                            Admin Users
                        </span>
                    </span>
                </a>
            </li>
        @endcan



        @can('View ShopUsers')
            <li class="">
                <a class="nav-link text-black   {{ request()->routeIs('member.index') ? 'bg-black text-white w-full ' : '' }}"
                    href="{{ route('member.index') }}">
                    <span class="menu-title">
                        <i class="fa fa-user menu-icon  py-2 {{ request()->routeIs('member.index') ? 'text-white' : 'text-black' }} "
                            style="font-size: 18px"></i>
                        <span class="ps-2">
                            Shop Users
                        </span>
                    </span>
                </a>
            </li>
        @endcan



        {{-- @can('View ShopUsers') --}}
        <li class="">
            <a class="nav-link text-black   {{ request()->routeIs('contact') ? 'bg-black text-white w-full ' : '' }}"
                href="{{ route('contact') }}">
                <span class="menu-title">
                    <i class="fa fa-user menu-icon  py-2 {{ request()->routeIs('contact') ? 'text-white' : 'text-black' }} "
                        style="font-size: 18px"></i>
                    <span class="ps-2">
                        Contact Us
                    </span>
                </span>
            </a>
        </li>
        {{-- @endcan --}}

        @can('View Settings')
            <li class="nav-item ">
                <a class="nav-link" data-bs-toggle="collapse" href="#settings" aria-expanded="false"
                    aria-controls="settings">
                    <span class="menu-title"><i class="p-1 pt-1 text-black fa fa-gear menu-icon"></i> Settings</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="settings">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('admin.setting.edit') }}">Site Settings</a>
                        </li>
                    </ul>
                </div>
            </li>
        @endcan

        {{-- @can('View Settings') --}}
        <li class="nav-item ">
            <a class="nav-link" data-bs-toggle="collapse" href="#reports" aria-expanded="false"
                aria-controls="reports">
                <span class="menu-title"><i class="p-1 pt-1 text-black fa fa-gear menu-icon"></i> Report</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="reports">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item ">
                        <a class="nav-link" href="{{ route('admin.searchhistory') }}">Search History</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="{{ route('admin.report.product') }}">Product Report</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="{{ route('admin.report.customer') }}">Customer Report</a>
                    </li>
                </ul>
            </div>
        </li>
        {{-- @endcan --}}

        <li class="nav-item ">
            <a class="nav-link" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                <span class="menu-title"><i class="p-1 pt-1 text-black mdi mdi-logout me-2 menu-icon"></i>
                    Logout</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </li>






        @can('View Users')
            <li class="">
                <a class="nav-link text-black   {{ request()->routeIs('userManagement.index') ? 'bg-black text-white w-full ' : '' }}"
                    href="{{ route('userManagement.index') }}">
                    <span class="menu-title">
                        <i class="fa fa-user-circle-o menu-icon py-2 {{ request()->routeIs('userManagement.index') ? 'text-white' : 'text-black' }} "
                            style="font-size: 18px"></i>
                        <span class="ps-2">
                            Manage Users
                        </span>
                    </span>
                </a>
            </li>
        @endcan



        @can('View Roles')
            <li class="">
                <a class="nav-link text-black   {{ request()->routeIs('userRole.index') ? 'bg-black text-white w-full ' : '' }}"
                    href="{{ route('userRole.index') }}">
                    <span class="menu-title">
                        <i class="fa fa-user menu-icon  py-2 {{ request()->routeIs('userRole.index') ? 'text-white' : 'text-black' }} "
                            style="font-size: 20px"></i>
                        <span class="ps-2">
                            Manage Roles
                        </span>
                    </span>
                </a>
            </li>
        @endcan





    </ul>
</nav>
