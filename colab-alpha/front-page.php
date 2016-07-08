<?php get_header(); ?>

		<section class="project">

			<header class="project-header">

	            <h1 class="project-name">Project name</h1>
	            
	        </header>

	        <section class="discussion">

	        	<header class="tab">
	        		<h1>Discussion</h1>
	        	</header>

	        	<div class="post">

							<form action="" id="postForm" method="POST">		 
						    <fieldset>
					        <label for="postContent"><?php _e('Post Content:', 'framework') ?></label>
					        <textarea name="postContent" id="postContent" rows="8" cols="30" class="required"></textarea>
						    </fieldset>
						    <fieldset>
					        <input type="hidden" name="submitted" id="submitted" value="true" />
					        <?php wp_nonce_field( 'post_nonce', 'post_nonce_field' ); ?>
					        <button type="submit"><?php _e('Add Post', 'framework') ?></button>
						    </fieldset>
							</form>

							<?php
								if ( isset( $_POST['submitted'] ) && isset( $_POST['post_nonce_field'] ) && wp_verify_nonce( $_POST['post_nonce_field'], 'post_nonce' ) ) {
									$post_information = array(
								    'post_title' => substr($_POST['postContent'], 0, 20),
								    'post_content' => $_POST['postContent'],
								    'post_type' => 'post',
								    'post_status' => 'publish'
									);
									$post_id = wp_insert_post($post_information);
									if ($post_id) {
										$catId = get_cat_ID('discussion');
										wp_set_post_terms($post_id, array($catId), 'category', true);
								    wp_redirect(home_url());
								    exit;
									}
								}
							?>

	        	</div>	

	        	<?php
				$posts = getPostsByCat( 'discussion' );
				foreach ( $posts as $post ) :
					$id =			$post['id'];
					$date =			$post['date'];
					$title =		$post['title'];
					$name = 		$post['name'];
					$image = 		$post['image']['full'];
					$author = 		$post['author'];
					$author_name = 	$post['author_name'];
					$content = 		$post['content'];
				?>

	        	<article <?php post_class() ?> >

	        		<header class="author-meta post">
						<span class="author-thumb"><?php print get_avatar( $author, 38 ); ?></span>
						<span class="meta">
							<a class="author" rel="author" href="#"><?php print $author_name; ?></a>
							<time datetime="<?php  ?>"><?php print timeAgo($date); ?> ago</time>
						</span>
					</header>

	        		<div class="content">
	        			<?php print $content ?>
	        		</div>

	        		<?php global $withcomments; $withcomments = true; comments_template(); ?>
	        	</article>

	        	<?php endforeach; ?>

	        </section>

	        <section class="about">

	        	<header class="tab">
	        		<h1>About</h1>
	        	</header>
	        
	        <?php
	        	$page = get_page_by_title( 'About' );
	        	if ($page) :
	        ?>

	        <?php print $page->post_content ?>
	        	
	        <?php endif; ?>

	        </section>

		</section>

        <section class="sidebar">

        	<h1 class="logo">
                <a href="<?php bloginfo('url'); ?>">
                    <img class="svg" src="<?php echo get_template_directory_uri() ?>/img/logo_grey.svg" alt="Colab" > 
                </a>
            </h1>

        	<p>Sidebar</p>
        </section>

<?php get_footer(); ?>