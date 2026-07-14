<?php
/**
 * Add custom block category to default categories.
 *
 * @param array[] $block_categories Block categories.
 * @param WP_Block_Editor_Context $block_editor_context Block Editor context.
 *
 * @return array
 */
function hostinger_blocks_starter_block_categories( $block_categories ) {
	return array_merge(
		$block_categories,
		array(
			array(
				'slug'  => 'theme-blocks',
				'title' => esc_html__( 'Theme Blocks', 'hostinger-blog-theme' ),
			),
		)
	);
}

add_filter( 'block_categories_all', 'hostinger_blocks_starter_block_categories', 10, 2 );