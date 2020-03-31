<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$pdata = infusedwoo_fetch_pdata();
$gdpr_data_dl = get_option('infusedwoo_gdpr_data_dl');

function infusedwoo_gdpr_data_edit_button($k, $v = "") {
	$gdpr_data_edit = get_option('infusedwoo_gdpr_data_edit');
	$link = "";

	if(!$gdpr_data_edit) {
		return false;
	}

	if(in_array($k, array(
			'WPUser:user_email',
			'WPUser:user_login',
			'WPUser:first_name',
			'WPUser:last_name',
			'WPUser:display_name'
		))
	 ) {
		$link = get_permalink( get_option('woocommerce_myaccount_page_id')) . 'edit-account';
	} else if(strpos($k, 'WPUser:') !== false) {
		$link = get_permalink( get_option('woocommerce_myaccount_page_id')) . 'edit-address';
	}

	if($link) {
		echo '<a href="'.$link.'" target="_blank">';
			echo '<button class="button"><i class="fa fa-edit" style="font-size: 14pt"></i></button>';
		echo '</a>';
	}  else {
		echo '<button class="button onspot-edit"><i class="fa fa-edit" style="font-size: 14pt"></i></button>';
		?>
			<div class="data-editing">
				
				<button class="button data-edit-save"><i class="fa fa-check" style="font-size: 14pt"></i></button>
				<button class="button data-edit-close"><i class="fa fa-times" style="font-size: 14pt"></i></button>
			</div>
		<?php
	}
	
}

?>
<style type="text/css">
	.iw-data-edit, .data-editing {
		display: none;
	}

</style>

<?php if($gdpr_data_dl) { ?>
<div style="margin-bottom: 30px; text-align:right;">

<a href="<?php echo admin_url( 'admin-ajax.php?action=iwgdpr_dl_data'); ?>">
	<button class="button" ><i class="fa fa-download"></i> &nbsp;&nbsp;Download My Data (JSON)</button>
</a>
</div>
<?php } ?>

<?php foreach($pdata as $k => $p) : ?>

<?php 	if(!isset($p['value'])) :  ?>

<table>
	<thead>
		<tr>
			<th colspan=3>
				<b><?php echo $k; ?></b>
			</th>
		</tr>	
	</thead>

	<tbody>
		<?php foreach($p as $kk => $vv) : ?>
			<?php $val = $vv['value']; ?>
			<tr>
				<td><?php echo $vv['label']; ?></td>
				<td><span class="iw-data-view"><?php echo $val; ?></span>
					<span class="iw-data-edit"> 
						<input type="text" name="<?php echo $kk; ?>" value="<?php echo $val; ?>" />
					</span>
				</td>
				<td width="50px">
					<?php infusedwoo_gdpr_data_edit_button($kk, $val); ?>
				</td>
			</tr>
		<?php endforeach;?>
		
	</tbody>
</table>

<?php   else : ?>
	<?php $val = $p['value']; ?>
	<table>
		<tbody>
				<tr>
					<td><?php echo $p['label']; ?></td>
					<td><span class="iw-data-view"><?php echo $p['value']; ?></span>
						<span class="iw-data-edit"> 
							<input type="text" name="<?php echo $k; ?>" value="<?php echo $val; ?>" />
						</span>
					</td>
					<td width="50px">
						<?php infusedwoo_gdpr_data_edit_button($k, $val); ?>
					</td>
				</tr>
		</tbody>
	</table>
<?php   endif; ?>

<?php endforeach; ?>

<script type="text/javascript">
	jQuery('.onspot-edit').click(function() {
		jQuery(this).closest('tr').find('.iw-data-view').hide();
		var $input = jQuery(this).closest('tr').find('input[type=text]')
		$input.attr('oldval',$input.val());
		jQuery(this).hide();

		jQuery(this).closest('tr').find('.iw-data-edit').show();
		jQuery(this).parent().children('.data-editing').show();

	});

	jQuery('.data-edit-close').click(function() {
		jQuery(this).closest('tr').find('.iw-data-view').show();
		jQuery(this).closest('tr').find('.iw-data-edit').hide();
		jQuery(this).parent().hide();
		jQuery(this).closest('tr').find('.onspot-edit').show();
	});

	jQuery('.data-edit-save').click(function() {
		var k = jQuery(this).closest('tr').find('input[type=text]').attr('name');
		var v = jQuery(this).closest('tr').find('input[type=text]').val();
		var old = jQuery(this).closest('tr').find('input[type=text]').attr('oldval');
		var pass = {};
		pass[k] = {value: v, old: old};

		var xhr = jQuery.post('<?php echo admin_url('admin-ajax.php?action=iwgdpr_upd_data'); ?>', pass,function(data) {
			if(!data.success) {
				iw_revertfield(xhr.postfield,data.error);
			}
		},'json').fail(function(xhr) {
			iw_revertfield(xhr.postfield);
		}).always(function() {
			jQuery('[name="'+xhr.postfield+'"]').closest('tr').find('.onspot-edit').show();
		});

		xhr.postfield = k;

		jQuery(this).closest('tr').find('.iw-data-view').text(v);

		jQuery(this).closest('tr').find('.iw-data-view').show();
		jQuery(this).closest('tr').find('.iw-data-edit').hide();
		jQuery(this).parent().hide();
		
	});

	function iw_revertfield(k,error="") {
		var error = error ? error : 'Unexpected Error. Update failed.';
		alert(error);
		var oldval = jQuery('input[name="'+k+'"]').attr('oldval');
		jQuery('input[name="'+k+'"]').val(oldval);

		jQuery('input[name="'+k+'"]').closest('tr').find('.iw-data-view').text(oldval);
	}
</script>