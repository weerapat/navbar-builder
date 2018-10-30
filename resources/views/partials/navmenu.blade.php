{{--@push('scripts')--}}
    {{--<script src="{{ asset_path('js/nav-menu-desktop.js') }}"></script>--}}
{{--@endpush--}}

@extends('layouts.master')

@push('styles')
    <link rel="stylesheet" href="{{ mix('css/navigation.css') }}">
@endpush

@push('scripts')
<script>
    $(document).ready(function () {
        $('.nav-category:not(.active-category)').each(function (key, value) {
            var $color = $(value).data('border-color');
            $(value).hover(function () {
                $(this).find('.nav-links').css({ 'border-top-color': $color, color: $color });
            }, function () {
                $(this).find('.nav-links').css({ 'border-top-color': '#f5f5f5', color: '#4d4d4d' });
            });
        });
    });
</script>
@endpush

<?php $positionExtend = 73; ?>

<nav class="nav-menu">
    <ul class="nav nav-pills">
        @foreach ($submenuCms as $cateKey => $category)
            <li class="nav-item nav-category @if (isset($category['active'])) active-category @endif"
                data-border-color="{{ $category['color'] }}"
            >
                <a class="nav-links" href="{{ $category['link'][app()->getLocale()] }}"
                    @if (isset($category['active']))
                        style="border-top-color: {{ $category['color'] }}; color: {{ $category['color'] }};"
                    @endif
                >
                    {{ $category['category_name'][app()->getLocale()]}}
                </a>
                @if (!empty($category['pages']))
                    <div class="nav-box @if(empty($category['ads_id'])) no-ads @endif"
                         style="left: -{{ ($cateKey * $positionExtend)}}px;"
                    >
                    <div style="border-bottom-color: {{ $category['color'] }}; left: {{ ($cateKey * $positionExtend) + 10 }}px;"
                         class="nav-box-before"
                    ></div>
                    <div style="left: {{ ($cateKey * $positionExtend) + 11 }}px;" class="nav-box-after"></div>
                        <div class="nav-content" @if(!empty($category['color']))
                            style="border-top-color: {{ $category['color'] }}" @endif
                        >
                            <div class="category-header">
                                {{ $category['title'][app()->getLocale()] }}
                            </div>
                            <div class="nav-columns">
                                <div class="column type-1">
                                    <ul class="nav child-menu">
                                        @foreach ($category['pages'] as $subLinksMenu)
                                            <li>
                                                <a href="{{ $subLinksMenu['link'][app()->getLocale()] }}">
                                                    <div class="flex-menu">
                                                        <div class="padding-sub-menu">
                                                            @if (!empty($subLinksMenu['icon']))
                                                                <span class="menu-logo rnavicon-{{ $subLinksMenu['icon'] }}"></span>
                                                            @endif
                                                        </div>
                                                        <div>{{ $subLinksMenu['title'][app()->getLocale()] }}</div>
                                                    </div>
                                                </a>
                                            </li>
                                        @endforeach
                                        @if (!empty($category['promotions']))
                                            <hr>
                                            <span>{{ trans('global.promotions') }}</span>
                                            <ul class="nav nav-links-article">
                                                @foreach ($category['promotions'] as $promotions)
                                                    <li>
                                                        <a href="{{ $promotions['link'][app()->getLocale()] }}">
                                                            {{ $promotions['title'][app()->getLocale()] }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </ul>
                                </div>
                                <div class="column type-1">
                                    <span>{{ trans('global.related-article') }}</span>
                                    <ul class="nav nav-links-article">
                                        @foreach ($category['related_articles'][app()->getLocale()] as $article)
                                            <li>
                                                <a href="{{ $article['link'] }}">
                                                    {{ $article['title'] }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                @if (!empty($category['ads_id']))
                                    <div class="column type-1">
                                        <div id='{{ $category['ads_id'] }}' class="center-block"
                                             style='height:250px; width:300px;'>
                                            <script type='text/javascript'>
                                                googletag.cmd.push(function() {
                                                    googletag.defineSlot('/33470958/lv1:rf_lv2:all_lv3:all_ty:rectangle_ar:nav{{ $cateKey }}_dv:desktop', [300, 250], '{{ $category['ads_id'] }}').addService(googletag.pubads());
                                                    googletag.pubads().enableSingleRequest();
                                                    googletag.enableServices();
                                                });
                                            </script>
                                            <script type='text/javascript'>
                                                googletag.cmd.push(function() {
                                                    googletag.display('{{ $category['ads_id'] }}');
                                                });
                                            </script>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            </li>
        @endforeach
    </ul>
</nav>
