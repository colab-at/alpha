<?php get_header(); ?>

		<section class="project">

			<header class="project-header">

	            <h1 class="project-name">Project name</h1>
	            
	        </header>

	        <section class="discussion">

	        	<header class="tab">
	        		<h1>Discussion</h1>
	        	</header>

	        	<?php
				$posts = getPostsByCat( 'discussion' );
				foreach ( $posts as $post ) :
					$id =		$post['id'];
					$date =		$post['date'];
					$title =	$post['title'];
					$name = 	$post['name'];
					$image = 	$post['image']['full'];
					$author = 	$post['author'];
					$content = 	$post['content'];
				?>

	        	<article <?php post_class() ?> >

	        		<header class="author-meta post">
						<span class="author-thumb"><?php print get_avatar( $post, '48'); ?></span>
						<span class="meta">
							<a class="author" rel="author" href="#"><?php print $author; ?></a>
							<time datetime="<?php  ?>"><?php print timeAgo($date); ?> ago</time>
						</span>
					</header>

	        		<?php print $content ?>

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