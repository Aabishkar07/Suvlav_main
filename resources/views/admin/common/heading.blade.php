@php
// Default Values
if(!isset($pageName) || empty($pageName)) {$pageName = 'Page'; }
if(!isset($breadcrumbs) || empty($breadcrumbs)){
    $breadcrumbs = [
    ['title' => 'Dashboard', 'link' => '#', 'isActive' => ''],
];
}


@endphp

<div class="page-header p-3">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
        <i class="fa fa-eye"></i>
        </span> {{$pageName}} 
    </h3>
            
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
        @foreach ($breadcrumbs as $key => $breadcrumb)
        <li class="breadcrumb-item" aria-current="page">
        {!! $key == 0 ? '<i class="fa fa-tasks"></i>' : '<span></span>' !!}
        {{$breadcrumb['title']}} 
        </li>

        @endforeach
        </ul>
    </nav>
</div>