<?php
/**
 * All customization field.
 *
 * @package woocommerce-print-invoice-delivery-notes
 */

?>
<div class="col-sm-4">
	<div class="accordion" id="wdcn_customize">
		<?php
		$customization_data = get_option( 'wcdn_' . $c_tab . '_customization' );
		$settings           = wcdn_customization();
		$label              = wcdn_customization_label();
		$i                  = 1;
		$hidden             = 'pointer-events:none;';
		foreach ( $settings[ $c_tab ] as $key => $eachsetting ) {
			$class = ( 1 === $i ) ? 'show' : '';
			if ( isset( $customization_data['template_setting']['template_setting_template'] ) && 'simple' === $customization_data['template_setting']['template_setting_template'] && 1 === $i ) {
				$hidden = '';
			}
			?>
			<div class="accordion-item">
				<h2 class="accordion-header" id="<?php echo esc_attr( 'ct_acc_' . $i ); ?>">
					<button <?php echo esc_html( $hidden ); ?> class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#ct_acc_<?php echo esc_attr( $i ); ?>_content" aria-expanded="true" aria-controls="ct_acc_<?php echo esc_attr( $i ); ?>_content">
						<?php echo esc_html( $label[ $key ] ); ?>
					</button>
					<?php
					if ( 1 !== $i ) {
						?>
						<label class="switch">
							<input type="checkbox" <?php echo esc_html( $hidden ); ?> name="<?php echo esc_attr( $c_tab . '[' . $key . '][active]' ); ?>" 
								<?php
								if ( isset( $customization_data[ $key ]['active'] ) && 'on' === $customization_data[ $key ]['active'] ) {
									echo 'checked';
								}
								?>
							>
							<span class="slider round"></span>
						</label>
					<?php } ?>
				</h2>
				<?php
				if ( ! empty( $eachsetting ) ) {
					?>
					<div id="<?php echo esc_attr( 'ct_acc_' . $i . '_content' ); ?>" class="accordion-collapse collapse <?php echo esc_attr( $class ); ?>" aria-labelledby="<?php echo esc_attr( 'ct_acc_' . $i ); ?>">
						<div class="accordion-body">
						<?php
						foreach ( $eachsetting as $fieldkey => $field ) {
							$field_id = $key . '_' . strtolower( str_replace( ' ', '_', $field ) );
							if ( 'Title' === $field || 'Text' === $field ) {
								wcdn_customization_textfield( $c_tab, $field_id, $field, $key, $customization_data );
							} elseif ( 'Font Size' === $field ) {
								wcdn_customization_numberfield( $c_tab, $field_id, $field, $key, $customization_data );
							} elseif ( 'Text Align' === $field ) {
								$option = array( 'left', 'right', 'center' );
								wcdn_customization_selectbox( $c_tab, $field_id, $field, $key, $customization_data, $option );
							} elseif ( 'Text Colour' === $field ) {
								wcdn_customization_colorfield( $c_tab, $field_id, $field, $key, $customization_data );
							} elseif ( 'Style' === $field ) {
								$option = array( 'bolder', '800', 'bold', '600', '500', 'normal', '300', '200', 'lighter' );
								wcdn_customization_selectbox( $c_tab, $field_id, $field, $key, $customization_data, $option );
							} elseif ( 'Template' === $field ) {
								$option = array( 'Default', 'Simple' );
								wcdn_customization_selectbox( $c_tab, $field_id, $field, $key, $customization_data, $option );
							} elseif ( 'Formate' === $field ) {
								$option = array( 'm-d-Y', 'd-m-Y', 'Y-m-d', 'd/m/Y', 'd/m/y', 'd/M/y', 'd/M/Y', 'm/d/Y', 'm/d/y', 'M/d/y', 'M/d/Y' );
								wcdn_customization_selectbox( $c_tab, $field_id, $field, $key, $customization_data, $option );
							}
						}
						?>
						</div>
					</div>
				<?php } ?>
			</div>
			<?php
			$i++;
		}
		?>
	</div>
</div>
