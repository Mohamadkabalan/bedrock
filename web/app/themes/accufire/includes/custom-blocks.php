<?php

/*
Custom Blocks
*/

add_action('acf/init', 'af_acf_init');

function af_acf_init()
{
    // Bail out if function doesn’t exist.
    if (!function_exists('acf_register_block')) {
        return;
    }


    // Register a Most Recent posts block.
    acf_register_block_type(array(
      'name'            => 'af_post_block_block',
      'title'           => __('Post Block', 'accufire'),
      'description'     => __('Post Block.', 'accufire'),
      'render_callback' => 'af_post_block_acf_block_render_callback',
      'category'        => 'formatting',
      'icon'            => 'admin-comments',
      'keywords'        => array('posts'),
    ));

}



function af_post_block_acf_block_render_callback($block, $content = '', $is_preview = false){
  $context = Timber::context();
  $context['block'] = $block;
  $context['fields'] = get_fields();
  $context['is_preview'] = $is_preview;
  $args = array(
    'post_type' => 'post',
    'posts_per_page' => 3,
  );

  $context['articles'] = Timber::get_posts($args);

  // Render the block.
  Timber::render('blocks/post-block.twig', $context);
}



/*

END Custom Blocks

*/
