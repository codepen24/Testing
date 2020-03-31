<?php
 if (!defined('ABSPATH' ) ) { die(); } if (!current_user_can('manage_options' ) ) { wp_die(__('You do not have sufficient permissions to access this page.' ) ); } global $i2sdk, $wpdb; $vwpalm4is_ne17fdv8uw4 = $this->settings['settings']; $vwpalm4is_ne17fdv8uw4['merchant_account_id'] = isset($vwpalm4is_ne17fdv8uw4['merchant_account_id'] ) ? $vwpalm4is_ne17fdv8uw4['merchant_account_id'] : 0; $vwpalm4is_ne17fdv8uw4['affiliate_detect'] = isset($vwpalm4is_ne17fdv8uw4['affiliate_detect'] ) ? $vwpalm4is_ne17fdv8uw4['affiliate_detect'] : 0; $_GET['tab'] = isset($_GET['tab'] ) ? $_GET['tab'] : 'general'; if ($_SERVER['REQUEST_METHOD'] == 'POST' ) { if (! wp_verify_nonce($_POST['memberium_ecommerce_nonce'], MEMBERIUM_LIB ) ) { wp_die('nonce error' ); return; } if (isset($_GET['tab'] ) ) { if ($_GET['tab'] == 'general' ) { $vwpalm4is_ne17fdv8uw4['affiliate_detect'] = isset($_POST['affiliate_detect'] ) ? $_POST['affiliate_detect'] : $vwpalm4is_ne17fdv8uw4['affiliate_detect']; $vwpalm4is_ne17fdv8uw4['merchant_account_id'] = isset($_POST['merchant_account_id'] ) ? (int) trim($_POST['merchant_account_id'] ) : $vwpalm4is_ne17fdv8uw4['merchant_account_id']; wpalm4is_yf0g75hqk184::wpalm4is_in62ibjlx('General eCommerce Options Updated' ); } elseif ($_GET['tab'] == 'subscriptions' ) { $this->settings['ecommerce']['actions'] = array(); foreach($_POST as $vwpalm4is_x3e6m_hobj => $vwpalm4is_kh9vqi_6znd ) { if (is_array($vwpalm4is_kh9vqi_6znd ) ) { $this->settings['ecommerce']['actions'][$vwpalm4is_x3e6m_hobj] = $vwpalm4is_kh9vqi_6znd; } } wpalm4is_yf0g75hqk184::wpalm4is_in62ibjlx('Subscription Management Options Updated' ); } elseif ($_GET['tab'] == 'invoices' ) { $vwpalm4is_w9ctf7psv = get_option('memberium_invoice_template', false ); $vwpalm4is_w9ctf7psv['header'] = isset($_POST['invoice_header'] ) ? trim(stripslashes($_POST['invoice_header'] ) ) : ''; $vwpalm4is_w9ctf7psv['items'] = isset($_POST['invoice_items'] ) ? trim(stripslashes($_POST['invoice_items'] ) ) : ''; $vwpalm4is_w9ctf7psv['pre_payments'] = isset($_POST['invoice_pre_payments'] ) ? trim(stripslashes($_POST['invoice_pre_payments'] ) ) : ''; $vwpalm4is_w9ctf7psv['payments'] = isset($_POST['invoice_payments'] ) ? trim(stripslashes($_POST['invoice_payments'] ) ) : ''; $vwpalm4is_w9ctf7psv['pre_scheduled'] = isset($_POST['invoice_pre_scheduled'] ) ? trim(stripslashes($_POST['invoice_pre_scheduled'] ) ) : ''; $vwpalm4is_w9ctf7psv['scheduled'] = isset($_POST['invoice_scheduled'] ) ? trim(stripslashes($_POST['invoice_scheduled'] ) ) : ''; $vwpalm4is_w9ctf7psv['footer'] = isset($_POST['invoice_footer'] ) ? trim(stripslashes($_POST['invoice_footer'] ) ) : ''; $vwpalm4is_w9ctf7psv = update_option('memberium_invoice_template', $vwpalm4is_w9ctf7psv ); wpalm4is_yf0g75hqk184::wpalm4is_in62ibjlx('Invoice Display Options Updated' ); } } $this->settings['settings'] = $vwpalm4is_ne17fdv8uw4; update_option('memberium', $this->settings ); } wpalm4is_yf0g75hqk184::wpalm4is_lu3h0vq(); $vwpalm4is_ux_y3jt1 = array( 'general' => '<i class="fas fa-shopping-cart"></i> General', 'subscriptions' => '<i class="fas fa-sync-alt fa-spin"></i> Subscriptions', 'invoices' => '<i class="fas fa-file-invoice-dollar"></i> Invoices', ); $vwpalm4is_q7qg9evksmf0 = isset($_GET['tab'] ) ? strtolower($_GET['tab'] ) : 'general'; echo '<div class="wrap">'; echo '<h1>', _('eCommerce Settings' ), '</h1>'; echo '<h2 class="nav-tab-wrapper">'; foreach ($vwpalm4is_ux_y3jt1 as $vwpalm4is_xd_mu53v0kb => $vwpalm4is_gtyqfor0c8ib ) { $class = ($vwpalm4is_xd_mu53v0kb == $vwpalm4is_q7qg9evksmf0 ) ? ' nav-tab-active' : ''; if ($vwpalm4is_xd_mu53v0kb == $vwpalm4is_q7qg9evksmf0 ) { echo "<span class='nav-tab$class'>$vwpalm4is_gtyqfor0c8ib</span>"; } else { echo "<a class='nav-tab$class' href='?page=", $_GET['page'], "&tab=$vwpalm4is_xd_mu53v0kb'>$vwpalm4is_gtyqfor0c8ib</a>"; } } echo '</h2>'; echo '<div class="tabcontent" style="margin-top:10px;">'; if ($vwpalm4is_q7qg9evksmf0 == 'general' ) { echo '<form method="POST" action="">'; wp_nonce_field(MEMBERIUM_LIB, 'memberium_ecommerce_nonce' ); echo '<ul>'; wpalm4is_yf0g75hqk184::wpalm4is_ak_b1tzs8('Affiliate AutoDetect', 'affiliate_detect', 9124, $vwpalm4is_ne17fdv8uw4['affiliate_detect'] ); wpalm4is_yf0g75hqk184::wpalm4is_h60alck( 'Password Reset Tag', 'first_login_page', (int) $vwpalm4is_ne17fdv8uw4['password_reset_tag'], 'taglistdropdown', array('help_id' => 1183 ) ); wpalm4is_yf0g75hqk184::wpalm4is_kdfb73nti6c( 'Default Merchant Account', 'merchant_account_id', $vwpalm4is_ne17fdv8uw4['merchant_account_id'], array('help_id' => 6167, 'min' => 0, 'max' => 999, 'size' => 4, 'style' => 'text-align:right;width:80px;' ) ); echo '</ul>'; echo '<p><input type="submit" value="Update" class="button-primary"></p>'; echo '</form>'; } elseif ($vwpalm4is_q7qg9evksmf0 == 'subscriptions' ) { echo '<form method="POST" action="">'; wp_nonce_field(MEMBERIUM_LIB, 'memberium_ecommerce_nonce' ); echo '<table class="widefat" style="white-space:nowrap;">'; echo '<tr>'; echo '<th>Subscription</th><th>Payment Action</th><th>Payment Goal</th><th>Cancel Action</th><th>Cancel Goal</th><th>End Date Action</th><th>End Date Goal</th>'; echo '</tr>'; $vwpalm4is_zua2jqcw95 = memberium_app()->wpalm4is_rkfrzw(); $vwpalm4is_ssxdjp0 = memberium_app()->wpalm4is_c0kzjaiw5(); if (is_array($vwpalm4is_zua2jqcw95 ) ) { foreach ($vwpalm4is_zua2jqcw95 as $vwpalm4is_hs69ar ) { if ($vwpalm4is_hs69ar['Active'] ) { $pay_action = isset($this->settings['ecommerce']['actions'][$vwpalm4is_hs69ar['Id']]['pay_action'] ) ? $this->settings['ecommerce']['actions'][$vwpalm4is_hs69ar['Id']]['pay_action'] : ''; $cancel_action = isset($this->settings['ecommerce']['actions'][$vwpalm4is_hs69ar['Id']]['cancel_action'] ) ? $this->settings['ecommerce']['actions'][$vwpalm4is_hs69ar['Id']]['cancel_action'] : ''; $end_action = isset($this->settings['ecommerce']['actions'][$vwpalm4is_hs69ar['Id']]['end_action'] ) ? $this->settings['ecommerce']['actions'][$vwpalm4is_hs69ar['Id']]['end_action'] : ''; $pay_goal = isset($this->settings['ecommerce']['actions'][$vwpalm4is_hs69ar['Id']]['pay_goal'] ) ? $this->settings['ecommerce']['actions'][$vwpalm4is_hs69ar['Id']]['pay_goal'] : ''; $cancel_goal = isset($this->settings['ecommerce']['actions'][$vwpalm4is_hs69ar['Id']]['cancel_goal'] ) ? $this->settings['ecommerce']['actions'][$vwpalm4is_hs69ar['Id']]['cancel_goal'] : ''; $end_goal = isset($this->settings['ecommerce']['actions'][$vwpalm4is_hs69ar['Id']]['end_goal'] ) ? $this->settings['ecommerce']['actions'][$vwpalm4is_hs69ar['Id']]['end_goal'] : ''; echo '<tr>'; echo '<td>', $vwpalm4is_ssxdjp0[$vwpalm4is_hs69ar['ProductId']]['ProductName'], ' - $', sprintf('%01.2f', $vwpalm4is_hs69ar['PlanPrice'] ), ' / ', $vwpalm4is_hs69ar['FrequencyWord'], '</td>'; echo '<td><input class="actionsetdropdown" type="text" value="', $pay_action, '" name="', $vwpalm4is_hs69ar['Id'], '[pay_action]"></td>'; echo '<td><input type="text" value="', $pay_goal, '" name="', $vwpalm4is_hs69ar['Id'], '[pay_goal]"></td>'; echo '<td><input class="actionsetdropdown" type="number" min="0" max="99999" size="3" value="', (int) $cancel_action, '" name="', $vwpalm4is_hs69ar['Id'], '[cancel_action]"></td>'; echo '<td><input type="text" value="', $cancel_goal, '" name="', $vwpalm4is_hs69ar['Id'], '[cancel_goal]"></td>'; echo '<td><input class="actionsetdropdown" type="number" min="0" max="99999" size="5" value="', (int) $end_action, '" name="', $vwpalm4is_hs69ar['Id'], '[end_action]"></td>'; echo '<td><input type="text" value="', $end_goal, '" name="', $vwpalm4is_hs69ar['Id'], '[end_goal]"></td>'; echo '</tr>'; } } } echo '</table>'; echo '<p><input type="submit" value="Update" class="button-primary"></p>'; echo '</form>'; } elseif ($vwpalm4is_q7qg9evksmf0 == 'invoices' ) { echo '<form method="POST" action="">'; wp_nonce_field(MEMBERIUM_LIB, 'memberium_ecommerce_nonce' ); echo '<ul>'; echo '<h2>Invoice Display Styler</h2>'; $vwpalm4is_w9ctf7psv = get_option('memberium_invoice_template', false );  echo '<style> textarea { background-color: antiquewhite; } </style>'; echo '<li><label style="vertical-align:top;">Header ', wpalm4is_yf0g75hqk184::wpalm4is_nu0flh4y2(0000 ), '</label>'; echo '<textarea name="invoice_header" cols=80 rows=3>', isset($vwpalm4is_w9ctf7psv['header'] ) ? $vwpalm4is_w9ctf7psv['header'] : '', '</textarea>'; echo '</li>';  echo '<li><label style="vertical-align:top;">Line Items ', wpalm4is_yf0g75hqk184::wpalm4is_nu0flh4y2(0000 ), '</label>'; echo '<textarea name="invoice_items" cols=80 rows=3>',isset($vwpalm4is_w9ctf7psv['items'] ) ? $vwpalm4is_w9ctf7psv['items'] : '', '</textarea>'; echo '</li>';  echo '<li><label style="vertical-align:top;">Payments Header', wpalm4is_yf0g75hqk184::wpalm4is_nu0flh4y2(0000 ), '</label>'; echo '<textarea name="invoice_pre_payments" cols=80 rows=3>',isset($vwpalm4is_w9ctf7psv['pre_payments'] ) ? $vwpalm4is_w9ctf7psv['pre_payments'] : '', '</textarea>'; echo '</li>';  echo '<li><label style="vertical-align:top;">Payments ', wpalm4is_yf0g75hqk184::wpalm4is_nu0flh4y2(0 ), '</label>'; echo '<textarea name="invoice_payments" cols=80 rows=3>',isset($vwpalm4is_w9ctf7psv['payments'] ) ? $vwpalm4is_w9ctf7psv['payments'] : '', '</textarea>'; echo '</li>';  echo '<li><label style="vertical-align:top;">Scheduled Payments Header ', wpalm4is_yf0g75hqk184::wpalm4is_nu0flh4y2(0000 ), '</label>'; echo '<textarea name="invoice_pre_scheduled" cols=80 rows=3>',isset($vwpalm4is_w9ctf7psv['pre_scheduled'] ) ? $vwpalm4is_w9ctf7psv['pre_scheduled'] : '', '</textarea>'; echo '</li>';  echo '<li><label style="vertical-align:top;">Scheduled Payments ', wpalm4is_yf0g75hqk184::wpalm4is_nu0flh4y2(0000 ), '</label>'; echo '<textarea name="invoice_scheduled" cols=80 rows=3>',isset($vwpalm4is_w9ctf7psv['scheduled'] ) ? $vwpalm4is_w9ctf7psv['scheduled'] : '', '</textarea>'; echo '</li>';  echo '<li><label style="vertical-align:top;">Footer ', wpalm4is_yf0g75hqk184::wpalm4is_nu0flh4y2(0000 ), '</label>'; echo '<textarea name="invoice_footer" cols=80 rows=3>',isset($vwpalm4is_w9ctf7psv['footer'] ) ? $vwpalm4is_w9ctf7psv['footer'] : '', '</textarea>'; echo '</li>'; echo '<p><input type="submit" value="Update" class="button-primary"></p>'; echo '</form>'; echo '<li><label style="vertical-align:top;">%% Codes</label>'; echo '<div style="display:inline-block;width:600px;">'; $vwpalm4is_l2wues_ = array( 'invoice', array('job', 'order' ), 'contact', 'payplan', 'payment', array('payplanitem', 'scheduled' ), array('orderitem', 'item' ), ); foreach ($vwpalm4is_l2wues_ as $vwpalm4is__mnral5zjy ) { if (is_array ($vwpalm4is__mnral5zjy ) ) { $prefix = $vwpalm4is__mnral5zjy[1]; $vwpalm4is__mnral5zjy = $vwpalm4is__mnral5zjy[0]; } else { $prefix = $vwpalm4is__mnral5zjy; } $vwpalm4is_iomhdlzi73g5 = wpalm4is_bd5uye4ng3l::wpalm4is_qpf_6x7($vwpalm4is__mnral5zjy, false ); sort($vwpalm4is_iomhdlzi73g5 ); echo '<strong>', ucwords($prefix ), '</strong><br />'; if (is_array($vwpalm4is_iomhdlzi73g5 ) ) { foreach($vwpalm4is_iomhdlzi73g5 as $vwpalm4is_cbkmin3z ) { $vwpalm4is_d5kqsi90y = '%%' . $prefix . '.' . strtolower($vwpalm4is_cbkmin3z ) . '%%'; echo '<input type="text" size="', strlen($vwpalm4is_d5kqsi90y ) + 2, '" value="', $vwpalm4is_d5kqsi90y, '" readonly style="text-align:center;"> '; } echo '<br><br>'; } } echo '<strong>Custom Codes</strong><br />'; $vwpalm4is_iomhdlzi73g5 = array('subtotal' ); foreach($vwpalm4is_iomhdlzi73g5 as $vwpalm4is_cbkmin3z ) { $vwpalm4is_d5kqsi90y = '%%receipt.' . strtolower($vwpalm4is_cbkmin3z ) . '%%'; echo '<input type="text" size="', strlen($vwpalm4is_d5kqsi90y ) + 2, '" value="', $vwpalm4is_d5kqsi90y, '" readonly style="text-align:center;"> '; } echo '</div></li>'; echo '</ul>'; } elseif ($vwpalm4is_q7qg9evksmf0 == '1click' ) { } elseif ($vwpalm4is_q7qg9evksmf0 == 'products' ) { } elseif ($vwpalm4is_q7qg9evksmf0 == 'paypal' ) { echo '<form method="POST" action="">'; wp_nonce_field(MEMBERIUM_LIB, 'memberium_ecommerce_nonce' ); echo '<ul>'; echo '<li><label>PayPal API</label>'; echo '<li><label>API Username</label><input type="text" id="paypal_api_username" name="paypal_api_username" value="', $this->settings['settings']['paypal_api_username'], '">', wpalm4is_yf0g75hqk184::wpalm4is_nu0flh4y2(0000 ), '</li>'; echo '<li><label>API Password</label><input type="text" id="paypal_api_password" name="paypal_api_password" value="', $this->settings['settings']['paypal_api_password'], '">', wpalm4is_yf0g75hqk184::wpalm4is_nu0flh4y2(0000 ), '</li>'; echo '<li><label>API Signature</label><input type="text" id="paypal_api_signature" name="paypal_api_signature" value="', $this->settings['settings']['paypal_api_signature'], '">', wpalm4is_yf0g75hqk184::wpalm4is_nu0flh4y2(0000 ), '</li>'; echo wpalm4is_yf0g75hqk184::wpalm4is_ak_b1tzs8('PayPal Live Mode', 'paypal_live', 000 ); echo '</ul>'; echo '<p><input type="submit" value="Update" class="button-primary"></p>'; echo '</form>'; echo '<p>Need help finding your PayPal API credentials?  <a href="https://www.paypal.com/us/cgi-bin/webscr?cmd=_profile-api-access" target="_blank">Click Here</a>'; } elseif ($vwpalm4is_q7qg9evksmf0 == 'stripe' ) { echo '<form method="POST" action="">'; wp_nonce_field(MEMBERIUM_LIB, 'memberium_ecommerce_nonce' ); echo '<ul>'; echo '<li><label>Stripe API</label>'; echo '<li><label>Secret Key</label><input type="text" id="stripe_secret_key" name="stripe_secret_key" value="', $this->settings['settings']['stripe_secret_key'], '">', wpalm4is_yf0g75hqk184::wpalm4is_nu0flh4y2(0000 ), '</li>'; echo '<li><label>Publishable Key</label><input type="text" id="stripe_public_key" name="stripe_public_key" value="', $this->settings['settings']['stripe_public_key'], '">', wpalm4is_yf0g75hqk184::wpalm4is_nu0flh4y2(0000 ), '</li>'; echo wpalm4is_yf0g75hqk184::wpalm4is_ak_b1tzs8('Stripe Live Mode', 'stripe_live', 000 ); echo '</ul>'; echo '<p><input type="submit" value="Update" class="button-primary"></p>'; echo '</form>'; echo '<p>Need help finding your Stripe API credentials?  <a href="https://manage.stripe.com/account/apikeys" target="_blank">Click Here</a>'; } elseif ($vwpalm4is_q7qg9evksmf0 == 'amazon' ) { } elseif ($vwpalm4is_q7qg9evksmf0 == 'tax' ) { } else { memberium_app()->wpalm4is_xw91e_2pl('easter_egg' ); echo wp_oembed_get('https://www.youtube.com/watch?v=zgvXtexdgAM', array('autoplay' => '1' ) ); echo '<p>Klaatu Barada N... Necktie... Neckturn... Nickel...</p><p>It\'s an "N" word, it\'s definitely an "N" word!</p><p>Klaatu... Barada... N...</p>'; } echo '</div>'; echo '</div>'; $vwpalm4is_gf2m1t7v8nbz = wpalm4is_l9n25d::wpalm4is_d35w2jzaf(true); $vwpalm4is_gf2m1t7v8nbz = $vwpalm4is_gf2m1t7v8nbz['mc']; $vwpalm4is_pos1lk = array(); $vwpalm4is_pos1lk[] = array('id' => 0, 'text' => '(None)' ); foreach ( (array) $vwpalm4is_gf2m1t7v8nbz as $vwpalm4is_vzoj7cv_rsly => $vwpalm4is_agvwtn ) { $vwpalm4is_pos1lk[] = array('id' => $vwpalm4is_vzoj7cv_rsly, 'text' => $vwpalm4is_agvwtn . ' (' . $vwpalm4is_vzoj7cv_rsly . ')' ); } $vwpalm4is_pos1lk = json_encode($vwpalm4is_pos1lk ); unset($vwpalm4is_gf2m1t7v8nbz, $vwpalm4is_vzoj7cv_rsly, $vwpalm4is_agvwtn ); $vwpalm4is_cevdqnb5lzm = 'SELECT `id`, `name` FROM ' . MEMBERIUM_DB_ACTIONSETS . ' WHERE `appname` = %s AND `name` > "" ORDER BY `name` ASC'; $vwpalm4is_cevdqnb5lzm = $wpdb->prepare($vwpalm4is_cevdqnb5lzm, $this->appname ); $vwpalm4is_l6ih20yjwm = $wpdb->get_results($vwpalm4is_cevdqnb5lzm, ARRAY_A ); $vwpalm4is_kpql0yokc7 = array(); $vwpalm4is_kpql0yokc7[] = array('id' => 0, 'text' => '(No Action)' ); foreach ($vwpalm4is_l6ih20yjwm as $vwpalm4is_vzoj7cv_rsly => $vwpalm4is_hs69ar ) { $vwpalm4is_kpql0yokc7[] = array('id'=>$vwpalm4is_hs69ar['id'], 'text'=>$vwpalm4is_hs69ar['name'] ); } $vwpalm4is_kpql0yokc7 = json_encode($vwpalm4is_kpql0yokc7 ); unset($vwpalm4is_l6ih20yjwm, $vwpalm4is_vzoj7cv_rsly, $vwpalm4is_hs69ar, $vwpalm4is_cevdqnb5lzm ); echo '<script>'; echo 'var actionsetlist = ', $vwpalm4is_kpql0yokc7, ';'; echo 'var taglist       = ', $vwpalm4is_pos1lk, ';'; echo '</script>'; unset($vwpalm4is_kpql0yokc7, $vwpalm4is_pos1lk );
