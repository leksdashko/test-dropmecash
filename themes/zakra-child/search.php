<?php
    /**
     * The template for displaying search results pages
     *
     * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
     *
     * @package zakra
     */

    get_header();
?>

    <section id="primary" class="content-area tg-container">
        <?php echo apply_filters( 'zakra_after_primary_start_filter', false ); // WPCS: XSS OK. ?>

        <?php if ( have_posts() ) : ?>

            <?php if ( 'page-header' !== zakra_is_page_title_enabled() ) : ?>
                <header class="page-header">
                    <h2 class="page-title tg-page-content__title">
                        <?php
                            /* translators: %s: search query. */
                            printf( esc_html__( 'Search Results for: %s', 'zakra' ), '<span>' . get_search_query() . '</span>' );
                        ?>
                    </h2>
                </header><!-- .page-header -->
            <?php endif; ?>

            <?php
            do_action( 'zakra_before_posts_the_loop' );

            /* Start the Loop */
            while ( have_posts() ) :
                the_post();?>

                <a href="<?php echo get_permalink(); ?>" class="item_in_tab">
                    <div class="item_image">
                        <?php echo get_the_post_thumbnail(); ?>
                    </div>
                    <div class="item_title for_tel">
                        <?php the_title() ?>
                    </div>
                    <div class="item_tag for_tel">
                        <div class="item_tag_image">
                            <?php
                                $postID = get_the_ID();
                                $terms = get_the_terms($postID, 'reward');
                                foreach ($terms as $term) {
                                    $termID = $term->term_id;
                                }
                                if (function_exists('z_taxonomy_image_url')) {?>
                                    <img height="38px" src="<?php echo z_taxonomy_image_url($termID); ?>" alt="Provider <?php echo get_term( $termID )->name; ?>">
                                <?php } ?>
                            <?php echo get_term( $termID )->name; ?>
                        </div>
                    </div>
                    <div class="item_category for_tel">
                        <?php
                            $category = get_the_category();
                            foreach ($category as $catitem) {?>
                                <span class="cat_item">
                                                            <?php
                                                                echo $catitem->cat_name;
                                                            ?>
                                                            </span>
                                <?php
                            }
                        ?>
                    </div>
                    <div class="item_link">
                        <span><?php echo get_theme_mod('section_id_ins'); ?></span>
                        <svg width="18" height="30" viewBox="0 0 18 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0 3.18L11.703 15L0 26.82L3.14851 30L18 15L3.14851 0L0 3.18Z" fill="#101011"/>
                        </svg>
                    </div>
                </a>

                <?php

                /**
                 * Run the loop for the search to output the results.
                 * If you want to overload this in a child theme then include a file
                 * called content-search.php and that will be used instead.
                 */

            endwhile;

            do_action( 'zakra_after_posts_the_loop' );

        else :
            ?>
            <header class="page-header no-results">
                <?php if ( 'page-header' !== zakra_is_page_title_enabled() ) : ?>
                    <h2 class="page-title tg-page-content__title"><?php esc_html_e( 'Nothing Found', 'zakra' ); ?></h2>
                <?php endif; ?>
                <p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'zakra' ); ?></p>
                <?php
			get_search_form();
            ?>
            </header><!-- .page-header -->
            <?php
        endif;
        ?>

        <?php echo apply_filters( 'zakra_after_primary_end_filter', false ); // // WPCS: XSS OK. ?>
    </section><!-- #primary -->
    <style>
        @media screen and (max-width: 768px){
            .page-header.no-results{
                padding-left: 15px;
                padding-right: 15px;
            }
            .page-header.no-results{
                padding-top: 30px;
                padding-bottom: 30px;
            }
        }
        .no-results .search-form label{
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }
        .no-results .search-form label input{
            background: #fff;
        }
        .item_in_tab{
            margin-bottom: 10px;
        }
        .content-area{
            padding-top: 50px;
            padding-bottom: 50px;
        }
    </style>

<?php
    get_sidebar();
    get_footer();
