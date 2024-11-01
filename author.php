<?php

/*
* Template Name: Author Page Template
*/ 

?>

<?php get_header(); ?>

<div id="content" class="narrowcolumn">

<div class="wpsu">

<?php
if(isset($_GET['author_name'])) :
$curauth = get_userdatabylogin($author_name);
else :
$curauth = get_userdata(intval($author));
endif;
?>

<?php
$curauth = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
?>

<?php
global $wp_query;
$curauth = $wp_query->get_queried_object();
?>

<?php
$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $_GET['author_name']) : get_userdata($_GET['author']);
?>

<?php 
$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
?>


    <div class="author_bio">

    <h2>About: <span><?php echo $curauth->first_name; ?> <?php echo $curauth->last_name; ?></span></h2>

    <div class="floatLeft" style="margin-right: 10px"><?php echo get_avatar($curauth->ID, $size = '96'); ?></div>

    <p>Website: <a href="<?php echo $curauth->user_url; ?>"><?php echo $curauth->user_url; ?></a></p>
        
    <p>Profile: <?php echo $curauth->user_description; ?></p><br>

    <h2>Posts by <?php echo $curauth->nickname; ?>:</h2>

    <ul>

   <!-- The Loop -->

   <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
 
       <li>
            <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link: <?php the_title(); ?>">
            <?php the_title(); ?></a>,
            <?php the_time('d M Y'); ?> in <?php the_category('&');?><br><br>

    <div class="floatLeft" style="margin-right: 10px"><?php echo get_avatar($curauth->ID, $size = '96'); ?></div>

    <p>Website: <a href="<?php echo $curauth->user_url; ?>"><?php echo $curauth->user_url; ?></a></p>

        </li>
            
         
    <?php endwhile; else: ?>

        <p><?php _e('No posts by this author.'); ?></p>

    <?php endif; ?>

<!-- End Loop -->

    </ul>
</div>
</div>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>