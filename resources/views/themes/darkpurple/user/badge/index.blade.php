@extends($theme.'layouts.user')
@section('title', 'badges')

@section('content')

    <div class="container-fluid">
        <div class="main row">
            <div class="col-12">
                <div
                    class="d-flex justify-content-between align-items-center mb-3"
                >
                    <h3 class="mb-0">@lang('All Badges')</h3>
                </div>

                <div class="col-xl-12 col-md-12">
                        @if($allBadges)
                            <div class="badge-box-wrapper">
                                <div class="row g-4 mb-4">
                                    @foreach($allBadges as $key => $badge)
                                        <div class="col-xl-3 col-md-6 box">
                                            <div class="badge-box">
                                                <img src="{{ getFile(config('location.rank.path').@$badge->rank_icon) }}" alt="" />
                                                <h3>@lang($badge->rank_lavel)</h3>
                                                <p>@lang($badge->description)</p>
                                                <div class="text-start">
                                                    <h5>@lang('Minimum Invest'): <span>{{ $basic->currency_symbol }}{{ @$badge->min_invest }}</span></h5>
                                                    <h5>@lang('Minimum Deposit'): <span>{{ $basic->currency_symbol }}{{ @$badge->min_deposit }}</span></h5>
                                                    <h5>@lang('Minimum Earning'): <span>{{ $basic->currency_symbol }}{{ @$badge->min_earning }}</span></h5>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                </div>

            </div>
        </div>
    </div>







{{--    <section class="payment-gateway mt-5 pt-5">--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="col">--}}
{{--                    <div class="header-text-full">--}}
{{--                        <h2>@lang('badges')</h2>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-xl-12 col-md-7">--}}
{{--                <div class="dashboard-box">--}}
{{--                    <h5>@lang('Referral Link')</h5>--}}
{{--                    <div class="input-group mb-3 cutom__referal_input__group">--}}
{{--                        <input type="text" class="form-control copy__referal__input" value="{{route('register.sponsor',[Auth::user()->username])}}" id="sponsorURL" readonly>--}}
{{--                        <button class="input-group-text btn-custom copy__referal__btn copytext" id="copyBoard" onclick="copyFunction()">@lang('copy link')</button>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            @if($allBadges)--}}
{{--                <div class="badge-box-wrapper">--}}
{{--                    <div class="row g-4 mb-4">--}}
{{--                        @foreach($allBadges as $key => $badge)--}}
{{--                            <div class="col-xl-3 col-md-6 box">--}}
{{--                                <div class="badge-box">--}}
{{--                                    <img src="{{ getFile(config('location.rank.path').@$badge->rank_icon) }}" alt="" />--}}
{{--                                    <h3>@lang($badge->rank_lavel)</h3>--}}
{{--                                    <p>@lang($badge->description)</p>--}}
{{--                                    <div class="text-start">--}}
{{--                                        <h5>@lang('Minimum Invest'): <span>{{ $basic->currency_symbol }}{{ @$badge->min_invest }}</span></h5>--}}
{{--                                        <h5>@lang('Minimum Deposit'): <span>{{ $basic->currency_symbol }}{{ @$badge->min_deposit }}</span></h5>--}}
{{--                                        <h5>@lang('Minimum Earning'): <span>{{ $basic->currency_symbol }}{{ @$badge->min_earning }}</span></h5>--}}
{{--                                    </div>--}}
{{--                                    <div class="lock-icon">--}}
{{--                                        <i class="fa fa-lock"></i>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        @endforeach--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            @endif--}}

{{--        </div>--}}
{{--    </section>--}}

@endsection



@push('script')

    <script>
        'use strict'
        $(document).ready(function () {
            var getProductHeight = $(".product.active").height();

            $(".products").css({
                height: getProductHeight
            });

            function calcProductHeight() {
                getProductHeight = $(".product.active").height();

                $(".products").css({
                    height: getProductHeight
                });
            }

            function animateContentColor() {
                var getProductColor = $(".product.active").attr("product-color");

                $("body").css({
                    color: getProductColor
                });

                $(".title").css({
                    color: getProductColor
                });

                $(".btn").css({
                    color: getProductColor
                });
            }

            var productItem = $(".product"),
                productCurrentItem = productItem.filter(".active");

            $("#next").on("click", function (e) {
                e.preventDefault();

                var nextItem = productCurrentItem.next();

                productCurrentItem.removeClass("active");

                if (nextItem.length) {
                    productCurrentItem = nextItem.addClass("active");
                } else {
                    productCurrentItem = productItem.first().addClass("active");
                }

                calcProductHeight();
                animateContentColor();
            });

            $("#prev").on("click", function (e) {
                e.preventDefault();

                var prevItem = productCurrentItem.prev();

                productCurrentItem.removeClass("active");

                if (prevItem.length) {
                    productCurrentItem = prevItem.addClass("active");
                } else {
                    productCurrentItem = productItem.last().addClass("active");
                }

                calcProductHeight();
                animateContentColor();
            });

            // Ripple
            $("[ripple]").on("click", function (e) {
                var rippleDiv = $('<div class="ripple" />'),
                    rippleSize = 60,
                    rippleOffset = $(this).offset(),
                    rippleY = e.pageY - rippleOffset.top,
                    rippleX = e.pageX - rippleOffset.left,
                    ripple = $(".ripple");

                rippleDiv
                    .css({
                        top: rippleY - rippleSize / 2,
                        left: rippleX - rippleSize / 2,
                        background: $(this).attr("ripple-color")
                    })
                    .appendTo($(this));

                window.setTimeout(function () {
                    rippleDiv.remove();
                }, 1900);
            });
        });

    </script>

@endpush
