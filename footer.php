<footer class="bg-secondary border-t-4 border-t-default">
   
    <div class="pt-12 lg:pt-16">
        <div class="container w-11/12 xl:w-9/12 mx-auto px-4 md:px-8">
            <div class="mb-8 grid md:grid-cols-2 gap-12">
                <div class="footer-info">
                    <?php 
                    $footer_info = get_field('basic_footer_info', 'option');
                    if( $footer_info ): ?>
                        <div class="text-center md:text-left text-sm text-gray-400 w-full md:w-[80%]">
                            <?php if( $footer_info['basic_footer_logo'] ): ?>
                                <div class="">
                                    <a href="/" class="inline-flex items-center gap-2 text-xl font-bold text-black md:text-2xl" aria-label="logo">
                                        <img src="<?php echo esc_url($footer_info['basic_footer_logo']); ?>" aria-label="Logo Klinevo" class="img-fluid" width="171" height="34" >
                                    </a>
                                </div>
                            <?php endif; ?>
                            
                            <?php if( $footer_info['basic_footer_description'] ): ?>
                                <p class="mb-6 text-white sm:pr-8"><?php echo esc_html($footer_info['basic_footer_description']); ?></p>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                   
                </div>

                <div class="footer-link flex flex-col md:flex-row gap-8 md:gap-0">

                    <?php 
                        $footer_info = get_field('basic_footer_info', 'option');
                        if( $footer_info ): ?>
                            <div class="text-center md:text-right text-sm text-white w-full">
                                <?php if( $footer_info['basic_footer_links'] ): ?>
                                    <div class="text-white footer-links sm:pr-8 md:pr-0"><?php echo wp_kses_post($footer_info['basic_footer_links']); ?></div>
                                <?php endif; ?>
                            </div>
                            <div class="text-center md:text-left text-sm w-full">
                                <?php if( $footer_info['basic_footer_address'] ): ?>
                                    <div class="text-white md:ml-11"><?php echo wp_kses_post($footer_info['basic_footer_address']); ?></div>
                                <?php endif; ?>
                            </div>
                        <?php endif; 
                    ?>
                    
                </div>
            </div>

            <div class="border-t border-t-[#486f88] py-8 text-center md:text-left text-sm text-white">
                <div class="grid md:grid-cols-2 gap-12">
                    <div class="flex items-center justify-center md:justify-start">
                        <?php the_field('basic_copyright_text', 'option'); ?>
                    </div>
                    
                    <div class="footer-social flex justify-center md:justify-end items-center"> 
                            <?php
                                // reset choices
                                $field['choices'] = array();

                                // if has rows
                                if( have_rows('basic_social_media', 'option') ) {

                                    // while has rows
                                    while( have_rows('basic_social_media', 'option') ) {

                                        // instantiate row
                                        the_row();

                                        // vars
                                        $value = get_sub_field('basic_social_name');
                                        $label = get_sub_field('basic_social_link');

                                        // append to choices
                                        $field['choices'][ $value ] = $label; ?>

                                        <a href="<?php echo $label; ?>" target="_blank" rel="noopener" aria-label="<?php echo $value; ?>" class="link <?php echo $value; ?>">
                                            <i class="icon-ks-<?php echo $value; ?>"></i>
                                        </a>

                                    <?php }
                                }

                                // return the field
                                //return $field;
                            ?>
                       
                                
                    </div>
                </div>
        </div>
    </div>
</footer>

<script>
jQuery(document).ready(function($) {
    $('#menu-toggle').on('click', function() {
        $('.menu-container').toggleClass('hidden flex navbar-collapse');
    });
});
</script>

<script>
  AOS.init();
</script>

<?php 
    $footer_script = get_field('basic_script', 'option');
    if( $footer_script && !empty($footer_script['basic_footer_script']) ): ?>
        <?php echo ($footer_script['basic_footer_script']); ?>
<?php endif; ?>

<?php wp_footer(); ?>

</body>
</html>