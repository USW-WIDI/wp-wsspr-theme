			<footer class="footer" role="contentinfo" itemscope itemtype="http://schema.org/WPFooter">

				<div id="inner-footer" class="wrap cf">

					<div class="logos primary">

						<a href="https://www.wsspr.wales/"  target="_blank">
							<img alt="Wales School of Social Prescribing Research (WSSPR) logo" src="http://157.245.38.191/wp-content/themes/wp-wsspr-theme/library/images/logos/wsspr.png" />
						</a>

						<a href="https://phw.nhs.wales/"  target="_blank">
							<img alt="Public Health Wales (PHW) logo" src="http://157.245.38.191/wp-content/themes/wp-wsspr-theme/library/images/logos/phw.png" />
						</a>

					</div>

					<div class="logos secondary">

						<a href="https://www.southwales.ac.uk/research/"  target="_blank">
							<img alt="University of South Wales (USW) logo" src="http://157.245.38.191/wp-content/themes/wp-wsspr-theme/library/images/logos/usw.png" />
						</a>

						<a href="http://www.primecentre.wales/"  target="_blank">
							<img alt="Wales PRIME Centre logo" src="http://157.245.38.191/wp-content/themes/wp-wsspr-theme/library/images/logos/prime-centre-wales.png" />
						</a>

						<a href="https://wcva.cymru/"  target="_blank">
							<img alt="WcVA logo" src="http://157.245.38.191/wp-content/themes/wp-wsspr-theme/library/images/logos/wcva.png" />
						</a>

						<a href="https://healthandcareresearchwales.org/"  target="_blank">
							<img alt="Health and Care Research Wales (HCRW) logo" src="http://157.245.38.191/wp-content/themes/wp-wsspr-theme/library/images/logos/hcrw.png" />
						</a>
						
						<a href="https://healthandcareresearchwales.org/"  target="_blank">
							<img alt="Welsh Government funding logo" src="http://157.245.38.191/wp-content/themes/wp-wsspr-theme/library/images/logos/welsh-government.png" />
						</a>
						
					</div>

					<p class="source-org copyright">&copy; <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?>.</p>

				</div>

				<nav role="navigation">

					<?php wp_nav_menu(array(
						'container' => 'div',                           // enter '' to remove nav container (just make sure .	footer-links in _base.scss isn't wrapping)
						'container_class' => 'footer-links cf',         // class of container (should you choose to use it)
						'menu' => __( 'Footer Links', 'bonestheme' ),   // nav name
						'menu_class' => 'nav footer-nav cf',            // adding custom nav class
						'theme_location' => 'footer-links',             // where it's located in the theme
						'before' => '',                                 // before the menu
						'after' => '',                                  // after the menu
						'link_before' => '',                            // before each link
						'link_after' => '',                             // after each link
						'depth' => 0,                                   // limit the depth of the nav
						'fallback_cb' => 'bones_footer_links_fallback'  // fallback function
					)); ?>

				</nav>

			</footer>

		</div>

		<?php // all js scripts are loaded in library/bones.php ?>
		<?php wp_footer(); ?>
<!-- Added by Tareq Starts -->
    <script>
    $(document).ready(function(e) {
        $('img[usemap]').rwdImageMaps();
        
       // $('area').on('click', function() {
       //     alert($(this).attr('alt') + ' clicked');
       // });
    });
    </script>    

    <script type="text/javascript">
        $(function() {
            $('.tareq_mi').maphilight();
        });
	</script>
<!-- Added by Tareq Ends -->
	</body>

</html> <!-- end of site -->
