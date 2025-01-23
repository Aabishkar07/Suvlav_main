@extends('layouts.frontendapp')

@section('content')
<section class="faq-section py-10 bg-gray-100">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Frequently Asked Questions</h1>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">Get quick answers to our most common inquiries</p>
        </div>

        <div class="max-w-3xl mx-auto space-y-4">
            @foreach($pages as $faq)
            <div class="accordion-item bg-white rounded-lg shadow-md overflow-hidden">
                <button 
                    class="accordion-header w-full flex justify-between items-center p-3 rounded-md  text-left text-lg font-semibold text-gray-800 hover:bg-gray-50 focus:outline-none transition duration-300"
                    type="button" 
                    data-collapse-toggle="collapse{{ $faq['id'] }}"
                    aria-expanded="false"
                >
                    <span>{{ $faq['title'] }}</span>
                    <svg 
                        xmlns="http://www.w3.org/2000/svg" 
                        class="h-6 w-6 text-gray-500 accordion-icon transition-transform duration-300"
                        fill="none" 
                        viewBox="0 0 24 24" 
                        stroke="currentColor"
                    >
                        <path 
                            stroke-linecap="round" 
                            stroke-linejoin="round" 
                            stroke-width="2" 
                            d="M9 5l7 7-7 7" 
                        />
                    </svg>
                </button>
                <div 
                    id="collapse{{ $faq['id'] }}" 
                    class="accordion-content hidden p-3 bg-gray-50 rounded-md text-gray-700 border-t border-gray-200"
                >
                    {!! $faq['description'] !!}
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<script>
    document.querySelectorAll('[data-collapse-toggle]').forEach(button => {
        button.addEventListener('click', () => {
            const content = document.getElementById(button.getAttribute('data-collapse-toggle'));
            const icon = button.querySelector('.accordion-icon');
            
            content.classList.toggle('hidden');
            icon.classList.toggle('rotate-90');
            
            button.setAttribute('aria-expanded', 
                button.getAttribute('aria-expanded') === 'false' ? 'true' : 'false'
            );
        });
    });
</script>
@endsection