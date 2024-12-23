<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
                <div class="nav-profile-image">
                    <img src="{{ asset('admincss/images/faces/face1.jpg') }}" alt="profile" />
                    <span class="login-status online"></span>
                    <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                    <span class="mb-2 font-weight-bold">{{ Auth::user()->name }}</span>
                    <span class="text-secondary text-small">{{ Auth::user()->email }}</span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
            </a>
        </li>



        @can('View Dashboard')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <span class="menu-title"><i class="mdi mdi-home menu-icon"></i> Dashboard</span>
                </a>
            </li>
        @endcan


        @can('View Banner')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('banner.index') }}">
                    <span class="menu-title"><i class="fa fa-sliders menu-icon"></i> Banners</span>
                </a>
            </li>
        @endcan



        @can('View Product')
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#products" aria-expanded="false"
                    aria-controls="products">
                    <span class="menu-title"><i class="fa fa-product-hunt menu-icon"></i> Products</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="products">
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
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#pages" aria-expanded="false" aria-controls="pages">
                    <span class="menu-title"><i class="fa fa-pagelines menu-icon"></i> Pages</span>
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
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#posts" aria-expanded="false" aria-controls="posts">
                    <span class="menu-title"><i class="fa fa-newspaper-o menu-icon"></i> Posts</span>
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
            <li class="nav-item">
                <a class="nav-link" href="{{ route('order.index') }}">
                    <span class="menu-title"><i class="fa fa-user menu-icon"></i> Product Orders </span>
                </a>
            </li>
        @endcan


        @can('View AdminUser')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('user.index') }}">
                    <span class="menu-title"><i class="fa fa-user menu-icon"></i> Admin Users</span>
                </a>
            </li>
        @endcan



        @can('View ShopUsers')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('member.index') }}">
                    <span class="menu-title"><i class="fa fa-user menu-icon"></i> Shop Users</span>
                </a>
            </li>
        @endcan


        @can('View Settings')
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#settings" aria-expanded="false"
                    aria-controls="settings">
                    <span class="menu-title"><i class="fa fa-gear menu-icon"></i> Settings</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="settings">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.setting.edit') }}">Site Settings</a>
                        </li>
                    </ul>
                </div>
            </li>
        @endcan

        <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                <span class="menu-title"><i class="mdi mdi-logout me-2 menu-icon"></i> Logout</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </li>



            


            @can("View Users")

            <li class="nav-item">
              <a class="nav-link" href="{{ route('userManagement.index')}}">
                <span class="menu-title"><i class="fa fa-user menu-icon"></i> Manage Users</span>                
              </a>
            </li>
            @endcan


            
            @can("View Roles")

            <li class="nav-item">
              <a class="nav-link" href="{{ route('userRole.index')}}">
                <span class="menu-title"><i class="fa fa-user menu-icon"></i> Manage Roles</span>                
              </a>
            </li>
            @endcan
 

          


    </ul>
</nav>
