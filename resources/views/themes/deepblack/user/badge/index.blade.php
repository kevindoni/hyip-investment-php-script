@extends($theme.'layouts.user')
@section('title', 'badges')

@section('content')
    <section class="payment-gateway mt-5 pt-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="header-text-full">
                        <h2>@lang('badges')</h2>
                    </div>
                </div>
            </div>
            @if($allBadges)
                <div class="badge-box-wrapper">
                    <div class="row g-4 mb-4">
                        @foreach($allBadges as $key => $badge)
                            <div class="col-xl-3 col-md-6 box">
                                <div class="badge-box">
                                    <img src="{{ getFile(config('location.rank.path').@$badge->rank_icon) }}" alt="" />
                                    <h3>@lang($badge->rank_lavel)</h3>
                                    <p class="mb-3">@lang($badge->description)</p>
                                    <div class="text-start">
                                        <h5>@lang('Minimum Invest'): <span>{{ $basic->currency_symbol }}{{ @$badge->min_invest }}</span></h5>
                                        <h5>@lang('Minimum Deposit'): <span>{{ $basic->currency_symbol }}{{ @$badge->min_deposit }}</span></h5>
                                        <h5>@lang('Minimum Earning'): <span>{{ $basic->currency_symbol }}{{ @$badge->min_earning }}</span></h5>
                                    </div>
                                    <div class="lock-icon">
                                        <i class="fa fa-lock"></i>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </section>

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
                    background: getProductColor
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
