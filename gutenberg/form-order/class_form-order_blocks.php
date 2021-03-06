<?php

namespace Gbomotors_Blocks\Blocks;

class Block_Form_Order {
	public function __construct() {
		add_action( 'init', array( $this, 'register_block' ) );
	}

	public function render_block($attributes) {

		$class = '';

		if ( isset( $attributes['className'] ) ) {
			$class .= ' ' . $attributes['className'];
		}
		ob_start();
			?>

				<div class="home-order">
					<div class="container">
						<div class="row">
							<div class="col-lg-3 d-none d-lg-block">
								<div class="home-order__image">
									<?php echo wp_get_attachment_image(
										$attributes['bgImageId'],
										'full',
										false
									); ?>
								</div>
							</div>
							<div class="col-lg-9">
								<h3><?php echo $attributes['title']; ?></h3>
								<div class="home-order__description">
									<?php echo $attributes['description']; ?>
								</div>
								<?php echo do_shortcode($attributes['shortcodeForm']); ?>
							</div>
						</div>
					</div>
				</div>
			<?php
		return ob_get_clean();
	}

	public function register_block() {
		register_block_type(
			'gbomotors/form-order',
			array(
				'attributes'      => array(
					'className'       => array(
						'type' => 'string',
					),
					'title'     => array(
						'type'    => 'text',
					),
					'description'           => array(
						'type'    => 'string',
					),
					'bgImageId'         => array(
						'type'    => 'number',
					),
					'shortcodeForm'         => array(
						'type'    => 'string',
					),
				),
				'render_callback' => array( $this, 'render_block' ),
			)
		);

	}
}
