{{--
    Partial accepts these params:
    companyPhone        | required | String  | phone number to display and link
    logoLink            | default  | Mixed   | in case, we need to replace logo link - we can use this param;
                                               with 'disabled' we show only default logo (no link)
    hideElement         | optional | Array   | set of elements, which has to be hidden (slogan, menu, socials)
    disablePhoneBlock   | optional | Boolean | if set to {true}, phone block is gonna be hidden
    workDays            | default  | String  | work days description
--}}

<div class="new-sub-nav subnav-desktop @if (isset($hideElement) && $hideElement['menu']) new-sub-nav--hidden-menu @endif">
    <section class="sub-nav container-fluid navbar-fixed-top">
        <div class="hidden-xs hidden-sm">
            <div class="container container-double-logo">
                <div class="row">
                    <div class="col-sm-5">
                        <div class="nav-logo-section">
                            @if (isset($logoLink) && $logoLink === 'disabled')
                                <img alt="Rabbit finance" class="img-responsive logo"
                                     src="{{ asset('images/logo/rabbit/rabbit-finance-logo.svg') }}"
                                >
                            @else {{-- difference only in wrapper, img THE SAME --}}
                                <a
                                    @if (isset($logoLink))
                                        @if (isset($logoLink['route']))
                                            href="{{ route($logoLink['route'], $logoLink['route_vars']) }}"
                                        @else
                                            href="{{ $logoLink['link'] }}"
                                        @endif
                                    @else
                                        {{--@Todo add this to config--}}
                                        {{--href="{{ route('home-page') }}"--}}
                                    @endif
                                >
                                    <img alt="Rabbit finance" class="img-responsive logo"
                                         src="{{ asset('images/logo/rabbit/rabbit-finance-logo.svg') }}"
                                    >
                                </a>
                            @endif

                            @if (!(isset($hideElement) && $hideElement['slogan']))
                                <span class="hidden-xs hidden-sm slogan">
                                    @lang('global.rabbit-slogan')
                                </span>
                            @endif
                        </div>
                    </div>
                    @if (!$disablePhoneBlock)
                        <div class="col-sm-7">
                            <div class="detail-section pull-right">
                                @if (!$hidePhoneAndHour)
                       #1011             <div class="telephone-sect">
                                        <span class="contact-day">{{ $workDays ?? trans('navigation.work-days') }}</span>
                                        <span class="telephone">{{ phone_formatter($companyPhone) }}</span>
                                    </div>
                                @endif
                                <div class="social-sect">
                                    @if (!$hidePhoneAndHour)
                                        <a class="logo-link" href="tel:{{ $companyPhone }}">
                                            <img class="img-responsive logo"
                                                 src="{{ asset('images/nav-icons/call-rabbit.svg') }}"
                                            >
                                        </a>
                                    @endif
                                    @if (!(isset($hideElement) && $hideElement['social']))
                                        <a class="logo-link" href="{{ config('app.line-page.url') }}">
                                            <img class="img-responsive logo"
                                                src="{{ asset('images/nav-icons/line.svg') }}"
                                            >
                                        </a>
                                        <a class="logo-link" href="{{ config('app.facebook-page') }}">
                                            <img class="img-responsive logo"
                                                src="{{ asset('images/nav-icons/facebook.svg') }}"
                                            >
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                @if (!(isset($hideElement) && $hideElement['menu']))
                    @include('partials/navmenu', [
                        'submenuCms' => $subNavigationMenu
                    ])
                @endif
            </div>
        </div>
    </section>
    <div class="clearfix" id="subnav-padding"></div>
</div>
