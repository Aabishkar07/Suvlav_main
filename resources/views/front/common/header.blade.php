<script src="https://cdn.tailwindcss.com"></script>

<header class='sm:flex shadow-md sm:px-8 px-2 py-1 bg-white font-[sans-serif] min-h-[20px]'>
    <div class="flex w-full max-w-screen-2xl mx-auto">
        <div class='flex flex-wrap items-center justify-between relative lg:gap-y-4 gap-y-4 gap-x-4 w-full'>

            <div class="flex">



                <!-- Dropdown Button -->



            




               

                <!-- Add JavaScript for Hover Functionality -->




                <a href="/" class="">
                    <img src="{{ asset('public/front_assets/images/swastik.png') }}" alt="logo" class='w-10 ' />

                </a>
            </div>

            {{-- <div class="bg-white flex items-center border rounded-lg shadow-md max-md:order-1 border-transparent focus-within:border-black focus-within:bg-gray-50 px-6 py-2 rounded-lg h-12 min-w-[40%] lg:w-2/4 max-md:w-full transition-all duration-300">
                <!-- Search Form -->
                <form action="{{ route('product.search') }}" method="GET" class="w-full flex items-center">
                    <!-- Search Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192.904 192.904" class="fill-gray-400 mr-4 w-5 h-5">
                        <path d="m190.707 180.101-47.078-47.077c11.702-14.072 18.752-32.142 18.752-51.831C162.381 36.423 125.959 0 81.191 0 36.422 0 0 36.423 0 81.193c0 44.767 36.422 81.187 81.191 81.187 19.688 0 37.759-7.049 51.831-18.751l47.079 47.078a7.474 7.474 0 0 0 5.303 2.197 7.498 7.498 0 0 0 5.303-12.803zM15 81.193C15 44.694 44.693 15 81.191 15c36.497 0 66.189 29.694 66.189 66.193 0 36.496-29.692 66.187-66.189 66.187C44.693 147.38 15 117.689 15 81.193z"></path>
                    </svg>
            
                    <!-- Search Input -->
                    <input 
                        type="text" 
                        name="query" 
                        placeholder="Search for products..." 
                        class="w-full outline-none bg-transparent text-black text-sm focus:ring-2 focus:ring-black focus:border-transparent transition-all duration-300 px-4 py-2 rounded-lg" 
                        required
                    />
            
                    <!-- Submit Button -->
                    <button type="submit" class="ml-4 p-1 px-3 bg-black text-white text-sm font-semibold rounded-lg hover:bg-black hover:text-white border-2 border-transparent hover:border-white focus:outline-none focus:ring-2 focus:ring-black transition-all duration-300 ease-in-out transform hover:scale-105 shadow-lg">
                        Search
                    </button>
                    
                </form>
            </div> --}}

            <!--<div class="bg-white flex items-center border rounded-lg shadow-md max-md:order-1 border-transparent focus-within:border-black focus-within:bg-gray-50 px-4 py-2 rounded-lg h-12 min-w-[40%] lg:w-2/4 max-md:w-full transition-all duration-300">-->
            <!-- Search Form -->
            <!--    <form action="{{ route('product.search') }}" method="GET" class="w-full flex items-center">-->
            <!-- Search Icon -->
            <!--        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192.904 192.904" class="fill-gray-400 mr-3 w-4 h-4 max-md:w-3 max-md:h-3">-->
            <!--            <path d="m190.707 180.101-47.078-47.077c11.702-14.072 18.752-32.142 18.752-51.831C162.381 36.423 125.959 0 81.191 0 36.422 0 0 36.423 0 81.193c0 44.767 36.422 81.187 81.191 81.187 19.688 0 37.759-7.049 51.831-18.751l47.079 47.078a7.474 7.474 0 0 0 5.303 2.197 7.498 7.498 0 0 0 5.303-12.803zM15 81.193C15 44.694 44.693 15 81.191 15c36.497 0 66.189 29.694 66.189 66.193 0 36.496-29.692 66.187-66.189 66.187C44.693 147.38 15 117.689 15 81.193z"></path>-->
            <!--        </svg>-->

            <!-- Search Input -->
            <!--        <input -->
            <!--            type="text" -->
            <!--            name="query" -->
            <!--            placeholder="Search..." -->
            <!--            class="w-full outline-none bg-transparent text-black text-sm focus:ring-2 focus:ring-black focus:border-transparent transition-all duration-300 px-3 py-2 rounded-lg" -->
            <!--            required-->
            <!--        />-->

            <!-- Submit Button -->
            <!--        <button type="submit" class="ml-4 p-1 px-3 bg-black text-white text-sm font-semibold rounded-lg hover:bg-black hover:text-white border-2 border-transparent hover:border-white focus:outline-none focus:ring-2 focus:ring-black transition-all duration-300 ease-in-out transform hover:scale-105 shadow-lg">-->
            <!--            Search-->
            <!--        </button>-->
            <!--    </form>-->
            <!--</div>-->




            <div class="right-bar-section" style="display: flex; align-items: center; gap: 20px;">
                <div class="user-actions" style="display: flex; align-items: center; gap: 20px;">




                    @php
                    use App\Models\ProductCategory;
                    
                    // Get all parent categories with subcategories
                    $categories = ProductCategory::where('parent_id', 0)->with('subcategories')->get();
                @endphp
                
                
                <div class="relative inline-block">
                  

                    
                    <button id="dropdownButton" class="border-none p-0  h-6 w-6 mt-[1px]" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="black"
                            stroke-linecap="round" stroke-linejoin="round" width="24" height="24"
                            stroke-width="2">
                            <path d="M5 10h14"></path>
                            <path d="M5 14h14"></path>
                        </svg>
                    </button>

                
                    <!-- First-layer dropdown (Categories) -->
                    <ul id="dropdownMenu"
                    class="hidden absolute mt-2 max-sm:right-0 bg-white border border-gray-300 shadow-lg rounded-md w-48 z-50 group-hover:block">
                    @foreach ($categories as $category)
                    <li class="relative group">
                        <a href="{{ url('/productcategory/' . $category->id) }}"
                            class="block px-4 py-2 hover:bg-gray-100">{{ $category->title }}</a>
                
                        @if ($category->subcategories->count() > 0)
                        <!-- Second-layer dropdown (Subcategories) -->
                        <ul class="hidden absolute  right-48 top-0 bg-white border border-gray-300 shadow-lg rounded-md w-48 z-50 group-hover:block">
                            @foreach ($category->subcategories as $subcategory)
                            <li>
                                <a href="{{ url('/productcategory/' . $subcategory->id) }}"
                                    class="block px-4 py-2 hover:bg-gray-100">{{ $subcategory->title }}</a>
                            </li>
                            @endforeach
                        </ul>
                        @endif
                    </li>
                    @endforeach
                </ul>
                
                </div>
                
                <script>
                document.addEventListener("DOMContentLoaded", function () {
                    const dropdownButton = document.getElementById("dropdownButton");
                    const dropdownMenu = document.getElementById("dropdownMenu");
                
                    // Show categories when hovering over the button
                    dropdownButton.addEventListener("mouseenter", function () {
                        dropdownMenu.classList.remove("hidden");
                    });
                
                    // Hide categories when mouse leaves the dropdown area
                    dropdownMenu.addEventListener("mouseleave", function () {
                        dropdownMenu.classList.add("hidden");
                    });
                
                    // Ensure clicking a category doesn't close the menu
                    dropdownMenu.addEventListener("click", function (event) {
                        event.stopPropagation();
                    });
                
                    // Close menu when clicking outside
                    document.addEventListener("click", function (event) {
                        if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                            dropdownMenu.classList.add("hidden");
                        }
                    });
                });
                </script>

                    <a href="{{ url('/myprofile') }}">
                        <i class="ri-user-line"></i> Profile
                    </a>

                    <a class="max-md:hidden">
                        <i class="ti-power-off"></i>
                        <?php if(Session::get('memeber_email_ss') == '') { ?>
                        <a href="{{ url('/memberloginform') }}"  class="login-btn max-md:hidden">Logins</a>
                        <?php } else { ?>
                        <a class="max-md:hidden" href="{{ url('/memberlogout') }}">Logout</a>
                        <?php } ?>
                    </a>
                </div>

                <!-- Shopping Cart Section -->
                <div class="sinlge-bar shopping" id="js_cartInfo"
                    style="display: flex; align-items: center; gap: 20px;">
                    <a href="#" class="single-icon">
                        <i class="ti-bag"></i>
                        <span class="total-count">{{ count($cartItems) }}</span>
                    </a>
                    <div class="shopping-item">
                        <div class="dropdown-cart-header">
                            <span>{{ count($cartItems) !== null ? count($cartItems) : '0' }} Items</span>
                            <a href="{{ route('view.cart') }}">View Cart</a>
                        </div>
                        <ul class="shopping-list">
                            <?php
                            $delete_url = "'" . route('cart.remove') . "'";
                            $csrf_token = "'" . csrf_token() . "'";
                            $total_amt = 0;
                            ?>
                            @foreach ($cartItems as $cartItem)
                                <li>
                                   
                                    <a href="javascript:void(0)" class="remove"
                                        onClick="deleteCartItem(<?php echo $csrf_token; ?>,<?php echo $cartItem->id; ?>, <?php echo $delete_url; ?>);"
                                        title="Remove this item"><i class="fa fa-remove"></i></a>
                                    <a class="cart-img" href="javascript:void(0);">
                                        <img
                                            src="{{ asset('public' . $cartItem->product_image) }}">
                                        </a>
                                    <h4><a
                                            href="{{ url('/product/' . $cartItem->product_slug) }}">{{ $cartItem->product_title }}</a>
                                    </h4>
                                    <p class="quantity">{{ $cartItem->quantity }} - <span
                                            class="amount">{{ moneyFormat($cartItem->price) }}</span></p>
                                </li>
                                <?php $total_amt += $cartItem->quantity * $cartItem->price; ?>
                            @endforeach
                        </ul>
                        <div class="bottom">
                            <div class="total mb-3">
                                <span>Total</span>
                                <span class="total-amount">{{ moneyFormat($total_amt) }}</span>
                            </div>
                            <a href="{{ url('/checkout') }}" class="text-white px-5  py-2  animate bg-blue-500">Checkout</a>
                        </div>
                    </div>
                </div>
<div class="max-md:hidden">
   <a href="{{ route('wishlist') }}">
    <i class="ti-heart"> </i>
   </a>
</div>

            </div>




        </div>

        <div id="collapseMenu"
            class='hidden before:fixed before:bg-black before:opacity-40 before:inset-0 max-lg:before:z-50'>
            <button id="toggleClose"
                class='fixed top-2 right-4 z-[100] rounded-full bg-white w-9 h-9 flex items-center justify-center border'>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 fill-black" viewBox="0 0 320.591 320.591">
                    <path
                        d="M30.391 318.583a30.37 30.37 0 0 1-21.56-7.288c-11.774-11.844-11.774-30.973 0-42.817L266.643 10.665c12.246-11.459 31.462-10.822 42.921 1.424 10.362 11.074 10.966 28.095 1.414 39.875L51.647 311.295a30.366 30.366 0 0 1-21.256 7.288z"
                        data-original="#000000"></path>
                    <path
                        d="M287.9 318.583a30.37 30.37 0 0 1-21.257-8.806L8.83 51.963C-2.078 39.225-.595 20.055 12.143 9.146c11.369-9.736 28.136-9.736 39.504 0l259.331 257.813c12.243 11.462 12.876 30.679 1.414 42.922-.456.487-.927.958-1.414 1.414a30.368 30.368 0 0 1-23.078 7.288z"
                        data-original="#000000"></path>
                </svg>
            </button>

            <ul
                class='block space-x-4 space-y-3 fixed bg-white w-1/2 min-w-[300px] top-0 left-0 p-4 h-full shadow-md overflow-auto z-50'>
                <li class='pb-4 px-3'>
                    <a href="javascript:void(0)"><img src="https://readymadeui.com/readymadeui.svg" alt="logo"
                            class='w-36' />
                    </a>
                </li>
                <li class='border-b pb-4 px-3 hidden'>
                    <a href="javascript:void(0)"><img src="https://readymadeui.com/readymadeui.svg" alt="logo"
                            class='w-36' />
                    </a>
                </li>
                <li class='border-b py-3 px-3'>
                    <a href='javascript:void(0)'
                        class='hover:text-[#007bff] text-[#007bff] block font-semibold text-base'>Home</a>
                </li>
                <li class='border-b py-3 px-3'><a href='javascript:void(0)'
                        class='hover:text-[#007bff] text-black block font-semibold text-base'>Team</a>
                </li>
                <li class='border-b py-3 px-3'><a href='javascript:void(0)'
                        class='hover:text-[#007bff] text-black block font-semibold text-base'>Feature</a>
                </li>
                <li class='border-b py-3 px-3'><a href='javascript:void(0)'
                        class='hover:text-[#007bff] text-black block font-semibold text-base'>Blog</a>
                </li>
                <li class='border-b py-3 px-3'><a href='javascript:void(0)'
                        class='hover:text-[#007bff] text-black block font-semibold text-base'>About</a>
                </li>
                <li class='border-b py-3 px-3'><a href='javascript:void(0)'
                        class='hover:text-[#007bff] text-black block font-semibold text-base'>Contact</a>
                </li>
            </ul>
        </div>
    </div>
</header>


<script>
    var toggleOpen = document.getElementById('toggleOpen');
    var toggleClose = document.getElementById('toggleClose');
    var collapseMenu = document.getElementById('collapseMenu');

    function handleClick() {
        if (collapseMenu.style.display === 'block') {
            collapseMenu.style.display = 'none';
        } else {
            collapseMenu.style.display = 'block';
        }
    }

    toggleOpen.addEventListener('click', handleClick);
    toggleClose.addEventListener('click', handleClick);
</script>


<script>
    const dropdownButton = document.getElementById('dropdownHoverButton');
    const dropdownMenu = document.getElementById('dropdownHover');

    dropdownButton.addEventListener('mouseenter', () => {
        dropdownMenu.classList.remove('hidden');
    });

    dropdownButton.addEventListener('mouseleave', () => {
        dropdownMenu.classList.add('hidden');
    });

    dropdownMenu.addEventListener('mouseenter', () => {
        dropdownMenu.classList.remove('hidden');
    });

    dropdownMenu.addEventListener('mouseleave', () => {
        dropdownMenu.classList.add('hidden');
    });
</script>
