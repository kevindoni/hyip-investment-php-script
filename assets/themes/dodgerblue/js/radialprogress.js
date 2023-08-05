$(function(){
    $('svg.radial-progress').each(function( index, value ) { 
        $(this).find($('circle.complete')).removeAttr( 'style' );
    });
    $(window).scroll(function(){
        $('svg.radial-progress').each(function( index, value ) { 
            console.log('Circle Progress')
            if ( 
                $(window).scrollTop() > $(this).offset().top - ($(window).height() * 0.75) &&
                $(window).scrollTop() < $(this).offset().top + $(this).height() - ($(window).height() * 0.25)
            ) {
                percent = $(value).data('percentage');
                radius = $(this).find($('circle.complete')).attr('r');
                circumference = 2 * Math.PI * radius;
                strokeDashOffset = circumference - ((percent * circumference) / 100);
                $(this).find($('circle.complete')).animate({'stroke-dashoffset': strokeDashOffset}, 1250);
            }
        });
    }).trigger('scroll');
});