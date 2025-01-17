
              <?php
                /*
                  * This is the default post format.
                  *
                  * So basically this is a regular post. if you don't want to use post formats,
                  * you can just copy ths stuff in here and replace the post format thing in
                  * single.php.
                  *
                  * The other formats are SUPER basic so you can style them as you like.
                  *
                  * Again, If you want to remove post formats, just delete the post-formats
                  * folder and replace the function below with the contents of the "format.php" file.
                */

                $title = get_the_title();
                $content = get_the_content();

                if (strlen($_SERVER['REQUEST_URI']) > 9)
                {
                  if (substr($_SERVER['REQUEST_URI'], 0, 6) == "/wiki/" || substr($_SERVER['REQUEST_URI'], 0, 9) == "/cy/wiki/")
                  {
                    require_once __DIR__."/../wsspr-wiki.php";
                    wsspr_wiki($title, $content);
                  }
                }

                /* This is needed for get_the_content or custom content because
                shortcode is not processed automatically outside get_content */
                $content = apply_filters('the_content', $content);

              ?>

              <article id="post-<?php the_ID(); ?>" <?php post_class('cf'); ?> role="article" itemscope itemprop="blogPost" itemtype="http://schema.org/BlogPosting">

                <header class="article-header entry-header">

                  <h1 class="entry-title single-title" itemprop="headline" rel="bookmark"><?php echo $title; ?></h1>

                  <p class="byline entry-meta vcard">

                    <?php printf( __( 'Posted', 'bonestheme' ).' %1$s %2$s',
                       /* the time the post was published */
                       '<time class="updated entry-time" datetime="' . get_the_time('Y-m-d') . '" itemprop="datePublished">' . get_the_time(get_option('date_format')) . '</time>',
                       /* the author of the post */
                       '<span class="by">'.__( 'by', 'bonestheme' ).'</span> <span class="entry-author author" itemprop="author" itemscope itemptype="http://schema.org/Person">' . get_the_author_link( get_the_author_meta( 'ID' ) ) . '</span>'
                    ); ?>

                  </p>

                </header> <?php // end article header ?>

                <section class="entry-content cf" itemprop="articleBody">
                  <?php
                    // the content (pretty self explanatory huh)
                    echo $content;

                    /*
                     * Link Pages is used in case you have posts that are set to break into
                     * multiple pages. You can remove this if you don't plan on doing that.
                    */
                    wp_link_pages( array(
                      'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'bonestheme' ) . '</span>',
                      'after'       => '</div>',
                      'link_before' => '<span>',
                      'link_after'  => '</span>',
                    ) );
                  ?>
                </section> <?php // end article section ?>

                <footer class="article-footer">

                  <?php printf( __( 'filed under', 'bonestheme' ).': %1$s', get_the_category_list(', ') ); ?>

                  <?php the_tags( '<p class="tags"><span class="tags-title">' . __( 'Tags:', 'bonestheme' ) . '</span> ', ', ', '</p>' ); ?>

                </footer> <?php // end article footer ?>

                <?php //comments_template(); ?>

              </article> <?php // end article ?>
