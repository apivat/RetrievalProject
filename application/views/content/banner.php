<script type="text/javascript">
    $(document).ready(function () {
		
        //jCarousel Plugin
        $('#carousel').jcarousel({
            vertical: true,
            scroll: 1,
            auto: 4,
            wrap: 'last',
            initCallback: mycarousel_initCallback
        });

        //Front page Carousel - Initial Setup
        $('div#slideshow-carousel a img').css({'opacity': '0.5'});
        $('div#slideshow-carousel a img:first').css({'opacity': '1.0'});
        $('div#slideshow-carousel li a:first').append('<span class="arrow"></span>')

  
        //Combine jCarousel with Image Display
        $('div#slideshow-carousel li a').hover(
       	function () {
        		
            if (!$(this).has('span').length) {
                $('div#slideshow-carousel li a img').stop(true, true).css({'opacity': '0.5'});
                $(this).stop(true, true).children('img').css({'opacity': '1.0'});
            }		
       	},
       	function () {
        		
            $('div#slideshow-carousel li a img').stop(true, true).css({'opacity': '0.5'});
            $('div#slideshow-carousel li a').each(function () {

                if ($(this).has('span').length) $(this).children('img').css({'opacity': '1.0'});

            });
        		
       	}
    ).click(function () {

            $('span.arrow').remove();        
            $(this).append('<span class="arrow"></span>');
            $('div#slideshow-main li').removeClass('active');        
            $('div#slideshow-main li.' + $(this).attr('rel')).addClass('active');	
        	
            return false;
        });


    });


    //Carousel Tweaking

    function mycarousel_initCallback(carousel) {
	
        // Pause autoscrolling if the user moves with the cursor over the clip.
        carousel.clip.hover(function() {
            carousel.stopAuto();
        }, function() {
            carousel.startAuto();
        });
    }
	
</script>
<div id="welcomeHero">

    <div id="slideshow-main">
        <ul>
            <?php foreach ($result_treval_logo as $key => $banner): ?>
                <li class="p<?=($key+1)?> <?php if(($key+1)=='1'):?>active<?php endif;?>">
                    <a href="<?=base_url()?>tourist/detail/<?=$banner->tourist_id?>">
                        <img src="<?= base_url() ?>public/img/<?=str_replace('_thumb','',$banner->thumbnail)?>" width="430" height="290" alt=""/>
                        <span class="opacity"></span>
                        <span class="content"><h1><?=$banner->title?></h1><p><?=$banner->caption?></p></span>
                    </a>
                </li>            
            <?php endforeach; ?>
        </ul>										
    </div>

    <div id="slideshow-carousel">				
        <ul id="carousel" class="jcarousel jcarousel-skin-tango">
            <?php foreach ($result_treval_logo as $key => $banner): ?>
            <li><a href="#" rel="p<?=($key+1)?>"><img src="<?= base_url() ?>public/img/<?=str_replace('_thumb','',$banner->thumbnail)?>" width="206" height="95" alt="#"/></a></li>
            <?php endforeach; ?>
        </ul>
    </div>

    <div class="clear"></div>

</div>

