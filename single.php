<?php get_header(); ?>





<main class="gh-single-blog-page">

  <section class="gh-blog-detail-section">
    <div class="gh-container">

      <div class="gh-blog-detail-layout">

        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

        <article <?php post_class('gh-blog-content'); ?>>

          <!-- Title -->
          <h1 class="gh-blog-title">
            <?php the_title(); ?>
          </h1>

          <!-- Featured Image -->
          <?php if ( has_post_thumbnail() ) : ?>
            <?php the_post_thumbnail('large', [
              'class' => 'gh-blog-hero-image',
              'alt'   => esc_attr( get_the_title() )
            ]); ?>
          <?php endif; ?>

          <!-- Meta -->
          <div class="gh-post-meta-card">

            <!-- Author -->
            <div class="gh-meta-item">
              <span class="gh-meta-icon">
                <i class="fa-solid fa-leaf"></i>
              </span>
              <div>
                <strong><?php esc_html_e('Author','green-haven'); ?></strong>
                <span><?php echo esc_html( get_the_author() ); ?></span>
              </div>
            </div>

            <!-- Date -->
            <div class="gh-meta-item">
              <span class="gh-meta-icon">
                <i class="fa-regular fa-calendar-days"></i>
              </span>
              <div>
                <strong><?php esc_html_e('Date','green-haven'); ?></strong>
                <span><?php echo esc_html( get_the_date() ); ?></span>
              </div>
            </div>

            <!-- Categories -->
            <div class="gh-meta-item">
              <span class="gh-meta-icon">
                <i class="fa-solid fa-tags"></i>
              </span>
              <div>
                <strong><?php esc_html_e('Categories','green-haven'); ?></strong>

                <span class="gh-tag-list">
                  <?php
                  $categories = get_the_category();
                  if ( ! empty( $categories ) ) :
                    foreach ( $categories as $cat ) :
                  ?>
                    <a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>">
                      <?php echo esc_html( $cat->name ); ?>
                    </a>
                  <?php endforeach; endif; ?>
                </span>

              </div>
            </div>

          </div>

          <!-- Content -->
          <section class="gh-blog-body">
            <?php the_content(); ?>
          </section>


<?php
if ( comments_open() || get_comments_number() ) :
	comments_template();
endif;
?>











        </article>


















        
        <?php endwhile; endif; ?>

        <!-- SIDEBAR -->
         <aside class="gh-sidebar">

          <div class="gh-sidebar-card">
            <?php get_sidebar('blog-sidebar'); ?>
          </div>

        </aside>
      </div>

    </div>
  </section>

</main>

<?php get_footer(); ?>


