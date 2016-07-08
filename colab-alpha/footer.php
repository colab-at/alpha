        
        <footer class="main-footer wrap">
            Footer
        </footer>

        <script src="<?php bloginfo('template_directory'); ?>/js/vendor/modernizr-2.8.3.min.js" async></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <script src="<?php bloginfo('template_directory'); ?>/js/plugins.js" defer></script>
        <script src="<?php bloginfo('template_directory'); ?>/js/main.js" defer></script>

        <!-- Google Analytics -->
        <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-XXXXX-Y', 'auto');
        ga('send', 'pageview');
        </script>
        <!-- End Google Analytics -->

        <script type="text/javascript">
            // AJAXified commenting system
            jQuery('document').ready(function($) {
                var commentform = $('#commentform'); // find the comment form
                commentform.prepend('<div id="comment-status" ></div>'); // add info panel before the form to provide feedback or errors
                var statusdiv=$('#comment-status'); // define the infopanel

                commentform.submit(function() {
                    //serialize and store form data in a variable
                    var formdata = commentform.serialize();
                    //Add a status message
                    statusdiv.html('<p>Processing...</p>');
                    //Extract action URL from commentform
                    var formurl = commentform.attr('action');
                    //Post Form with data
                    $.ajax({
                        type: 'post',
                        url: formurl,
                        data: formdata,
                        error: function(XMLHttpRequest, textStatus, errorThrown) {
                            statusdiv.html('<p class="wdpajax-error">You might have left one of the fields blank, or be posting too quickly</p>');
                        },
                        success: function(data, textStatus) {
                            if (data == "success") statusdiv.html('<p class="ajax-success">Thanks for your comment. We appreciate your response.</p>');
                            else statusdiv.html('<p class="ajax-error">Please wait a while before posting your next comment</p>');
                            commentform.find('textarea[name=comment]').val('');
                        }
                    });
                    return false;
                });
            });
        </script>

        <?php wp_footer(); ?>
    </body>
</html>