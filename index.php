<?php 




get_header(); ?>



<main class="green-haven-blog-page">

  <section class="gh-page-title-section">
    <div class="gh-container">
      <h1 class="gh-page-title">
        <?php
        $posts_page_id = get_option( 'page_for_posts' );

        if ( $posts_page_id ) {
          echo esc_html( get_the_title( $posts_page_id ) );
        } else {
          esc_html_e( 'Blog', 'green-haven' );
        }
        ?>
      </h1>
    </div>
  </section>

  <section class="gh-blog-section">
    <div class="gh-container">
      <div class="gh-blog-layout">

        <div class="gh-blog-list">

          <?php if ( have_posts() ) : ?>

            <?php while ( have_posts() ) : the_post(); ?>

              <article <?php post_class( 'gh-blog-card' ); ?>>

                <?php if ( has_post_thumbnail() ) : ?>
                  <a href="<?php the_permalink(); ?>" class="gh-blog-image-link" aria-label="<?php the_title_attribute(); ?>">
                    <?php
                    the_post_thumbnail(
                      'large',
                      array(
                        'class' => 'gh-blog-card-image',
                        'alt'   => esc_attr( get_the_title() ),
                      )
                    );
                    ?>
                  </a>
                <?php else : ?>
                  <div class="gh-blog-card-image gh-blog-card-image-placeholder" aria-hidden="true"></div>
                <?php endif; ?>

                <div class="gh-blog-card-content">

                  <div class="gh-blog-category">
                    <?php
                    $categories = get_the_category();

                    if ( ! empty( $categories ) ) {
                      echo esc_html( $categories[0]->name );
                    } else {
                      esc_html_e( 'Uncategorized', 'green-haven' );
                    }
                    ?>
                  </div>

                  <h2 class="gh-blog-card-title">
                    <a href="<?php the_permalink(); ?>">
                      <?php the_title(); ?>
                    </a>
                  </h2>

                  <p class="gh-blog-excerpt">
                    <?php echo esc_html( wp_trim_words( get_the_excerpt(), 18, '...' ) ); ?>
                  </p>

                  <div class="gh-blog-meta-row">
                    <div class="gh-blog-author">
                      <?php echo get_avatar( get_the_author_meta( 'ID' ), 36 ); ?>

                      <span>
                        <?php
                        printf(
                          esc_html__( 'By %s', 'green-haven' ),
                          esc_html( get_the_author() )
                        );
                        ?>
                      </span>

                      <span class="gh-dot">•</span>

                      <span class="gh-blog-date">
                        <?php echo esc_html( get_the_date() ); ?>
                      </span>
                    </div>

                    <a href="<?php the_permalink(); ?>" class="gh-read-more">
                      <?php esc_html_e( 'Read More', 'green-haven' ); ?>
                      <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
                    </a>
                  </div>

                </div>
              </article>

            <?php endwhile; ?>

            <?php
        
            global $wp_query;

            $big       = 999999999;
            $paged     = max( 1, get_query_var( 'paged' ) );

            $pagination = paginate_links(
              array(
                'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                'format'    => '?paged=%#%',
                'current'   => $paged,
                'total'     => $wp_query->max_num_pages,
                'type'      => 'array',
                'mid_size'  => 1,
                'end_size'  => 1,
                'prev_text' => '<i class="fa-solid fa-arrow-left" aria-hidden="true"></i> ' . esc_html__( 'Prev', 'green-haven' ),
                'next_text' => esc_html__( 'Next', 'green-haven' ) . ' <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>',
              )
            );
         
            ?>

            <?php if ( ! empty( $pagination ) ) : ?>
              <nav class="gh-pagination" aria-label="<?php esc_attr_e( 'Blog pagination', 'green-haven' ); ?>">
                <?php
                foreach ( $pagination as $page_link ) {
                  echo wp_kses_post( $page_link );
                }
                ?>
              </nav>
            <?php endif; ?>

          <?php else : ?>

            <p><?php esc_html_e( 'No posts found.', 'green-haven' ); ?></p>

          <?php endif; ?>

        </div>

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