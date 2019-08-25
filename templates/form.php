<?php ! defined( 'ABSPATH' ) AND exit( 'Forbidden!' ); ?>

<?php
/**
 * @var $widget        Nazarkinre_WP_Instagram_Widget
 * @var $instance      array
 * @var $template_file string
 */
?>

<div class="nazarkinre-wpiw-form-wrapper">
    <div class="form-group">
        <label for="<?php echo $widget->get_field_id( 'title' ); ?>">
			<?php esc_html_e( 'Widget title:', 'nazarkinre-wpiw' ); ?>
        </label>
        <input class="widefat" id="<?php echo $widget->get_field_id( 'title' ); ?>"
               name="<?php echo $widget->get_field_name( 'title' ); ?>" type="text"
               value="<?php echo esc_attr( $instance['title'] ); ?>"/>
    </div>

    <div class="form-group">
        <label for="<?php echo $widget->get_field_id( 'companion_text' ); ?>">
			<?php esc_html_e( 'Companion text:', 'nazarkinre-wpiw' ); ?>
        </label>
        <input class="widefat" id="<?php echo $widget->get_field_id( 'companion_text' ); ?>"
               name="<?php echo $widget->get_field_name( 'companion_text' ); ?>" type="text"
               value="<?php echo esc_attr( $instance['companion_text'] ); ?>"/>
    </div>

    <div class="form-group">
        <label for="<?php echo $widget->get_field_id( 'companion_text_link' ); ?>">
			<?php esc_html_e( 'Companion text link:', 'nazarkinre-wpiw' ); ?>
        </label>
        <input class="widefat" id="<?php echo $widget->get_field_id( 'companion_text_link' ); ?>"
               name="<?php echo $widget->get_field_name( 'companion_text_link' ); ?>" type="text"
               value="<?php echo esc_attr( $instance['companion_text_link'] ); ?>"/>
    </div>

    <div class="form-group">
        <label for="<?php echo $widget->get_field_id( 'image_size' ); ?>">
			<?php esc_html_e( 'Image size:', 'nazarkinre-wpiw' ); ?>
        </label>
        <select name="<?php echo $widget->get_field_name( 'image_size' ); ?>"
                id="<?php echo $widget->get_field_id( 'image_size' ); ?>" class="widefat">
			<?php $values = array(
				'thumbnail' => __( 'Thumbnail', 'nazarkinre-wpiw' ),
				'small'     => __( 'Small', 'nazarkinre-wpiw' ),
				'large'     => __( 'Large', 'nazarkinre-wpiw' ),
				'original'  => __( 'Original', 'nazarkinre-wpiw' ),
			);
			foreach ( $values as $val => $label ): ?>
				<?php $selected = $instance['image_size'] === $val ? ' selected' : ''; ?>
                <option value="<?php echo esc_attr( $val ); ?>" <?php echo $selected; ?>>
					<?php echo esc_html( $label ); ?>
                </option>
			<?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="<?php echo $widget->get_field_id( 'links_target' ); ?>">
			<?php esc_html_e( 'Open links in:', 'nazarkinre-wpiw' ); ?>
        </label>
        <select name="<?php echo $widget->get_field_name( 'links_target' ); ?>"
                id="<?php echo $widget->get_field_id( 'links_target' ); ?>" class="widefat">
			<?php $values = array(
				'_self'  => __( 'Current window (_self)', 'nazarkinre-wpiw' ),
				'_blank' => __( 'New window (_blank)', 'nazarkinre-wpiw' ),
			);
			foreach ( $values as $val => $label ): ?>
				<?php $selected = $instance['links_target'] === $val ? ' selected' : ''; ?>
                <option value="<?php echo esc_attr( $val ); ?>" <?php echo $selected; ?>>
					<?php echo esc_html( $label ); ?>
                </option>
			<?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="<?php echo $widget->get_field_id( 'images' ); ?>">
			<?php esc_html_e( 'Images:', 'nazarkinre-wpiw' ); ?>
        </label>

        <div class="image-repeatable-fields-list">
            <div class="image-repeatable-field image-repeatable-fields-list__template">
                <div class="image-repeatable-field__image">
                    <div class="image-repeatable-field__image-placeholder">
                        <span class="dashicons dashicons-camera"></span>
                    </div>
                    <input class="image-repeatable-field__image-hidden-field"
                           name="<?php echo $widget->get_field_name( 'images[id][]' ); ?>" type="hidden"/>
                </div>
                <div class="image-repeatable-field__aside">
                    <input class="widefat" name="<?php echo $widget->get_field_name( 'images[description][]' ); ?>"
                           type="text"
                           placeholder="<?php esc_attr_e( 'Post description (optional)', 'nazarkinre-wpiw' ); ?>"/>

                    <input class="widefat" name="<?php echo $widget->get_field_name( 'images[link][]' ); ?>" type="text"
                           placeholder="<?php esc_attr_e( 'Link href (optional)', 'nazarkinre-wpiw' ); ?>"/>
                </div>
                <div class="image-repeatable-field__controls">
                    <a href="#" class="image-repeatable-field__drag-handle">
                        <span class="dashicons dashicons-menu-alt"></span>
                    </a>
                    <a href="#" class="image-repeatable-field__remove">
                        <span class="dashicons dashicons-no-alt"></span>
                    </a>
                </div>
            </div>
            <div class="image-repeatable-fields-list__list">
				<?php foreach ( $instance['images'] as $image ): ?>
                    <div class="image-repeatable-field">
                        <div class="image-repeatable-field__image">
                            <div class="image-repeatable-field__image-placeholder">
                                <span class="dashicons dashicons-camera"></span>
                            </div>
                            <input class="image-repeatable-field__image-hidden-field"
                                   value="<?php echo esc_attr( $image['id'] ); ?>"
                                   name="<?php echo $widget->get_field_name( 'images[id][]' ); ?>" type="hidden"/>
							<?php echo wp_get_attachment_image( $image['id'], 'thumbnail' ); ?>
                        </div>
                        <div class="image-repeatable-field__aside">
                            <input class="widefat"
                                   name="<?php echo $widget->get_field_name( 'images[description][]' ); ?>"
                                   type="text" value="<?php echo esc_attr( $image['description'] ); ?>"
                                   placeholder="<?php esc_attr_e( 'Post description (optional)', 'nazarkinre-wpiw' ); ?>"/>

                            <input class="widefat" name="<?php echo $widget->get_field_name( 'images[link][]' ); ?>"
                                   type="text" value="<?php echo esc_attr( $image['link'] ); ?>"
                                   placeholder="<?php esc_attr_e( 'Link href (optional)', 'nazarkinre-wpiw' ); ?>"/>
                        </div>
                        <div class="image-repeatable-field__controls">
                            <a href="#" class="image-repeatable-field__drag-handle">
                                <span class="dashicons dashicons-menu-alt"></span>
                            </a>
                            <a href="#" class="image-repeatable-field__remove">
                                <span class="dashicons dashicons-no-alt"></span>
                            </a>
                        </div>
                    </div>
				<?php endforeach; ?>
            </div>
            <div class="image-repeatable-fields-list__controls">
                <a href="#" class="image-repeatable-fields-list__add">
					<?php esc_html_e( 'Add new', 'nazarkinre-wpiw' ); ?>
                </a>
            </div>
        </div>
    </div>
</div>
