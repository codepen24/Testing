<?php
 if (!defined('ABSPATH' ) ) { die(); } ?>
<style>
	.columns {
		float:left;
		width:30%;
		display:inline-block;
		text-align:left;
		margin-right:25px;
		min-width:300px;
	}
</style>
<?php
 memberium_app()->wpalm4is_xw91e_2pl('view_integrations' ); $vwpalm4is_e7hec1bsu = wpalm4is_dwrme417cz::wpalm4is_jlzs8e(); $vwpalm4is_mgdx2z9lh = false; echo '<div style="width:100%;border-color:#000;">'; echo '<div class="columns">'; if (! empty($vwpalm4is_e7hec1bsu['detected'] ) ) { $vwpalm4is_mgdx2z9lh = true; echo '<h3>Activated Integrations</h3>'; echo '<p class="indented">'; foreach ($vwpalm4is_e7hec1bsu['detected'] as $vwpalm4is_n7a31jd0efbt ) { echo 'Detected: <span class="', $vwpalm4is_n7a31jd0efbt['class'], 'plugin">', $vwpalm4is_n7a31jd0efbt['name'], '</span>'; if ($vwpalm4is_n7a31jd0efbt['help'] > 0 ) { echo wpalm4is_yf0g75hqk184::wpalm4is_nu0flh4y2($vwpalm4is_tje6mn['help'] ); } echo '<br>'; } echo '</p>'; } if (! empty($vwpalm4is_e7hec1bsu['problem'] ) ) { $vwpalm4is_mgdx2z9lh = true; echo '<h3>Potential conflicts</h3>'; echo '<p class="indented">'; foreach ($vwpalm4is_e7hec1bsu['problem'] as $vwpalm4is_n7a31jd0efbt ) { echo 'Detected: <span class="badplugin ', $vwpalm4is_n7a31jd0efbt['class'], 'plugin">', $vwpalm4is_n7a31jd0efbt['name'], '</span>'; if ($vwpalm4is_n7a31jd0efbt['help'] > 0 ) { echo wpalm4is_yf0g75hqk184::wpalm4is_nu0flh4y2($vwpalm4is_tje6mn['help'] ); } echo '<br>'; } echo '</p>'; } if (! $vwpalm4is_mgdx2z9lh ) { echo '<p>No Integrations Detected.</p>'; } echo '</div>'; echo '<div class="columns">'; echo '<h3>Available Integrations</h3>'; echo '<p class="indented">'; if (! empty($vwpalm4is_e7hec1bsu['available'] ) ) { foreach ($vwpalm4is_e7hec1bsu['available'] as $vwpalm4is_n7a31jd0efbt ) { echo $vwpalm4is_n7a31jd0efbt['name']; if ($vwpalm4is_n7a31jd0efbt['help'] > 0 ) { echo wpalm4is_yf0g75hqk184::wpalm4is_nu0flh4y2($vwpalm4is_tje6mn['help'] ); } echo '<br>'; } } else { echo 'No additional available integrations.<br>'; } unset($vwpalm4is_e7hec1bsu, $vwpalm4is_n7a31jd0efbt ); echo '</p>'; echo '</div>'; echo '</div>';
