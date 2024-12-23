@php
    $image_url = $list->image != '' ? $list->image : '';
@endphp

@switch($list->display_option)
    @case('1')
        @if ($display_option == $list->display_option)
            <div class="single-slider" style="background-image: url('{{ asset("public/".$image_url) }}');">
                <div class="container">
                    <div class="row no-gutters">
                        <div class="col-lg-9 offset-lg-3 col-12">
                            <div class="text-inner">
                                <div class="row">
                                    <div class="col-lg-7 col-12">
                                        <div class="hero-text">
                                            <h1>
                                                {!! $list->top_heading ? '<span>' . $list->top_heading . '</span>' : '' !!}
                                                {!! $list->main_heading ? $list->main_heading : '' !!}</h1>
                                            <p>{!! $list->short_desc ? wordwrap($list->short_desc, 45, "<br>\n") : '' !!}</p>
                                            @if ($list->btn_name && $list->btn_url)
                                                <div class="button">
                                                    <a href="{{ $list->btn_url }}" class="btn">{{ $list->btn_name }}</a>
                                                </div>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @break

    @case('2')
        @if ($display_option == $list->display_option)
            <div class="col-lg-6 col-md-6 col-12">
                <div class="single-banner">
                    <img src="{{ asset($image_url) }}" alt="{{ $list->title }}">
                    <div class="content">
                        {!! $list->top_heading ? '<p>' . $list->top_heading . '</p>' : '' !!}
                        {!! $list->main_heading ? '<h3>' . $list->main_heading . '</h3>' : '' !!}
                        @if ($list->btn_name && $list->btn_url)
                            <a href="{{ $list->btn_url }}">{{ $list->btn_name }}</a>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    @break

    @default
        @if ($display_option == $list->display_option)
            <div class="col-lg-4 col-md-6 col-12">
                <div class="single-banner">
                    <img src="{{ asset($image_url) }}" alt="{{ $list->title }}">
                    <div class="content">
                        {!! $list->top_heading ? '<p>' . $list->top_heading . '</p>' : '' !!}
                        {!! $list->main_heading ? '<h3>' . $list->main_heading . '</h3>' : '' !!}
                        @if ($list->btn_name && $list->btn_url)
                            <a href="{{ $list->btn_url }}">{{ $list->btn_name }}</a>
                        @endif
                    </div>
                </div>
            </div>
        @endif

@endswitch
