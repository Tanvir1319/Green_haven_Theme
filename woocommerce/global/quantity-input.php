<div class="quantity gh-quantity">

	<?php do_action( 'woocommerce_before_quantity_input_field' ); ?>

	<label class="gh-qty-label" for="<?php echo esc_attr( $input_id ); ?>">
		<?php esc_html_e( 'Quantity', 'green-haven' ); ?>
	</label>

	<div class="gh-qty-box">
		<button type="button" class="gh-qty-minus" aria-label="<?php esc_attr_e( 'Decrease quantity', 'green-haven' ); ?>">
			−
		</button>

		<label class="screen-reader-text" for="<?php echo esc_attr( $input_id ); ?>">
			<?php echo esc_html( $label ); ?>
		</label>

		<input
			type="text"
			<?php echo $readonly ? 'readonly="readonly"' : ''; ?>
			id="<?php echo esc_attr( $input_id ); ?>"
			class="<?php echo esc_attr( implode( ' ', array_merge( array( 'gh-qty-input' ), (array) $classes ) ) ); ?>"
			name="<?php echo esc_attr( $input_name ); ?>"
			value="<?php echo esc_attr( $input_value ); ?>"
			aria-label="<?php esc_attr_e( 'Product quantity', 'woocommerce' ); ?>"
			<?php if ( in_array( $type, array( 'text', 'search', 'tel', 'url', 'email', 'password' ), true ) ) : ?>
				size="4"
			<?php endif; ?>
			min="<?php echo esc_attr( $min_value ); ?>"
			<?php if ( 0 < $max_value ) : ?>
				max="<?php echo esc_attr( $max_value ); ?>"
			<?php endif; ?>
			<?php if ( ! $readonly ) : ?>
				step="<?php echo esc_attr( $step ); ?>"
				placeholder="<?php echo esc_attr( $placeholder ); ?>"
				inputmode="<?php echo esc_attr( $inputmode ); ?>"
				autocomplete="<?php echo esc_attr( isset( $autocomplete ) ? $autocomplete : 'on' ); ?>"
			<?php endif; ?>
		/>

		<button type="button" class="gh-qty-plus" aria-label="<?php esc_attr_e( 'Increase quantity', 'green-haven' ); ?>">
			+
		</button>
	</div>

	<?php do_action( 'woocommerce_after_quantity_input_field' ); ?>

</div>