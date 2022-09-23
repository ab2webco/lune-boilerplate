<?php
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit; ?>
		<!-- Add your custom footer -->
		<footer class="site-footer">
            <div class="upper-footer">
                <div class="container">
                    <div class="row">
                        <div class="col col-lg-4 col-md-3 col-sm-6">
                            <div class="widget about-widget">
                                <div class="logo widget-title">
                                    <img src="<?php echo asset_path('images/verticallink-logo-white.svg') ?>" alt>
                                </div>
                                <p>Wasn't a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile</p>

                                <div class="contact-info">
                                    <h4>0214545-54574</h4>
                                    <ul>
                                        <li>demo@email.com</li>
                                        <li>98/4 Darun street 42 no house, Astria.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col col-lg-2 col-md-3 col-sm-6">
                            <div class="widget link-widget">
                                <div class="widget-title">
                                    <h3>Navigation</h3>
                                </div>
                                <ul>
                                    <li><a href="#">About us</a></li>
                                    <li><a href="#">Contact with us</a></li>
                                    <li><a href="#">Our recent work</a></li>
                                    <li><a href="#">Privacy Policy </a></li>
                                    <li><a href="#">Team members</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col col-lg-3 col-md-3 col-sm-6">
                            <div class="widget latest-post-widget">
                                <div class="widget-title">
                                    <h3>Latest Post</h3>
                                </div>
                                <ul>
                                    <li>
                                        <div class="post-pic">
                                            <img src="<?php echo asset_path('images/footer-post/img-1.jpg') ?>" alt>
                                        </div>
                                        <h4><a href="#">Opportunity cost no decision is</a></h4>
                                        <span class="date">DEC 02, 2018</span>
                                    </li>
                                    <li>
                                        <div class="post-pic">
                                            <img src="<?php echo asset_path('images/footer-post/img-2.jpg') ?>" alt>
                                        </div>
                                        <h4><a href="#">Actionelm cost no decision is</a></h4>
                                        <span class="date">DEC 02, 2022</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col col-lg-3 col-md-3 col-sm-6">
                            <div class="widget newsletter-widget">
                                <div class="widget-title">
                                    <h3>Email newsletter</h3>
                                </div>
                                <div class="form">
                                    <form>
                                        <div>
                                            <input type="text" class="form-control" placeholder="Enter your email address">
                                        </div>
                                        <div>
                                            <button type="submit">Subscribe</buttzon>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end container -->
            </div>
            <div class="lower-footer">
                <div class="container">
                    <div class="row">
                        <div class="separator"></div>
                        <div class="col col-xs-12">
                            <p class="copyright">Copyright &copy; 2022 Vertical Link. Todos los derechos reservados.</p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
		</div>
		<?php wp_footer();?>
	</body>
</html>
