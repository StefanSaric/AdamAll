<?php  use \App\Http\Controllers\HomeController; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <title>ADAMALL</title>
    <meta name="keywords" content="ADAMALL, tržni, centar, ada, delta, ušće, karaburma, šoping, shopping, mall, center, big, fashion">
    <meta name="description" content="AdamAll - Our Top Shopping Destinations in Belgrade.">
    <meta name="author" content="EXE4U">

    <link rel="canonical" href="http://adamall.rs/">
    <meta property="og:title" content="ADAMALL">
    <meta property="og:type" content="website">
    <meta property="og:url" content="http://adamall.rs/">
    <meta property="og:image" content="http://adamall.rs/images/shareimage.png">
    <meta property="og:site_name" content="ADAMALL">
    <meta property="og:description" content="Saznajte sve o najboljim šoping destinacijama u Beogradu.">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:url" content="http://adamall.rs/">
    <meta name="twitter:title" content="ADAMALL">
    <meta name="twitter:description" content="Saznajte sve o najboljim šoping destinacijama u Beogradu.">
    <meta name="twitter:image" content="http://adamall.rs/images/shareimage.png">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-140306014-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'UA-140306014-1');
    </script>

    <!-- Google AdSense -->
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({
            google_ad_client: "ca-pub-4153904174543229",
            enable_page_level_ads: true
        });
    </script>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset("images/site/favicon.ico")}}"/>
    <!-- Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic%7CPlayball%7CMontserrat:400,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,300,300italic,400italic,700italic' rel='stylesheet' type='text/css'>

    <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css" href="{{asset("assets/css/site/bootstrap.min.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("assets/css/site/bootstrap-theme.min.css")}}">

    <!-- Fontawesome -->
    <link rel="stylesheet" type="text/css" href="{{asset("assets/css/site/font-awesome.min.css")}}">

    <!-- Swiper -->
    <link rel="stylesheet" type="text/css" href="{{asset("assets/css/site/swiper.min.css")}}">
    <!-- Magnific-popup -->
    <!-- instagram section-->


    <link rel="stylesheet" type="text/css" href="{{asset("assets/css/site/style.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("assets/css/site/welcome.css")}}">

</head>
<body>
<header id="header">
    <div class="annotation">
        <p> <i class="lgbt1">Our</i> <i class="lgbt2">Top</i> <i class="lgbt3">Shopping</i> <i class="lgbt4">Destinations</i> <i class="lgbt5">in</i> <i class="lgbt6">Belgrade.</i></p>
    </div>
    <div class="logo" data-bg-image="{{asset("images/site/bg-header.jpg")}}">
        <h1>
            <a href="index.html"><i class="weare">ADAM</i><i class="wearem"></i>ALL</a>
        </h1>
    </div>
    <div class="menu-container">
        <div class="container">
            <div class="row">
                <div  class="col-md-7 col-xs-5">
                    <nav class="main-nav">
                        <ul>
                            <li class="current-menu-item">
                                <a href="index.html">Početna</a>
                            </li>
                            <li><a href="#vest_013">Novosti</a></li>
                            <li><a href="#prijava">Prijava</a></li>
                            <li><a href="#najnovije">Najčitanije vesti</a></li>
                            <li><a href="#lokacija">Lokacija</a></li>
                            <li><a href="#footer">Kontakt</a></li>
                        </ul>
                        <a href="javascript:;" id="close-menu"> <i class="fa fa-close"></i></a>
                    </nav>
                </div>
                <div class="col-md-5 col-xs-7 h-search">
                    <form class="search_form hidden-xs">
                        <input type="text" name="2" placeholder="Pretraži...">
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </form>
                    <div class="head-social">
                        <!-- <a class="socials" href="#"><i class="fa fa-facebook"></i></a> -->
                        <!-- <a class="socials" href="#"><i class="fa fa-twitter"></i></a> -->
                        <!-- <a class="socials" href="#"><i class="fa fa-pinterest"></i></a> -->
                        <a class="socials" href="https://www.instagram.com/adamall.rs/" target="_blank"><i class="fa fa-instagram"></i> PRATITE NAS</a>
                        <!-- <a class="socials" href="#"><i class="fa fa-rss"></i></a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<section class="section-content">
    <div class="offers mobscroll">
        <div class="row mobscrollw">
            @foreach($ads as $ad)

                <!--column-->
                <article class="one-fourth">
                    <figure><a href="{{$ad->image_link}}" target="_blank" title="{{$ad->image_title}}">
                        <img class="promoimg" src="{{asset($ad->image)}}" alt=""></a></figure>
                        <div class="details">
                        <h3>{{$ad->text}}</h3>
                        @if($ad->link_type == 'instagram')

                             <a href="{{$ad->link}}" target="_blank" title="{{$ad->link_title}}" ><i class="fa fa-instagram"></i><span>{{$ad->link_text}}</span></a>
                        @elseif($ad->link_type == 'website')

                            <a href="{{$ad->link}}" target="_blank" title="{{$ad->link_title}}" ><i class="fa fa-desktop"></i><span>{{$ad->link_text}}</span></a>
                        @elseif($ad->link_type == 'playstore')

                            <a href="{{$ad->link}}" target="_blank" title="{{$ad->link_title}}" ><i class="fa fa-play"></i><span>{{$ad->link_text}}</span></a>
                        @endif

                        </div>
                </article>
                <!--//column-->
                @endforeach
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-md-8">
            @foreach($posts as $post)
            @if($post->category->name == 'Vest')

                <article id="Vest_{{$post->id}}" class="content-item">
                    <div class="entry-media">
                    @foreach($news as $one_news)
                            @if("Vest_{$post->id}" == $one_news->post_link)

                        <div class="post-ribbon">
                           <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
                                     y="0px" viewBox="0 0 34 50" enable-background="new 0 0 34 50" xml:space="preserve">
								<g>
                                    <polygon fill-rule="evenodd" clip-rule="evenodd"
                                             points="17,40.7 0.5,49.2 0.5,0.5 33.5,0.5 33.5,49.2"/>
                                    <path d="M33,1v47.4l-15.5-8L17,40.2l-0.5,0.2L1,48.4V1H33 M34,0H0v50l17-8.7L34,50V0L34,0z"/>
                                </g>
                           </svg>
                           <i class="fa fa-star"></i>
                        </div>
                    @endif
                    @endforeach

                    <div class="post-title">
                        <h2><a href="#">{{$post->title}}</a></h2>
                        <div class="entry-date">
                            <ul>
                                <li><a href='#'>{{$post->category->name}}</a></li>
                                <li>{{date('d.M.Y',strtotime($post->date))}}</li>
                                <li>izvor vesti: <a target="_blank" href='{{$post->link}}'>{{$post->source}}</a></li>
                            </ul>
                        </div>
                    </div>
                        <div class="bubble-line"></div>
                        <div class="post-content">
                             @if($post->type->name == 'Slika')

                                <img src="{{asset($post->materials->first()->url)}}" alt="not image">
                             @elseif($post->type->name == 'Video')

                                <video controls
                                       autoplay
                                       muted
                                       loop
                                       src="{{asset($post->materials->first()->url)}}">
                                    Sorry, your browser doesn't support embedded videos.
                                </video>
                                @elseif($post->type->name == 'Slider')

                                <div class="content_slide">
                                    <div class="swiper-container">
                                        <div class="swiper-wrapper s-slide-wrapper">
                                        @foreach($post->materials as $material)

                                        <div class="swiper-slide"><img src="{{asset($material->url)}}" alt="image"></div>
                                        @endforeach
                                        </div>
                                        <div class="swiper-button-prev circle-arrow"><i class="fa fa-chevron-left"></i></div>
                                        <div class="swiper-button-next circle-arrow"><i class="fa fa-chevron-right"></i></div>
                                    </div>
                                </div>
                                @elseif($post->type->name == 'Galerija')

                                <div class="container gallery">
                                    <div class="row">
                                        @for($i = 0;$i <= $post->materials->count() -1;$i++)
                                            @if($i<2)

                                            <div class="col-xs-6 photos ">
                                                <div href="javascript:;"><img src="{{asset($post->materials[$i]->url)}}" alt="not image"></div>
                                            </div>

                                            @elseif($i>5)

                                            <div class="col-xs-1 photos ">
                                                <div href="javascript:;"><img src="{{asset($post->materials[$i]->url)}}" alt="not image"></div>
                                            </div>

                                            @else

                                            <div class="col-xs-3 photos ">
                                                <div href="javascript:;"><img src="{{asset($post->materials[$i]->url)}}" alt="not image"></div>
                                            </div>
                                            @endif
                                        @endfor
                                    </div>
                                </div>
                                @endif

                                    <p>{!!$post->text!!}</p>
                                    <div>
                                        <hr class="post-horizontal-rule">
                                        <br>
                                        <h5>Potpisnik: {{$post->signature}}</h5>
                                    </div>
                                    {{--                        <div class="post-footer">--}}
                                    {{--                            <div class="row">--}}
                                    {{--                                <div class="col-sm-5">--}}
                                    {{--                                    <a href="https://www.facebook.com/sharer/sharer.php?u=adamall.rs" target="_blank" class="button">Podelite ovu vest</a>--}}
                                    {{--                                </div>--}}
                                    {{--                                <div class="col-sm-7 text-right">--}}
                                    {{--                                    <div class="content-social">--}}
                                    {{--                                        <a href="https://www.instagram.com/adamall.rs/" target="_blank"><i class="fa fa-instagram"></i><span>Instagram</span></a>--}}
                                    {{--                                    </div>--}}
                                    {{--                                </div>--}}
                                    {{--                            </div>--}}
                                    {{--                        </div>--}}
                        </div>
                    </div>
                </article>
            @elseif($post->category->name == 'Izjava')

                <article id="Izjava_{{$post->id}}" class="content-item">
                    <div class="entry-media">
                      <div class="post-content">
                        <div class="post-icon">
                           <p></p>
                        </div>
                          <h4>{!!$post->text!!}</h4>
                          <hr class="post-horizontal-rule">
                          <br>
                          <p class="sub-title">{{$post->signature}}</p>
                      </div>
                    </div>
                </article>
            @endif
            @endforeach
            </div>
                <!--
                                <div class="post-navigation">
                                    <ul>
                                        <li><span>1</span></li>
                                        <li><a href="javascript:;">2</a></li>
                                        <li><a href="javascript:;">3</a></li>
                                        <li><a href="javascript:;"> <i class="fa fa-chevron-right"></i> </a></li>
                                    </ul>
                                </div>
                -->
            <div class="col-sm-4 sidebar">
                <div id="lokacija" class="widget">
                    <h3 class="widget-title">Lokacija</h3>
                    <div class="bubble-line"></div>

                    <div class="widget-content">
                        <img src="{{asset("images/site/widget/lokacija.jpg")}}" alt="not image">
                        <p>AdamAll objavljuje sve aktivnosti vezane za najbolje šoping destinacije u Beogradu, glavnom gradu Srbije. Pozivamo Vas da sa nama podelite i Vaša iskustva iz šopinga u ovom prelepom gradu na ušću dve velike evropske reke, Save u Dunav.</p>
                        <div class="widget-more">
                            <a href="https://www.google.rs/maps/place/The+Victor/@44.8273592,20.4231241,13.5z/data=!4m5!3m4!1s0x0:0xb73bbff29e600816!8m2!3d44.8230508!4d20.4476481?hl=en" target="_blank" class="button">Lokacija na mapi</a>
                        </div>
                    </div>
                </div>
                <!--
                                <div class="widget">
                                    <h3 class="widget-title">Category</h3>
                                    <div class="bubble-line"></div>
                                    <div class="widget-content">
                                        <ul>
                                            <li>
                                                <a href="javascript:;">Video & music</a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">Fashion</a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">Travel & hiking</a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">Photography</a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">food recipe</a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">do it yourself</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                -->
                <div id="najnovije" class="widget">
                    <h3 class="widget-title">Najčitanije vesti</h3>
                    <div class="bubble-line"></div>
                    <div class="widget-content">
                        @foreach($news as $one_news)

                        <div class="widget-recent">
                            <img src="{{asset($one_news->image)}}" alt="not image">
                            <h4><a href="#{{$one_news->post_link}}">{{$one_news->title}}</a></h4>
                            <p>{{$one_news->text}}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div id="reklame" class="widget">
                    <h3 class="widget-title">Reklame</h3>
                    <div class="bubble-line"></div>
                    <div class="widget-content">
                        <div class="widget-recent">
                            <img src="{{asset($commercials->image)}}" alt="not image">
                            <h4><a href="{{$commercials->link}}"  title="{{$commercials->image_tag}}" target="_blank">{{$commercials->title}}</a></h4>
                            <p>{!!$commercials->text!!}</p>
                        </div>
                    </div>
                </div>
                <div id="prijava" class="widget widget-sub">
                    <h5>Prijava</h5>
                    <p>Ukoliko ste zainteresovani po bilo kom pitanju u vezi AdamAll projekta prijavite se na našu listu.</p>
                    <div class="widget-sub-s">
                        <form method="post" action={{ url('/storesite') }} class="sign_up_form">
                            {!! csrf_field() !!}
                            <input type="email" id="email" name="email" placeholder="email" value="email"required="required" />
                            <input type="submit" value="prijava" id="submit-button" class="button color-y" />
                        </form>
                    </div>
                </div>
                <!--
                                <div class="widget">
                                    <h3 class="widget-title">Cloudy tags</h3>
                                    <div class="bubble-line"></div>
                                    <div class="widget-content">
                                        <div class="widget-tags">
                                            <a href="javascript:;">clean</a>
                                            <a href="javascript:;">minimal</a>
                                            <a href="javascript:;">cloudy</a>
                                            <a href="javascript:;">video</a>
                                            <a href="javascript:;">template</a>
                                            <a href="javascript:;">fashion</a>
                                            <a href="javascript:;">bloggers</a>
                                            <a href="javascript:;">carefully</a>
                                            <a href="javascript:;">handcrafted</a>
                                            <a href="javascript:;">print</a>
                                            <a href="javascript:;">psd</a>
                                            <a href="javascript:;">music</a>
                                            <a href="javascript:;">food recipe</a>

                                        </div>
                                    </div>
                                </div>
                                <div class="widget-sub social">
                                    <ul>
                                        <li>
                                            <a class="social-widget" href="javascript:;"> <i class="fa fa-facebook"> </i><span> share</span></a>
                                            <div> 211</div>

                                        </li>
                                        <li>
                                            <a class="social-widget" href="javascript:;"> <i class="fa fa-twitter"></i> <span>follow</span></a>
                                            <div> 121</div>
                                        </li>
                                        <li>
                                            <a class="social-widget" href="javascript:;"> <i class="fa fa-google-plus"></i> <span> share </span></a>
                                            <div> 11</div>
                                        </li>
                                        <li>
                                            <a class="social-widget" href="javascript:;"> <i class="fa fa-instagram"></i> <span> follow  </span></a>
                                            <div>65</div>
                                        </li>

                                    </ul>

                                </div>
                                <div class="widget">
                                    <h3 class="widget-title">Buy this Theme</h3>
                                    <div class="bubble-line"></div>
                                    <div class="widget-content sm ">
                                        <p>
                                            Vivamus interdum felis posuere justo
                                            condimentum, in consequat libero lacinia. Vestibulum eget viverra nulla. Curabitur
                                            feugiat vulputate consectetur.
                                        </p>
                                        <div class="widget-more">
                                        <a href="javascript:;" class="button">purchase</a>
                                        </div>
                                    </div>
                                </div>
                -->
            </div>
        </div>
    </div>
</section>
<footer id="footer">
<!--
	<div class="instagram-follow">
		<h2><a href="#">PRATITE NAS NA INSTAGRAMU</a></h2>
	</div>

	<div class="footer-slide">
		<div class="jcarousel">
			<ul class="social-instafeeds">
			</ul>
		</div>
		<a href="#" class="jcarousel-control-prev"><i class="fa fa-chevron-left"></i></a>
		<a href="#" class="jcarousel-control-next"><i class="fa fa-chevron-right"></i></a>
		<div class="swiper-center"><a href="javascript:;"><i class="fa fa-instagram"></i>ADA MALL</a></div>
	</div>
-->
    <div class="sub-footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="widget footer-cp-text">
                        <p>
                            &copy; 2016. All rights reserved. AdamAll website made by <a href="http://exe4u.com" target="_blank">EXE4U</a>  studio.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<script type="text/template" id="tpl-bubble-left">
    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 15 30" enable-background="new 0 0 15 30" xml:space="preserve">
            <path fill-rule="evenodd" clip-rule="evenodd" fill="none" stroke="#000000" stroke-miterlimit="10" d="M0,29.4c0,0,7.5,0,7.5-7c0,0,7,0,7-7c0-0.1,0-0.1,0-0.2c0-0.1,0-0.1,0-0.2c0-7-7-7-7-7c0-7-7.5-7-7.5-7"/>
        </svg>
</script>
<script type="text/template" id="tpl-bubble-right">
    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 15 30" enable-background="new 0 0 15 30" xml:space="preserve">
            <path fill-rule="evenodd" clip-rule="evenodd" fill="none" stroke="#000000" stroke-miterlimit="10" d="M15,29.4c0,0-7.5,0-7.5-7c0,0-7,0-7-7c0-0.1,0-0.1,0-0.2c0-0.1,0-0.1,0-0.2c0-7,7-7,7-7c0-7,7.5-7,7.5-7"/>
        </svg>
</script>

<!-- Include jQuery and Scripts -->
<script type="text/javascript" src="{{asset("assets/js/site/jquery.min.js")}}"></script>
<script type="text/javascript" src="{{asset("assets/js/site/jquery.jcarousel.min.js")}}"></script>

<script type="text/javascript" src="{{asset("assets/js/site/vendors/bootstrap/js/bootstrap.min.js")}}"></script>
<script type="text/javascript" src="{{asset("assets/js/site/vendors/jquery.waypoints.min.js")}}"></script>
<script type="text/javascript" src="{{asset("assets/js/site/vendors/isotope.pkgd.min.js")}}"></script>
<!-- Swiper -->
<script type="text/javascript" src="{{asset("assets/js/site/vendors/swiper/js/swiper.min.js")}}"></script>
<!-- Magnific-popup -->
<script type="text/javascript" src="{{asset("assets/js/site/scripts.js")}}"></script>
<script type="text/javascript" src="{{asset("assets/js/site/jcarousel.responsive.js")}}"></script>
<!-- instagram -->
<script type="text/javascript" src="{{asset("assets/js/site/vendors/instafeed/instagramLite.js")}}"></script>
<script type="text/javascript" src="{{asset("assets/js/site/vendors/instafeed/instafeed.min.js")}}"></script>

<script>
    $('.main-nav a').click(function() {
        var navbar_toggle = $('#close-menu');
        if (navbar_toggle.is(':visible')) { alert('radi');
//			$('nav.main-nav.show-menu').removeClass('show-menu');
//			return false;
//			navbar_toggle.trigger('click');
            $('.main-nav').trigger('click');
//			$('.main-nav').click();
        }
    });
</script>


</body>
</html>
