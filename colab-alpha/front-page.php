<?php get_header(); ?>

		<section class="project">

			<header class="main-header">

	            <h1>Project page</h1>
	            
	        </header>

	        <section class="discussion">

	        	<h1>Discussion</h1>

	        	<?php
				$posts = getPostsByCat( 'discussion' );
				foreach ( $posts as $post ) :
					$id =				$post['id'];
					$title =	 		$post['title'];
					$name = 			$post['name'];
					$image = 			$post['image']['full'];
					$author = 			$post['author'];
					$content = 			$post['content'];
				?>

	        	<article class="post">
	        		<?php print $content ?>

	        		<?php global $withcomments; $withcomments = true; comments_template(); ?>
	        	</article>

	        	<?php endforeach; ?>

	        </section>

	        <section class="about">
	        
	        <?php
	        	$page = get_page_by_title( 'About' );
	        	if ($page) :
	        ?>

	        	<h1>About</h1>
	        	<?php print $page->post_content ?>
	        	
	        <?php endif; ?>

	        </section>

		</section>

        <section class="sidebar">
        	<h1>Colab</h1>
        	<p>Sidebar</p>
        </section>

<?php get_footer(); ?>