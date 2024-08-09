<?php
    if(Session::has('locale')){
        $locale = Session::get('locale', Config::get('app.locale'));
    }
    else{
        $locale = env('DEFAULT_LANGUAGE');
    }
    $lang = \App\Models\Language::where('code', $locale)->first();
?>
<!DOCTYPE html>
<?php if($lang != null && $lang->rtl == 1): ?>
<html dir="rtl" lang="en">
<?php else: ?>
<html lang="en">
<?php endif; ?>
<head>

    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
	<meta name="app-url" content="<?php echo e(env('APP_URL')); ?>">
   
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <!-- Title -->
    <title><?php echo $__env->yieldContent('meta_title', get_setting('website_name').' | '.get_setting('site_motto')); ?></title>

    <!-- Required Meta Tags Always Come First -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="<?php echo $__env->yieldContent('meta_description', get_setting('meta_description')); ?>" />
    <meta name="keywords" content="<?php echo $__env->yieldContent('meta_keywords', get_setting('meta_keywords')); ?>">

    <?php echo $__env->yieldContent('meta'); ?>

    <?php if(!isset($page)): ?>
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="<?php echo e(config('app.name', env('APP_NAME'))); ?>">
    <meta itemprop="description" content="<?php echo e(get_setting('meta_description')); ?>">
    <meta itemprop="image" content="<?php echo e(custom_asset( get_setting('meta_image') )); ?>">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="product">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="<?php echo e(config('app.name', env('APP_NAME'))); ?>">
    <meta name="twitter:description" content="<?php echo e(get_setting('meta_description')); ?>">
    <meta name="twitter:creator" content="@author_handle">
    <meta name="twitter:image" content="<?php echo e(custom_asset( get_setting('meta_image'))); ?>">

    <!-- Open Graph data -->
    <meta property="og:title" content="<?php echo e(config('app.name', env('APP_NAME'))); ?>" />
    <meta property="og:type" content="Business Site" />
    <meta property="og:url" content="<?php echo e(env('APP_URL')); ?>" />
    <meta property="og:image" content="<?php echo e(custom_asset(get_setting('meta_image'))); ?>" />
    <meta property="og:description" content="<?php echo e(get_setting('meta_description')); ?>" />
    <meta property="og:site_name" content="<?php echo e(get_setting('website_name')); ?>" />
    <?php endif; ?>

    <!-- Favicon -->
    <link rel="icon" href="<?php echo e(custom_asset(get_setting('site_icon'))); ?>">

    <!-- CSS -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" href="<?php echo e(my_asset('assets/common/css/vendors.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(my_asset('assets/common/css/bootstrap-rtl.min.css')); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Cabin&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css" integrity="sha512-6lLUdeQ5uheMFbWm3CP271l14RsX1xtx+J5x2yeIDkkiBpeVTNhTqijME7GgRKKi6hCqovwCoBTlRBEC20M8Mg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <?php if($lang != null && $lang->rtl == 1): ?>
    <?php endif; ?>
    <link rel="stylesheet" href="<?php echo e(my_asset('assets/common/css/aiz-core.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(my_asset('assets/frontend/default/css/custom.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(my_asset('assets/frontend/default/css/user_register.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(my_asset('assets/frontend/default/css/responsive.css')); ?>">

    <script>
    	var AIZ = AIZ || {};
	</script>
    <style type="text/css">
        body{
            font-family: 'Montserrat', sans-serif;
            font-weight: 500;
        }
        :root{
            --primary: <?php echo e(get_setting('base_color', '#377dff')); ?>;
            --hov-primary: <?php echo e(get_setting('base_hov_color', '#0069d9')); ?>;
            --soft-primary: <?php echo e(hex2rgba(get_setting('base_hov_color','#377dff'),.15)); ?>;
        }
    </style>

    <?php if(get_setting('google_analytics_activation_checkbox') == 1): ?>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo e(env('GOOGLE_ANALYTICS_TRACKING_ID')); ?>"></script>

        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());
          gtag('config', '<?php echo e(env('GOOGLE_ANALYTICS_TRACKING_ID')); ?>');
        </script>
    <?php endif; ?>

    <?php if(get_setting('fb_pixel_activation_checkbox') == 1): ?>
        <!-- Facebook Pixel Code -->
        <script>
          !function(f,b,e,v,n,t,s)
          {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
          n.callMethod.apply(n,arguments):n.queue.push(arguments)};
          if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
          n.queue=[];t=b.createElement(e);t.async=!0;
          t.src=v;s=b.getElementsByTagName(e)[0];
          s.parentNode.insertBefore(t,s)}(window, document,'script',
          'https://connect.facebook.net/en_US/fbevents.js');
          fbq('init', <?php echo e(env('FACEBOOK_PIXEL_ID')); ?>);
          fbq('track', 'PageView');
        </script>
        <noscript>
          <img height="1" width="1" style="display:none"
               src="https://www.facebook.com/tr?id=<?php echo e(env('FACEBOOK_PIXEL_ID')); ?>/&ev=PageView&noscript=1"/>
        </noscript>
        <!-- End Facebook Pixel Code -->
    <?php endif; ?>

</head>
<body >
    <div class="aiz-main-wrapper d-flex flex-column">

        <div class="background-img overflow-hidden position-relative">

        <?php if(Request::is('/') || Request::is('influencer')): ?>
        <div class="absolute-full">
    			<div class="aiz-carousel aiz-carousel-full h-100" data-fade='true' data-infinite='true' data-autoplay='true'>
					<img src="<?php echo e(my_asset('/uploads/all/dMEGtsXCQ9vuN6yZWRB8enelaaaYbtGCwurMXAWI.png')); ?>" class="img-fluid">					
    			</div>
        </div>
        <?php endif; ?>
        
        <?php if(Request::is('register') || Request::is('register/freelancer') || Request::is('register/client') || Request::is('login') ||  Request::is('users/login')): ?>
            <?php echo $__env->yieldContent('content'); ?>
        <?php else: ?>

            <?php echo $__env->make('frontend/default.inc.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <!-- ========== MAIN CONTENT ========== -->

            <?php echo $__env->yieldContent('content'); ?>

            <!-- ========== END MAIN CONTENT ========== -->


            <?php echo $__env->make('frontend/default.inc.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
    </div>

          

    <?php echo $__env->yieldContent('modal'); ?>

    <?php if(get_setting('facebook_chat_activation_checkbox') == 1): ?>
        <script type="text/javascript">
            window.fbAsyncInit = function() {
                FB.init({
                  xfbml            : true,
                  version          : 'v3.3'
                });
              };

              (function(d, s, id) {
              var js, fjs = d.getElementsByTagName(s)[0];
              if (d.getElementById(id)) return;
              js = d.createElement(s); js.id = id;
              js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
              fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>
        <div id="fb-root"></div>
        <!-- Your customer chat code -->
        <div class="fb-customerchat"
          attribution=setup_tool
          page_id="<?php echo e(env('FACEBOOK_PAGE_ID')); ?>">
        </div>
    <?php endif; ?>

    <script src="<?php echo e(my_asset('assets/common/js/vendors.js')); ?>"></script>
    <script src="<?php echo e(my_asset('assets/common/js/aiz-core.js')); ?>"></script>
    
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>  
    
    <script src="<?php echo e(url('public/assets/common/js/inputEmoji.js')); ?>"></script>
    <script src="<?php echo e(url('public/assets/common/js/common.js')); ?>"></script>
   
    <script>
        jQuery.noConflict($);
    </script>
    <script type="text/javascript">
        <?php $__currentLoopData = session('flash_notification', collect())->toArray(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            AIZ.plugins.notify('<?php echo e($message['level']); ?>', '<?php echo e($message['message']); ?>');
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        $(document).ready(function(){
           
          // signup 3
          

          // my_slider js
          $('.slick').slick({
          dots: true,
          infinite: true,
          arrows: false,
          speed: 300,
          autoplay: true,
          slidesToShow: 1,
          slidesToScroll: 1,
          responsive: [
            {
              breakpoint: 1024,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                infinite: true,
                dots: true
              }
            },
            {
              breakpoint: 600,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1
              }
            },
            {
              breakpoint: 480,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1
              }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
          ]
          });
        });
        

    </script>

          <script>
              $("ul.social li a").on("click",function(){
                $(this).toggleClass("active");
              });

              function myFunc(){
                var filter = document.getElementById("filter_job");
                filter.classList.toggle("show");
              }
          </script>
    
      <script>
            $('input[type=range]').on('input', function(e){
          var min = e.target.min,
              max = e.target.max,
              val = e.target.value;
          
          $(e.target).css({
            'backgroundSize': (val - min) * 100 / (max - min) + '% 100%'
          });
        }).trigger('input');
      </script>
        <script>
            $('#chooseFile').change(function() {
            var i = $(this).prev('label').clone();
            var file = $('#chooseFile')[0].files[0].name;
            $(this).prev('label').text(file);
            });
            $('#sub_form').on('submit',function(e){
                e.preventDefault();
                var email=$('#subscribe_email').val();
                $('#subscribe_form').prop('disabled', true);
                $.ajax({
                        url:"<?php echo e(url('subscribe_form')); ?>",
                        type:"POST",
                        data:{
                        "_token": "<?php echo e(csrf_token()); ?>",
                        email:email,
                    },
                    success:function(response){
                        if (response.status==false) {
                            $("#message").css({"display":"block", "color":"#df0303"});
                            $('#message').text(response.message);
                        }else{
                            $('#subscribe_email').val(' ');
                            $("#message").css({"display":"block", "color":"#0dd30d"});
                            $('#message').text(response.message); 
                        }
                        $('#subscribe_form').prop('disabled', false);
                        setTimeout(function() { 
                            $('#message').text('');
                        }, 3000);
                    }
                });
            });
            $('.update_noti').on('click',function(){
              
              
              var id = $(this).find('.noti_id').val();
              var link = $(this).find('.noti_link').val();
              var token = "<?php echo e(csrf_token()); ?>";
              // console.log(cat_id) //testing purposes.. 
              $.ajax({
                  url: "/update-notificatons/" + id,
                  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                  dataType: "json",
                  method: 'GET',                  
                  success: function(response) {
                          var data = response.data;
                          var link = data.link;
                         window.location.href= link;
                  },
                  error: function(data) {
                    console.log(data);

                  },
              });
          })
    </script>

   

    <?php echo $__env->yieldContent('script'); ?>
    <?php echo $__env->yieldPushContent('script'); ?>
   
</body>
</html>
<?php /**PATH /www/wwwroot/public_html/cashpost.visionvivante.com/resources/views/frontend/default/layouts/app.blade.php ENDPATH**/ ?>