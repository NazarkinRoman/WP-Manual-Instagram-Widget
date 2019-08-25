<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' ); ?>

<?php
/**
 * @var $widget        Nazarkinre_WP_Instagram_Widget
 * @var $instance      array
 * @var $template_file string
 */
?>

<?php echo $instance['widget_args']['before_widget']; ?>

<?php do_action( 'wpiw_before_widget', $instance ); ?>

<?php if ( $instance['title'] ): ?>
	<?php echo $instance['widget_args']['before_title'] . $instance['title'] . $instance['widget_args']['after_title']; ?>
<?php endif; ?>

<?php
// define template variables
$size                = $instance['image_size'];
$target              = $instance['links_target'];
$image_sizes_mapping = array( // this mapping projects image sizes from 'null_instagram_widget' to wordpress generics
	'thumbnail' => 'thumbnail',
	'small'     => 'medium',
	'large'     => 'large',
	'original'  => 'full'
);
// filters for custom classes (the same filters used as in 'null_instagram_widget' for compatibility)
$ulclass       = apply_filters( 'wpiw_list_class', 'instagram-pics instagram-size-' . $size );
$liclass       = apply_filters( 'wpiw_item_class', '' );
$aclass        = apply_filters( 'wpiw_a_class', '' );
$imgclass      = apply_filters( 'wpiw_img_class', '' );
$template_part = apply_filters( 'wpiw_template_part', 'parts/wp-instagram-widget.php' );
$linkclass     = apply_filters( 'wpiw_link_class', 'clear' );
$linkaclass    = apply_filters( 'wpiw_linka_class', '' );
?>
<ul class="<?php echo esc_attr( $ulclass ); ?>"><?php
	foreach ( $instance['images'] as $item ) {
		// fill array with all proper sizes for compatibility with 'null_instagram_widget'
		foreach ( $image_sizes_mapping as $image_size_null => $wp_image_size ) {
			$item[ $image_size_null ] = wp_get_attachment_image_url( $item['id'], $wp_image_size );
		}

		// copy the else line into a new file (parts/wp-instagram-widget.php) within your theme and customise accordingly.
		if ( locate_template( $template_part ) !== '' ) {
			include locate_template( $template_part );
		} else {
			$rel = ( $target === '_blank' ) ? 'noopener' : '';
			echo '<li class="' . esc_attr( $liclass ) . '">';
			if ( trim( $item['link'] ) ) {
				echo '<a href="' . esc_url( $item['link'] ) . '" target="' . esc_attr( $target ) . '" rel="' . esc_attr( $rel ) . '"  class="' . esc_attr( $aclass ) . '">';
			}
			echo '<img src="' . esc_url( $item[ $size ] ) . '"  alt="' . esc_attr( $item['description'] ) . '" title="' . esc_attr( $item['description'] ) . '"  class="' . esc_attr( $imgclass ) . '"/>';
			if ( trim( $item['link'] ) ) {
				echo '</a>';
			}
			echo '</li>';
		}
	}
	?>
</ul>

<?php if ( trim( $instance['companion_text'] ) ) : ?>
<p class="<?php echo esc_attr( $linkclass ); ?>">
	<?php if ( $instance['companion_text_link'] ): ?>
        <a href="<?php echo trailingslashit( esc_url( $instance['companion_text_link'] ) ); ?>"
           rel="<?php echo ( $target === '_blank' ) ? 'noopener' : 'me'; ?>"
           target="<?php echo esc_attr( $target ); ?>"
           class="<?php echo esc_attr( $linkaclass ); ?>"><?php echo wp_kses_post( $instance['companion_text'] ); ?></a>
	<?php else: ?>
		<?php echo wp_kses_post( $instance['companion_text'] ); ?>
	<?php endif; ?>
    </p><?php endif; ?>

<?php do_action( 'wpiw_after_widget', $instance ); ?>

<?php echo $instance['widget_args']['after_widget']; ?>
