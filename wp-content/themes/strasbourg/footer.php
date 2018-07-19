<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package strasbourg
 */

?>

    </div>
    <!-- #content -->
    <footer class="site-footer" role="contentinfo">

        <div class="site-footer__inner container-fluid wrap">

            <div class="row">

                <div class="site-footer col-xs-12 col-sm-4">
                    <h2 class="headline headline--small"><a href="<?php echo site_url(); ?>"><strong>Strasbourg</strong> Office de Tourisme</a></h2>
                    <p>17 place de la Cathédrale 67082 STRASBOURG CEDEX</p>
                    <p><i class="fa fa-phone" aria-hidden="true"></i> +33 3 88 52 28 28</p>
                </div>


                <div class="site-footer col-xs-12 col-sm-4">
                    <h3 class="headline headline--small">Infos Pratiques</h3>
                    <nav class="nav-list" role="navigation" aria-label="Menu du pied de page">
                        <?php
                wp_nav_menu(array(
                    'theme_location' => 'footer-1-menu'
                ));
             ?>
                    </nav>
                </div>


                <div class="site-footer col-xs-6 col-sm-4">
                    <h3 class="headline headline--small">Restez connecté</h3>
                  
                        <ul class="social-icons-list">
                            <li><a href="https://www.facebook.com/strasbourg.eu/" target="_blank"><i class="ion-social-facebook-outline social-color-facebook" aria-hidden="true"></i><span class="sr-only">facebook</span></a></li>
                            <li><a href="https://twitter.com/hashtag/strasbourg" target="_blank"><i class="ion-social-twitter-outline social-color-twitter" aria-hidden="true"></i><span class="sr-only">twitter</span></a></li>
                            <li><a href="https://www.linkedin.com/company/ville-de-strasbourg" target="_blank"><i class="ion-social-linkedin-outline social-color-linkedin" aria-hidden="true" ></i><span class="sr-only">linkedin</span></a></li>
                            <li><a href="https://www.instagram.com/explore/tags/strasbourg/" target="_blank"><i class="ion-social-instagram-outline social-color-instagram" aria-hidden="true"></i><span class="sr-only">instagram</span></a></li>
                        </ul>
            
                </div>
            </div>

        </div>
    </footer>
    <button id="backTop" title="Go to top" aria-hidden="true"><i class="fa fa-angle-double-up"></i><span class="sr-only">Retournez en haut de la page</span></button>

    </div>
    <!-- #page -->


    <?php wp_footer(); ?>


    </body>

    </html>
