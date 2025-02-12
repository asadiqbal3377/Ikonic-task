<?php get_header(); ?>

<div class="projects-archive">
    <h1>Projects Archive</h1>

    <?php 
    // Get the current page number
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

    // Query for Projects with Pagination
    $args = [
        'post_type'      => 'projects',
        'posts_per_page' => 6, // Limit 6 projects per page
        'paged'          => $paged, // Enable pagination
    ];
    $query = new WP_Query($args);

    if ($query->have_posts()): ?>
        <div class="projects-list">
            <?php while ($query->have_posts()): $query->the_post(); ?>
                <div class="project-item">
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <?php if (has_post_thumbnail()) { the_post_thumbnail('medium'); } ?>
                    <p><?php the_excerpt(); ?></p>
                </div>
            <?php endwhile; ?>
        </div>

        <!-- Pagination -->
        <div class="pagination">
            <?php 
            echo paginate_links([
                'total'     => $query->max_num_pages,
                'current'   => $paged,
                'prev_text' => '« Previous',
                'next_text' => 'Next »',
            ]); 
            ?>
        </div>

    <?php else: ?>
        <p>No projects found.</p>
    <?php endif; wp_reset_postdata(); ?>
</div>

<?php get_footer(); ?>
