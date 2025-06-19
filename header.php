<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<?php wp_head(); ?>
<!-- Additional Favicon and Icons -->
<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/favicon-96x96.png" sizes="96x96" />
<link rel="icon" type="image/svg+xml" href="<?php echo get_template_directory_uri(); ?>/favicon.svg" />
<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" />
<link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/apple-touch-icon.png" />
<meta name="apple-mobile-web-app-title" content="Geospatica" />
<link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/site.webmanifest" />

<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

  <?php 
    $header_script = get_field('basic_script', 'option');
    if( $header_script && !empty($header_script['basic_script_header']) ): ?>
        <?php echo $header_script['basic_script_header']; ?>
<?php endif; ?>

</head>

<body <?php body_class(); ?>>

<div class="top-header bg-default py-2">
    <div class="container w-11/12 xl:w-9/12 mx-auto px-4 md:px-8">
        <div class="flex items-center justify-center md:justify-end gap-4">
            <?php 
            $whatsapp = get_field('basic_whatsapp_number', 'option');
            $phone = get_field('basic_phone', 'option');
            $email = get_field('basic_email', 'option');
            // Ensure only numbers and replace leading 0 with +62
            $whatsapp1 = preg_replace('/[^0-9]/', '', $whatsapp);
            if (substr($whatsapp1, 0, 1) === '0') {
                $whatsapp1 = '+62' . substr($whatsapp1, 1);
            }
            ?>

            <?php if ($whatsapp): ?>
                <p class="text-sm text-white text-right">
                <a href="https://wa.me/<?php echo esc_attr($whatsapp1); ?>" target="_blank">
                        <i class="icon-ks-whatsapp leading-[18px]"></i><?php echo esc_html($whatsapp); ?>
                    </a>
                </p>
            <?php endif; ?>

            <?php if ($phone): ?>
                <p class="text-sm text-white text-right">
                    <a href="tel:<?php echo esc_attr($phone); ?>">
                        <i class="icon-ks-telephone leading-[18px]"></i><?php echo esc_html($phone); ?>
                    </a>
                </p>
            <?php endif; ?>

            <?php if ($email): ?>
                <p class="text-sm text-white text-right">
                    <a href="mailto:<?php echo esc_attr($email); ?>">
                        <i class="icon-ks-mail leading-[18px]"></i><?php echo esc_html($email); ?>
                    </a>
                </p>
            <?php endif; ?>
        </div>
    </div>
</div>

<div 
    x-data="{ 
        lastScroll: 0, 
        isScrollingDown: false, 
        isSticky: false, 
        updateScroll() { 
            let currentScroll = window.pageYOffset; 
            this.isScrollingDown = currentScroll > this.lastScroll;
            this.isSticky = currentScroll > 50; // Sticky only after 150px scroll
            this.lastScroll = currentScroll;
        } 
    }" 
    x-on:scroll.window="updateScroll"
    :class="[isSticky ? 'sticky top-0 bg-white py-2 md:py-4 ' : 'py-4 md:py-8']"
    class="navbar navbar-light bg-light navbar-expand-lg z-[2] relative transition-all duration-300 bg-white"
    role="navigation"
>
    <div class="container w-11/12 xl:w-9/12 mx-auto px-4 md:px-8">
        <header class="flex items-center justify-between relative">
        
            <div class="logo-top">
                <?php if ( wp_is_mobile() ) : ?>
                    <?php
                        $image = get_field('header_logo_mobile', 'option');
                        if( !empty($image) ) :
                    ?>
                        <a class="navbar-brand page-scroll" href="<?php echo home_url(); ?>"><img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" class="header-logo img-fluid" width="171" height="36" /></a>
                    <?php endif;
                    else :
                        $image = get_field('header_logo', 'option');
                        if( !empty($image) ) :
                        ?>
                            <a class="navbar-brand page-scroll" href="<?php echo home_url(); ?>"><img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" class="header-logo img-fluid" width="200" height="36" /></a>
                        <?php endif; ?>
                <?php endif; ?>
            </div>
            <div class="menu-container hidden lg:flex gap-8 items-center">
            <?php
                wp_nav_menu( array(
                    'theme_location'    => 'primary',
                    'depth'             => 1, // Set to 1 if you don’t need sub-menus
                    'container'         => 'nav',
                    //'container_class'   => 'hidden lg:flex gap-8 items-center',
                    'container_class'   => false,
                    //'menu_class'        => 'flex flex-wrap space-x-4',
                    'items_wrap'        => '%3$s',
                    'fallback_cb'       => false,
                    'walker'            => new Custom_Walker_Nav_Menu(),
                ));
            ?>
            </div>

            <button 
                id="menu-toggle" 
                type="button" 
                class="z-[1] inline-flex items-center gap-2 rounded-lg px-2.5 py-2 text-sm font-semibold text-gray-500 ring-indigo-300 hover:bg-transparent focus-visible:ring active:text-gray-700 md:text-base lg:hidden"
                x-data="{ open: false }"
                @click="open = !open"
            >
                <template x-if="!open">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 rotate-180" viewBox="0 0 20 20" fill="#d30c36">
                        <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd" />
                    </svg>
                </template>
                <template x-if="open">
                    <svg height="20px" class="transition-all" viewBox="0 0 512 512" fill="#d30c36" width="20px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path d="M437.5,386.6L306.9,256l130.6-130.6c14.1-14.1,14.1-36.8,0-50.9c-14.1-14.1-36.8-14.1-50.9,0L256,205.1L125.4,74.5  c-14.1-14.1-36.8-14.1-50.9,0c-14.1,14.1-14.1,36.8,0,50.9L205.1,256L74.5,386.6c-14.1,14.1-14.1,36.8,0,50.9  c14.1,14.1,36.8,14.1,50.9,0L256,306.9l130.6,130.6c14.1,14.1,36.8,14.1,50.9,0C451.5,423.4,451.5,400.6,437.5,386.6z"/></svg>
                </template>
            </button>      
        </header>
    </div>
</div>


