@php
    $setting = getSetting();
@endphp

<footer class="lg:bg-[#222] fixed w-full z-50 bottom-0 border-top border-top-1">

    <!-- End Footer Top -->
    <div class="copyright">
        <div class="container">
            <div class="">
                <div class="row">

                    <div class="col-lg-6 col-12">
                        <div class="left">
                            {{-- <form action="{{ route('product.search') }}" method="GET" class="d-flex">
                                    <div class="input-group">
                                        <input 
                                            class="form-control rounded-pill text-xs pl-2" 
                                            name="query" 
                                            type="search" 
                                            id="form1" 
                                            placeholder="Search..." 
                                        />
                                        <button 
                                            type="submit" 
                                            class="btn" 
                                            style="background-color: orange; color: white; border-radius: 0px; padding: 8px 16px; border: none;">
                                            Search
                                        </button>
                                    </div>
                                </form> --}}






{{-- 
                            <div
                                class="bg-white flex items-center border rounded-lg shadow-lg max-md:order-1 border-transparent focus-within:border-black focus-within:bg-gray-50 px-1 py-2  h-12 min-w-[40%] lg:w-2/4 max-md:w-full transition-all duration-300 relative">

                                <form action="{{ route('product.search') }}" method="GET" class="relative">
                                    <input type="text" name="query" id="search-input"
                                        class="border rounded-lg p-2 w-full" placeholder="Search products..."
                                        value="{{ request()->query('query') }}" oninput="showSearchHistory()">
                                    <button type="submit"
                                        class="absolute right-2 top-2 bg-blue-500 text-white p-2 rounded-lg">
                                        Search
                                    </button>
                                </form>

                                <div id="search-history-outside" class="mt-4">
                                    <ul class="bg-white border shadow-lg rounded-lg w-full relative bottom-10">
                                        @if (!empty($searchHistory))
                                            @foreach ($searchHistory as $history)
                                                <li>
                                                    <a href="{{ route('product.search', ['query' => $history]) }}">
                                                        {{ $history }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>

                                <script>
                                    function showSearchHistory() {
                                        const query = document.getElementById('search-input').value;
                                        const historyList = document.getElementById('search-history');
                                        if (query.trim().length > 0) {
                                            historyList.classList.remove('hidden');
                                        } else {
                                            historyList.classList.add('hidden');
                                        }
                                    }
                                </script>


                            </div>

                            <form action="{{ route('search.history.clear') }}" method="POST" class="mt-2">
                                @csrf
                                <button type="submit" class="text-sm text-red-500 hover:underline">
                                    Clear Search History
                                </button>
                            </form> --}}



                            <div
                            class=" flex flex-col mt-1 rounded-lg shadow-lg max-md:order-1  h-auto min-w-[40%] lg:w-2/4 max-md:w-full transition-all duration-300 relative">
                        
                            <!-- Search Form -->
                            <form action="{{ route('product.search') }}" method="GET" class="relative flex items-center">
                                <input type="text" name="query" id="search-input"
                                    class=" rounded-lg p-2 w-full" placeholder="Search products..."
                                    value="{{ request()->query('query') }}" oninput="toggleSearchHistory()" onclick="toggleSearchHistory()">
                                <button type="submit"
                                    class="absolute right-2 top-1 bg-blue-500 text-white px-3 py-1 rounded-lg">
                                    Search
                                </button>
                            </form>
                        
                            <!-- Search History and Clear Button -->
                            <div class="mt-2 bottom-10 w-full absolute">
                                <!-- Search History List -->
                                <ul id="search-history" class="bg-white border shadow-lg rounded-lg w-full max-h-40 overflow-auto hidden">
                                    @if (!empty($searchHistory))
                                        @foreach ($searchHistory as $history)
                                            <li class="px-4 py-2 hover:bg-gray-100">
                                                <a href="{{ route('product.search', ['query' => $history]) }}" class="text-blue-500 hover:underline">
                                                    {{ $history }}
                                                </a>
                                            </li>

                                            @endforeach
                                            <form action="{{ route('search.history.clear') }}" method="POST" class="mt-2 text-center">
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
                            document.addEventListener('click', function (event) {
                                const searchInput = document.getElementById('search-input');
                                const historyList = document.getElementById('search-history');
                                if (!searchInput.contains(event.target) && !historyList.contains(event.target)) {
                                    historyList.classList.add('hidden');
                                }
                            });
                        </script>
                        
                            
                          
                        </div>
                    </div>

                    <div class="col-lg-6 col-12">
                        <?php if (Session::get('memeber_email_ss') != ''): ?>
                        <div class="right flex items-center">
                            <p>My Points {{ $userdata[0]->total_points ?? 0 }}</p>
                        </div>
                        <?php else: ?>
                        <div class="right flex items-center">
                            {{-- <p>                            <a href="{{ url('/memberloginform') }}" style="display: inline;" class="login-btn">Login</a>
                                </p> --}}
                        </div>
                        <?php endif; ?>


                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
