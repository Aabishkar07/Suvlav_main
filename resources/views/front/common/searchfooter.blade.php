@php
    $setting = getSetting();
@endphp















<footer class="lg:bg-[#222] fixed w-full max-md:mb-1 z-50 bottom-0 border-top border-top-1">



    @if (Session::get('memeber_email_ss') == '')

    <div class="copyright">
        <div class="container">
            <div class="">
                <div class="gap-x-1">

                    <div class="w-[100%] md:w-[100%]">
                        <div class="left">
                           
                    
                            <div
                                class=" flex flex-col mt-1 rounded-lg shadow-lg max-md:order-1  h-auto min-w-[100%] lg:w-2/4 max-md:w-full transition-all duration-300 relative">

                                <!-- Search Form -->
                                <form action="{{ route('product.search') }}" method="GET"
                                    class="relative flex items-center">




                                    {{-- <?php if (Session::get('memeber_email_ss') != ''): ?> --}}
                                    <input type="text" name="query" id="search-input"
                                        class="w-full p-2 rounded-lg " placeholder="Search products..."
                                        value="{{ request()->query('query') }}" oninput="toggleSearchHistory()"
                                        onclick="toggleSearchHistory()">
                                    <button type="submit"
                                        class="absolute max-sm:text-xs max-sm:mt-0.5 px-3 py-1 text-white bg-blue-500 rounded-lg right-2 top-1">
                                        Search
                                    </button>
                                    {{-- <?php else: ?>
                                    <input type="text" name="query" id="search-input"
                                    class="w-full p-2 rounded-lg " placeholder="Search products..."
                                    >
                                    <a class="absolute px-3 py-1 text-white bg-blue-500 rounded-lg right-2 top-1"
                                        href="{{ url('/memberloginform') }}" class="login-btn">Login to Search</a>

                                    <?php endif; ?> --}}

                                </form>

                                <!-- Search History and Clear Button -->
                                <div class="absolute w-full mt-2 bottom-10">
                                    <!-- Search History List -->
                                    <ul id="search-history"
                                        class="hidden w-full overflow-auto bg-white border rounded-lg shadow-lg max-h-40">
                                        @if (!empty($searchHistory))
                                            @foreach ($searchHistory as $history)
                                                <li class="px-4 py-2 hover:bg-gray-100">
                                                    <a href="{{ route('product.search', ['query' => $history]) }}"
                                                        class="text-blue-500 hover:underline">
                                                        {{ $history }}
                                                    </a>
                                                </li>
                                            @endforeach
                                            <form action="{{ route('search.history.clear') }}" method="POST"
                                                class="mt-2 text-center">
                                                @csrf
                                                <button type="submit" class="text-sm text-blue-500 hover:underline">
                                                    Clear Search History
                                                </button>
                                            </form>
                                        @endif
                                    </ul>

                                    <!-- Clear Button -->

                                </div>
                            </div>

                          



                        </div>
                    </div>

                  
                </div>
            </div>
        </div>
    </div>

@else

    <!-- End Footer Top -->
    <div class="copyright">
        <div class="container">
            <div class="">
                <div class="flex gap-x-1 items-center justify-between">

                    <div class="w-[65%] md:w-[70%]">
                        <div class="left">
                           
                    
                            <div
                                class=" flex flex-col mt-1 rounded-lg shadow-lg max-md:order-1  h-auto min-w-[40%] lg:w-2/4 max-md:w-full transition-all duration-300 relative">

                                <!-- Search Form -->
                                <form action="{{ route('product.search') }}" method="GET"
                                    class="relative flex items-center">




                                    {{-- <?php if (Session::get('memeber_email_ss') != ''): ?> --}}
                                    <input type="text" name="query" id="search-input"
                                        class="w-full p-2 rounded-lg " placeholder="Search products..."
                                        value="{{ request()->query('query') }}" oninput="toggleSearchHistory()"
                                        onclick="toggleSearchHistory()">
                                    <button type="submit"
                                        class="absolute max-sm:text-xs max-sm:mt-0.5 px-3 py-1 text-white bg-blue-500 rounded-lg right-2 top-1">
                                        Search
                                    </button>
                                    {{-- <?php else: ?>
                                    <input type="text" name="query" id="search-input"
                                    class="w-full p-2 rounded-lg " placeholder="Search products..."
                                    >
                                    <a class="absolute px-3 py-1 text-white bg-blue-500 rounded-lg right-2 top-1"
                                        href="{{ url('/memberloginform') }}" class="login-btn">Login to Search</a>

                                    <?php endif; ?> --}}

                                </form>

                                <!-- Search History and Clear Button -->
                                <div class="absolute w-full mt-2 bottom-10">
                                    <!-- Search History List -->
                                    <ul id="search-history"
                                        class="hidden w-full overflow-auto bg-white border rounded-lg shadow-lg max-h-40">
                                        @if (!empty($searchHistory))
                                            @foreach ($searchHistory as $history)
                                                <li class="px-4 py-2 hover:bg-gray-100">
                                                    <a href="{{ route('product.search', ['query' => $history]) }}"
                                                        class="text-blue-500 hover:underline">
                                                        {{ $history }}
                                                    </a>
                                                </li>
                                            @endforeach
                                            <form action="{{ route('search.history.clear') }}" method="POST"
                                                class="mt-2 text-center">
                                                @csrf
                                                <button type="submit" class="text-sm text-blue-500 hover:underline">
                                                    Clear Search History
                                                </button>
                                            </form>
                                        @endif
                                    </ul>

                                    <!-- Clear Button -->

                                </div>
                            </div>

                          



                        </div>
                    </div>


@php

    $userid= Session::get('memeber_email_ss');
 $userdata= DB::table('members')->where('email',$userid)->get();


        @endphp



                    <div class="w-[30%] md:w-[20%]">
                        @if (Session::get('memeber_email_ss') != '')
                            <div class="flex items-center right">
                                <p class="text-xs" style="color: black;padding:10px;background-color: #ffffff;width: 100%">My Points {{ $userdata[0]->total_points ?? 0 }}
                                </p>
                            </div>
                        @endif


                    </div>
                </div>
            </div>
        </div>
    </div>

    @endif
</footer>


<script>
    function toggleSearchHistory() {
        const query = document.getElementById('search-input').value;
        const historyList = document.getElementById('search-history');
        if (query.trim().length > 0 || document.activeElement === document.getElementById('search-input')) {
            historyList.classList.remove('hidden');
        } else {
            historyList.classList.add('hidden');
        }
    }

    // Hide search history when clicking outside
    document.addEventListener('click', function(event) {
        const searchInput = document.getElementById('search-input');
        const historyList = document.getElementById('search-history');
        if (!searchInput.contains(event.target) && !historyList.contains(event.target)) {
            historyList.classList.add('hidden');
        }
    });
</script>