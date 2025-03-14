@extends('layouts.frontendapp')

@section('content')
@php
use App\Models\ProductCategory;
$categories = ProductCategory::where('parent_id', 0)->with('subcategories')->get();
@endphp



<div class="flex h-screen">
    <!-- Sidebar -->
    <div class="w-1/2 bg-gray-200 pt-3 pl-2">
        <h2 class="text-sm font-semibold mb-4">Categories</h2>
        <ul>
            @foreach ($categories as $category)
                <li class="py-2 flex items-center space-x-2 text-gray-700 cursor-pointer hover:text-black" onclick="showCategory('{{ $category->id }}')">
                    <span class="text-xs">{{ $category->icon }}</span> <span>{{ $category->title }}</span>
                </li>
            @endforeach
        </ul>
    </div>

    <!-- Main Content -->
    <div class="w-3/4 bg-white p-4">
        <div class="flex items-center border-b pb-2 mb-4">
            <h2 id="category-title" class="text-sm font-bold flex-1">Select a Category</h2>
        </div>
        
        <!-- Category List -->
        <div id="category-content" class="space-y-4">
            <p class="text-gray-500">Please select a category from the sidebar.</p>
        </div>
    </div>
</div>

<script>
    const categories = @json($categories);

    function showCategory(categoryId) {
        const title = document.getElementById("category-title");
        const content = document.getElementById("category-content");
        
        const category = categories.find(cat => cat.id == categoryId);
        if (!category) return;

        title.textContent = category.title;
        
        if (category.subcategories.length > 0) {
            content.innerHTML = category.subcategories.map(sub => `
                <div class="p-2 border rounded-lg cursor-pointer flex justify-between items-center">
          
                                        <a href="{{ url('/productcategory/') }}/${sub.id}" class="text-blue-500 hover:underline">${sub.title}</a>

                </div>
            `).join('');
        } else {
            content.innerHTML = '<p class="text-gray-500">No subcategories available.</p>';
        }
    }
</script>




@endsection