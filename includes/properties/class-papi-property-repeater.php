<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Papi - Property Repeater
 *
 * @package Papi
 * @version 1.0.0
 */
class Papi_Property_Repeater extends Papi_Property {

	/**
	 * List counter number.
	 *
	 * @var int
	 * @since 1.0.0
	 */

	private $counter = 0;

	/**
	 * The default value.
	 *
	 * @var array
	 * @since 1.0.0
	 */

	public $default_value = array();

	/**
	 * Generate property slug.
	 *
	 * @param object $property
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */

	private function generate_slug( $property ) {
		$options = $this->get_options();

		return $options->slug . '[' . $this->counter . ']' . '[' . _papi_remove_papi( $property->slug ) . ']';
	}

	/**
	 * Get default settings.
	 *
	 * @since 1.0.0
	 *
	 * @return array
	 */

	public function get_default_settings() {
		return array(
			'items' => array()
		);
	}

	/**
	 * Prepare properties, get properties options object,
	 * check which properties that are allowed to use.
	 *
	 * @param $items
	 *
	 * @since 1.0.0
	 *
	 * @return array
	 */

	private function prepare_properties( $items ) {
		$not_allowed = array( 'repeater' );
		$not_allowed = array_merge( $not_allowed, apply_filters( 'papi/property/repeater/not_allowed_properties', array() ) );

		$items = array_map( function ( $item ) {

			if ( is_array( $item ) ) {
				return (object) _papi_get_property_options( $item, false );
			}

			if ( is_object( $item ) ) {
				return $item;
			}

			return null;

		}, $items );

		return array_filter( $items, function ( $item ) use ( $not_allowed ) {

			if ( ! is_object( $item ) ) {
				return false;
			}

			return ! in_array( _papi_get_property_short_type( $item->type ), $not_allowed );
		} );
	}

	/**
	 * Generate the HTML for the property.
	 *
	 * @since 1.0.0
	 */

	public function html() {
		$values          = $this->get_value();
		$settings        = $this->get_settings();

		$settings->items = $this->prepare_properties( $settings->items );
		?>

		<div class="papi-property-repeater">

			<div class="repeater-template">
				<table class="papi-table papi-table-template">
					<tbody>
					<tr>
						<td>
							<span><?php echo $this->counter + 1; ?></span>
						</td>
						<?php
						foreach ( $settings->items as $property ) {
							$template_property        = clone $property;
							$template_property->raw   = true;
							$template_property->value = '';
							$template_property->slug  = $this->generate_slug( $template_property );
							echo '<td>';
							_papi_render_property( $template_property );
							echo '</td>';
						}
						?>
						<td class="last">
                <span>
                  <a title="<?php _e( 'Remove', 'papi' ); ?>" href="#" class="repeater-remove-item">x</a>
                </span>
						</td>
					</tbody>
				</table>
			</div>

			<table class="papi-table">
				<thead>
				<tr>
					<th></th>
					<?php
					foreach ( $settings->items as $property ) {
						echo '<th>' . $property->title . '</th>';
					}
					?>
					<th class="last"></th>
				</tr>
				</thead>
				<tbody>

				<?php foreach ( $values as $value ): ?>
					<tr>
						<td>
							<span><?php echo $this->counter + 1; ?></span>
						</td>
						<?php

						foreach ( $settings->items as $property ):
							$render_property = clone $property;
							$value_slug      = _papi_remove_papi( $render_property->slug );

							// Get property value.
							if ( isset( $value[ $value_slug ] ) ) {
								$render_property->value = $value[ $value_slug ];
							}

							$render_property->slug = $this->generate_slug( $render_property );
							$render_property->raw  = true;
							echo '<td>';
							_papi_render_property( $render_property );
							echo '</td>';
						endforeach;
						$this->counter ++;
						?>
						<td class="last">
                <span>
                  <a title="<?php _e( 'Remove', 'papi' ); ?>" href="#" class="repeater-remove-item">x</a>
                </span>
						</td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>

			<div class="bottom">
				<a href="#" class="button button-primary"><?php _e( 'Add new row', 'papi' ); ?></a>
			</div>

		</div>
	<?php
	}

	/**
	 * Format the value of the property before we output it to the application.
	 *
	 * @param mixed $value
	 * @param int $post_id
	 * @param string $slug
	 *
	 * @since 1.0.0
	 *
	 * @return array
	 */

	public function format_value( $value, $slug, $post_id ) {
		return array_values( $value );
	}

}