<?php
 if (!defined('ABSPATH' ) ) { die(); } if (!current_user_can('manage_options' ) ) { wp_die(__('You do not have sufficient permissions to access this page.' ) ); } global $wpdb, $i2sdk; $vwpalm4is_egp4k6_1vq = 5; $vwpalm4is_vsmw53_cfzn = get_option('i2sdk' ); $this->settings = wpalm4is_xb7t0i6pzn::wpalm4is_s0xuab5fq6hy(); $vwpalm4is_m09kqgr1ih = (array)$this->settings['ga_customvars']; $vwpalm4is_liabs431t_o = array('' => '[Select the Variable]', '!system.membership_level' => 'Membership Level', '!system.membership_name' => 'Membership Name', ); $vwpalm4is_iomhdlzi73g5 = wpalm4is_bd5uye4ng3l::wpalm4is_qpf_6x7('Contact', TRUE ); $vwpalm4is_j4m_7fuyv = array('' ); foreach ($vwpalm4is_iomhdlzi73g5 as $vwpalm4is_o70_tv => $vwpalm4is_cbkmin3z ) { $vwpalm4is_liabs431t_o['!contact.' . strtolower($vwpalm4is_cbkmin3z ) ] = 'Contact ' . $vwpalm4is_cbkmin3z; } $vwpalm4is_iomhdlzi73g5 = wpalm4is_bd5uye4ng3l::wpalm4is_qpf_6x7('Affiliate', TRUE); foreach ($vwpalm4is_iomhdlzi73g5 as $vwpalm4is_o70_tv => $vwpalm4is_cbkmin3z ) { $vwpalm4is_liabs431t_o['!affiliate.' . strtolower($vwpalm4is_cbkmin3z ) ] = 'Affiliate ' . $vwpalm4is_cbkmin3z; } if ($_SERVER['REQUEST_METHOD'] == 'POST' ) {  if (isset($_POST['add-variable'] ) ) { $vwpalm4is_m09kqgr1ih[$_POST['slot_id']] = array('name' => $_POST['slot_name'], 'variable' => $_POST['slot_variable'], 'label' => $vwpalm4is_liabs431t_o[$_POST['slot_variable']], ); wpalm4is_yf0g75hqk184::wpalm4is_in62ibjlx('Custom Variable Added' ); }  if (!empty($_POST['delete'] ) ) { foreach ($_POST['delete'] as $vwpalm4is_x3e6m_hobj => $vwpalm4is_kh9vqi_6znd ) { if ($vwpalm4is_kh9vqi_6znd == 'on' ) { unset($vwpalm4is_m09kqgr1ih[$vwpalm4is_x3e6m_hobj] ); wpalm4is_yf0g75hqk184::wpalm4is_in62ibjlx('Custom Variable Deleted' ); } } }  $this->settings['ga_customvars'] = $vwpalm4is_m09kqgr1ih; update_option('memberium', $this->settings ); } $vwpalm4is_gie9zlnygt = array( ); for ($i = 1; $i <= $vwpalm4is_egp4k6_1vq; $i++ ) { if (!isset($vwpalm4is_m09kqgr1ih[$i] ) ) { $vwpalm4is_gie9zlnygt[] = $i; } } wpalm4is_yf0g75hqk184::wpalm4is_lu3h0vq(); ?>
<div class="wrap">
	<h1>Memberium Google Analytics Settings</h1>
	<?php
 if (count($vwpalm4is_m09kqgr1ih ) > $vwpalm4is_egp4k6_1vq ) { echo '<tr><td colspan="6">', _e('All custom variable slots are assigned.' ), '</td></tr>'; } else { $vwpalm4is_seiaw3 = ''; foreach ($vwpalm4is_liabs431t_o as $vwpalm4is_kh9vqi_6znd => $vwpalm4is_tbz0wc5kj37 ) { $vwpalm4is_seiaw3.= '<option value="' . $vwpalm4is_kh9vqi_6znd . '">' . $vwpalm4is_tbz0wc5kj37 . '</option>'; } $vwpalm4is_nz6uq84dcmx = ''; foreach ($vwpalm4is_gie9zlnygt as $vwpalm4is_tbz0wc5kj37 ) { $vwpalm4is_nz6uq84dcmx.= '<option value="' . $vwpalm4is_tbz0wc5kj37 . '">' . $vwpalm4is_tbz0wc5kj37 . '</option>'; } ?>
		<h3>Add New Custom Variable</h3>
		<div style="width:800px;">
			<form method="POST" action="">
				<table class="widefat">
					<tr>
						<th>Custom Variable Label</th>
						<th>Order</th>
						<th>Value</th>
					</tr>
					<tr>
						<td><input name="slot_name" type="text" size="25" required="required" placeholder="Your name for this variable"/></td>
						<td><select name="slot_id" required="required"><?php echo $vwpalm4is_nz6uq84dcmx; ?></select></td>
						<td><select name="slot_variable" required="required"><?php echo $vwpalm4is_seiaw3; ?></select></td>
					</tr>
				</table>
				&nbsp;<br />
				<input type="submit" name="add-variable" value="Add Custom Variable" class="button-primary" />
				<hr />
			</form>
		</div>
		<?php
 } ?>
	<h3>Current Custom Variables</h3>
	<div style="width:800px;">
		<form method="POST" action="">
			<hr />
			<table class="widefat" style="white-space:nowrap;">
				<tr>
					<th>Custom Variable Label</th>
					<th>Order</th>
					<th>Value</th>
					<th>Delete?</th>
				</tr>
				<?php
 if (count($vwpalm4is_m09kqgr1ih ) == 0 ) { echo '<td colspan="99">You have no custom variables defined.</td>'; } else { foreach ( (array)$vwpalm4is_m09kqgr1ih as $vwpalm4is_ri0lmwet => $vwpalm4is_m3dyf1vjis ) { echo '<tr>'; echo '<td>'; echo $vwpalm4is_m3dyf1vjis['name']; echo '</td>'; echo '<td>'; echo $vwpalm4is_ri0lmwet; echo '</td>'; echo '<td>'; echo $vwpalm4is_m3dyf1vjis['label']; echo '</td>'; echo '<td>'; echo '<input type="checkbox" name="delete[' . $vwpalm4is_ri0lmwet . ']">'; echo '</td>'; echo '</tr>'; } } ?>
			</table>
			&nbsp;<br />
			<input type="submit" name="delete-variables" value="Delete Custom Variables" class="button-secondary" />
		</form>
	</div>
</div>
<hr />
