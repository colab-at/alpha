        
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
                commentform.prepend('<div id="comment-status"></div>'); // add info panel before the form to provide feedback or errors
                var statusdiv = $('#comment-status'); // define the infopanel

                commentform.submit(function() {
                    // Add a status message
                    statusdiv.html('<p>Please wait...</p>');
                    // Serialize and store form data in a variable
                    var formdata = commentform.serialize();
                    // Extract action URL from commentform
                    var formurl = commentform.attr('action');
                    // Post Form with data
                    $.ajax({
                        type: 'post',
                        url: formurl,
                        data: formdata,
                        error: function(XMLHttpRequest, textStatus, errorThrown) {
                            statusdiv.html('<p class="comment-error">An error occurred. Please try again in a few seconds.</p>');
                        },
                        success: function(data, textStatus) {
                            if (data == "success") {
                                statusdiv.html('');
                                addNewComment(commentform);
                            }
                            else {
                                statusdiv.html('<p class="comment-error">An error occurred. Please try again in a few seconds.</p>');
                            }
                            commentform.find('textarea[name=comment]').val('');
                        }
                    });
                    return false;
                });
            });

            function addNewComment(commentform) {
                var depth = 1;
                var commentParent = $(commentform).children('fieldset').children('#comment_parent').val();
                if (commentParent != "0") depth++;
                var tempComment = '<article class="comment byuser comment-author-admin bypostauthor even thread-even depth-' + depth + '" id="comment-temp">';
                if (depth > 1) tempComment += '<div class="wrapper">';
                tempComment += '<header class="author-meta comment">';
                tempComment += $('#respond').children('form').children('.comment-meta').children('.author-thumb').html();
                tempComment += $('#respond').children('form').children('.comment-meta').children('.meta').html();
                tempComment += '</header>';
                tempComment += '<p>' + $(commentform).children('#comment').val() + '</p>';
                if (depth > 1) {
                    tempComment += '</div>';
                    $(tempComment).insertAfter('#comment-' + commentParent);
                }
                else {
                    $(tempComment).insertAfter('#respond');
                }
            }
        </script>

        <?php wp_footer(); ?>
    </body>
</html>