<?php

// The email fields.
$settings = array (
	'WooCommerce One-Off Emails' => array (
		'fields' => array (
			array (
				'name' => 'wooe_to',
				'type' => 'text',
				'title' => 'To: ',
				'description' => '',
				'placeholder' => 'example001@email.com, example002@email.com',
				'required' => true,
			),
			array (
				'name' => 'wooe_reply_to_name',
				'type' => 'text',
				'title' => 'Reply To Name: ',
				'description' => '',
				'placeholder' => get_option( 'woocommerce_email_from_name' ),
				'required' => false,
			),
			array (
				'name' => 'wooe_reply_to_email',
				'type' => 'email',
				'title' => 'Reply To Email: ',
				'description' => '',
				'placeholder' => get_option( 'woocommerce_email_from_address' ),
				'required' => false,
			),
			array (
				'name' => 'wooe_subject',
				'type' => 'text',
				'title' => 'Subject: ',
				'description' => '',
				'placeholder' => '',
				'required' => true,
			),
			array (
				'name' => 'wooe_heading',
				'type' => 'text',
				'title' => 'Heading: ',
				'description' => '',
				'placeholder' => '',
				'required' => true,
			),
			array (
				'name' => 'wooe_message',
				'type' => 'textarea',
				'title' => 'Message: ',
				'description' => '',
				'placeholder' => '',
				'required' => true,
			),
		),
	),
);
?>
	<form name="wooe_settings" method="post" action="">
		<table>
			<tbody>
			<?php
			foreach ($settings as $section => $fields) {
				?>
				<tr class="tr-section-title">
					<td><h2><?php echo $section; ?></h2><br></td>
				</tr>
				<?php
				foreach ($fields['fields'] as $field => $data) {
					if ($data['type'] == 'textarea') {
						?>
						<tr>
							<td valign="top"><strong><label for="<?php echo $data['name']; ?>"><?php echo $data['title']; ?><?php echo $data['required'] ? '<sup class="required">*</sup>' : ''; ?>
								</strong></label>
								<?php
								if (isset($data['description']) && $data['description']) {
									?>
									<br><?php echo $data['description']; ?>
									<?php
								}
								?>
							</td>
							<td><?php
								$content = '';
								$editor_id = $data['name'];
								wp_editor($content, $editor_id);
								?>
							</td>
						</tr>
						<?php
					} else {
						$placeholder = (isset($data['placeholder']) ? $data['placeholder'] : '');
						?>
						<tr>
							<td><strong><label for="<?php echo $data['name']; ?>"><?php echo $data['title']; ?><?php echo $data['required'] ? '<sup class="required">*</sup>' : ''; ?>
								</strong></label>
								<?php
								if (isset($data['description']) && $data['description']) {
									?>
									<br><?php echo $data['description']; ?>
									<?php
								}
								?>
							</td>
							<td><input id="<?php echo $data['name']; ?>" type="<?php echo $data['type']; ?>" name="<?php echo $data['name']; ?>" value="" placeholder="<?php echo $placeholder; ?>"></td>
						</tr>
						<?php
					}
				}
			}
			?>
			</tbody>
		</table>
		<button id="wooe_send_email" class="button button-primary">Send</button>
		<button id="wooe_preview_email" class="button button-default">Preview</button>
		<div id="wooe_ajax_res_send_email"></div>
		<div id="wooe_preview_window"></div>
	</form>
<?php
