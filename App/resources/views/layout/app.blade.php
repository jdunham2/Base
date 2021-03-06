<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<title>
    @yield('title') | Shop4Autos Pennysaver Evesun
</title>
<head>
    <!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
			new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
			j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
			'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-5WKCZM');</script>
	<!-- End Google Tag Manager -->

    <meta name="description" content="@yield('meta-description')">
    <meta name="keywords" content="@yield('meta-keywords') @yield('title') @yield('meta-description')">
    <meta name="google-site-verification" content="g-O5fFp7dY9hYi0kIjCsTfRXVgVuA_ml-VraMQmOkhA"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <!-- CSS -->
    <link rel="stylesheet" href="/css/main_purged.css">

    <link href='/css/override.css' type='text/css' rel='stylesheet'>
    <link href="/css/base.css" type="text/css" rel="stylesheet">
    <link href="/css/layout.css" type="text/css" rel="stylesheet">
    <link href="/css/module.css" type="text/css" rel="stylesheet">
    <link href="/css/theme.css" type="text/css" rel="stylesheet">

    <!-- Lib CSS -->
    <link href="/css/bootstrap.css" rel="stylesheet">
    <link href='/css/libs/flexslider.2.7/flexslider.css' type='text/css' rel='stylesheet'>


    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="/js/html5shiv.js"></script>
    <script src="/js/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript" src="/js/jquery.min.js"></script>
    <script type="text/javascript" src="/js/functions.js"></script>
    <script type="text/javascript" src="/js/helpers.js"></script>


    <!--DFP header info-->
    <script type='text/javascript'>
        (function () {
            var useSSL = 'https:' == document.location.protocol;
            var src = (useSSL ? 'https:' : 'http:') +
                '//www.googletagservices.com/tag/js/gpt.js';
            document.write('<scr' + 'ipt src="' + src + '"></scr' + 'ipt>');
        })();
    </script>

    <script type='text/javascript'>
        googletag.cmd.push(function () {
//			googletag.defineSlot('/1011200/Autos_Med_Block_1', [300, 100], 'div-gpt-ad-1463775618029-0').addService(googletag.pubads());
//			googletag.defineSlot('/1011200/Autos_Med_Block_2', [300, 100], 'div-gpt-ad-1463775618029-1').addService(googletag.pubads());
            googletag.defineSlot('/1011200/Autos_Med_Block_3', [300, 250], 'div-gpt-ad-1471895994924-0').addService(googletag.pubads());
            googletag.defineSlot('/1011200/Autos_Med_Block_4', [300, 250], 'div-gpt-ad-1471895994924-1').addService(googletag.pubads());
            googletag.defineSlot('/1011200/Autos_Med_Block_5', [300, 250], 'div-gpt-ad-1471895994924-2').addService(googletag.pubads());
            googletag.pubads().enableSingleRequest();
            googletag.pubads().enableSyncRendering();
            googletag.enableServices();
        });
    </script>
    <!--END DFP header info-->
</head>
<body>

<!-- Google Tag Manager (noscript) -->
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5WKCZM"
            height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->


<div class="top-container">
    <div class="container">
        <!-- Large Top Links-->
        <div class="col-md-4 col-md-offset-8 col-sm-12 text-right no-right-padding zindex-0">
            <!--Powered by-->
            <div class="clear"></div>
            <div class="col-xs-12 text-right powered-by">Powered by: Pennysaver & MyShopper</div>


            @include("old.extensions.login_links_tag")

        </div>

        <!--Desktop Shop4Autos Logo-->
        <div class="container">
			<span class="col-sm-6">
				<a href="/"><img src="/images/shop4autos_logo2.png" class="header-logo"/></a>
			</span>
        </div>

        <div class="header-browse_count text-right no-right-padding visible-xs visible-sm padding_5">
            <a href="/search"><span class="browse_count"> Browse over 4000 Vehicles </span></a>
        </div>

        <!--&lt;!&ndash;Mobile Shop4Autos Logo&ndash;&gt;-->
        <!--<div class="col-xs-12 center-xs hidden-lg hidden-md zindex-1">-->
        <!--<br/>-->
        <!--<a href="/"><img src="/images/shop4autoslogomobile.png" class="site-logo"/></a>-->
        <!--</div>-->

    </div>
</div>
<div class="clear"></div>


<div class="nav-container">
    <div class="container">
        <div class="pull-left visible-xs visible-sm padding_5">

            <a href="javascript:ShowHide('nav_menu')" class="expand_menu_link">
                <img src="/images/menu-grid.gif" alt="expand menu"/> Menu </a>

        </div>
        <div class="clearfix"></div>
        <div id="nav_menu" class="hide-sm navbar-collapse no-left-padding">

            <ul class="nav navbar-nav">
                @include("layout.main_nav")
            </ul>

        </div>
    </div>
</div>

<div class="container">

    <div id="main_panel" class="col-md-9 text-left no-left-padding">
        @yield('content')
    </div>

    <div class="col-md-3">
        @yield('sidebar')
        <hr class="top-bottom-margin"/>
        <br/>
    </div>
    <div id="right_panel" class="col-md-3">
        @include("old.extensions.aside_ads_tag")
        <hr class="top-bottom-margin"/>
        <br/>
    </div>


</div>

@section('footer')
    <div class="text-center">
        <div class="col-sm-12">
            <div class="navbar top-nav-back navbar-default">
                <ul class="bottom-nav-menu">
                    <li><a href="/">Home</a></li>

                    <li><a href="/index.php?page=en_About+us">About us</a></li>

                    <li><a href="/index.php?page=en_Questions">Questions</a></li>

                    <li><a href="/index.php?page=en_Contact">Contact</a></li>

                    <li><a href="javascript:ShowLogin()">Dealer Login</a></li>

                    <li><a href="/loan_calculator">Loan Calculator</a></li>
                </ul>

                <div class="text-center big-white-font" style="color:#5f626f; margin:35px;">Powered By:</div>
                <div class="col-md-3 col-md-offset-3 no-left-padding center-xs">
                    <a href="http://www.pennysaveronline.com"><img src="/images/ps_logo.jpg" class="site-logo"
                                                                   style="max-width:200px;"/></a>
                </div>
                <div class="col-md-3 no-left-padding center-xs">
                    <a href="http://www.myshopperonline.com"><img src="/images/shopperlogo.gif" class="site-logo"
                                                                  style="max-width:200px;"/></a>
                </div>
            </div>
        </div>

    </div>

    @include("old.extensions.login_form_tag")
@show
<script src="/js/bootstrap.js"></script>

</body>
</html>