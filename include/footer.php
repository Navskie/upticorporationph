    <!--Footer-->
    <footer id="footer">
        <div class="site-footer" style="background: url('assets/images/main/footer.jpg') no-repeat center; background-size: cover;">
        	<div class="container">
     			<!--Footer Links-->
            	<div class="footer-top">
                	<div class="row">
                    	<div class="col-12 col-sm-12 col-md-5 col-lg-5 footer-links">
                        	<img src="assets/images/23.png" class="center-img"><br>
                            <p>Uptimised is an eCommerce business opportunity provider, helping people build their own business as Uptimised business partners, selling our products, and engaging more people to sell. We are a community of people, passionate about beauty and fulfilling dreams. Helping people around the world to fulfill their dreams is our mission and purpose.</p>
                        </div>
                        <div class="col-12 col-sm-12 col-md-2 col-lg-2 footer-links">
                        	<h4 class="h4" style="color: #000 !important; font-weight: 700 !important;">Customer Service</h4>
                            <ul>
                            	<li><a href="faqs.php">FAQs</a></li>
                                <li><a href="#">Return Policy</a></li>
                                <li><a href="#">Shipping Information</a></li>
                                <li><a href="#">Contact Us</a></li>
                            </ul>
                        </div>
                        <div class="col-12 col-sm-12 col-md-2 col-lg-2 footer-links">
                        	<h4 class="h4" style="color: #000 !important; font-weight: 700 !important;">Find Us</h4>
                            <ul>
                            	<li><a href="#">Global Location</a></li>
                            </ul>
                            <h4 class="h4" style="color: #000 !important; font-weight: 700 !important;">Follow Us</h4>
                            <ul class="payment-icons list--inline">
                                <li class="px-1"><a href="https://www.facebook.com/UPtimisedCorporation" target="_blank"><i class="icon fa-brands fa-facebook" aria-hidden="true"></i></a></li>
                                <li class="px-1"><a href="" target="_blank"><i class="icon fa-brands fa-instagram" aria-hidden="true"></i></a></li>
                                <li class="px-1"><a href="https://www.tiktok.com/@uptimisedcorp?lang=en&fbclid=IwAR0zd2LkOPxW0v5JTGV3wiDfw8e5kUb6uLBcWbQoxGJJo1hEWYLrN9Slu_8" target="_blank"><i class="icon fa-brands fa-tiktok" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                        <div class="col-12 col-sm-12 col-md-3 col-lg-3 contact-box">
                        	<h4 class="h4" style="color: #000 !important; font-weight: 700 !important;">Contact Us</h4>
                            <ul class="addressFooter">
                            	<li><i class="icon anm anm-map-marker-al" style="color: #000 !important;"></i><p>#10 Luna St. Brgy New Banicain Olongapo City</p></li>
                                <li class="phone"><i class="icon anm anm-phone-s" style="color: #000 !important;"></i><p>0999 888-4787 / 047-232-1186</p></li>
                                <li class="email"><i class="icon anm anm-envelope-l" style="color: #000 !important;"></i><p>customerservice@gmail.com</p></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!--End Footer Links-->
                <!-- <hr>
                <div class="footer-bottom">
                	<div class="row">
	                	<div class="col-12 col-sm-12 col-md-6 col-lg-6 order-1 order-md-0 order-lg-0 order-sm-1 copyright text-sm-center text-md-left text-lg-left"><span></span>Copyright © Uptimised Corporation - All rights reserved - <a href="https://www.facebook.com/ARSIEN1210" style="color: #000;">RCN93</a></div>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 order-0 order-md-1 order-lg-1 order-sm-0 payment-icons text-right text-md-center">
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </footer>
    <!--End Footer-->
    <!--Scoll Top-->
    <span id="site-scroll"><i class="icon anm anm-angle-up-r"></i></span>
    <!--End Scoll Top-->
     <!-- Including Jquery -->
     
     <script src="assets/js/vendor/jquery-3.3.1.min.js"></script>
     <script src="assets/js/vendor/jquery.cookie.js"></script>
     <script src="assets/js/vendor/modernizr-3.6.0.min.js"></script>
     <script src="assets/js/vendor/wow.min.js"></script>
     <script src="assets/js/vendor/masonry.js" type="text/javascript"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
     <!-- Including Javascript -->
     <script src="assets/js/bootstrap.min.js"></script>
     <script src="assets/js/plugins.js"></script>
     <script src="assets/js/popper.min.js"></script>
     <script src="assets/js/lazysizes.js"></script>
     <script src="assets/js/main.js"></script>
     <!-- Photoswipe Gallery -->
     <script src="assets/js/vendor/photoswipe.min.js"></script>
     <script src="toastr/toastr.min.js"></script>
     <script src="assets/js/vendor/photoswipe-ui-default.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
     <script>
        $('.owl-carousel').owlCarousel({
            stagePadding: 20,
            loop:true,
            margin:10,
            autoplay: true,
            autoplayTimeout:5000,
            nav:false,
            dots:false,
            responsive:{
                0:{
                    items:2
                },
                600:{
                    items:3
                },
                1000:{
                    items:7
                }
            }
        })
        $(function(){
            var $pswp = $('.pswp')[0],
                image = [],
                getItems = function() {
                    var items = [];
                    $('.lightboximages a').each(function() {
                        var $href   = $(this).attr('href'),
                            $size   = $(this).data('size').split('x'),
                            item = {
                                src : $href,
                                w: $size[0],
                                h: $size[1]
                            }
                            items.push(item);
                    });
                    return items;
                }
            var items = getItems();
        
            $.each(items, function(index, value) {
                image[index]     = new Image();
                image[index].src = value['src'];
            });
            $('.prlightbox').on('click', function (event) {
                event.preventDefault();
              
                var $index = $(".active-thumb").parent().attr('data-slick-index');
                $index++;
                $index = $index-1;
        
                var options = {
                    index: $index,
                    bgOpacity: 0.9,
                    showHideOpacity: true
                }
                var lightBox = new PhotoSwipe($pswp, PhotoSwipeUI_Default, items, options);
                lightBox.init();
            });
        });
        </script>
    </div>

	<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="pswp__bg"></div>
    <div class="pswp__scroll-wrap"><div class="pswp__container"><div class="pswp__item"></div><div class="pswp__item"></div><div class="pswp__item"></div></div><div class="pswp__ui pswp__ui--hidden"><div class="pswp__top-bar"><div class="pswp__counter"></div><button class="pswp__button pswp__button--close" title="Close (Esc)"></button><button class="pswp__button pswp__button--share" title="Share"></button><button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button><button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button><div class="pswp__preloader"><div class="pswp__preloader__icn"><div class="pswp__preloader__cut"><div class="pswp__preloader__donut"></div></div></div></div></div><div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap"><div class="pswp__share-tooltip"></div></div><button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"></button><button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)"></button><div class="pswp__caption"><div class="pswp__caption__center"></div></div></div></div></div>
</div>
</body>
</html>