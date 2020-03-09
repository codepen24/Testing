<?php do_action( 'bp_before_directory_members_page' ); ?>

<div id="buddypress">

	<?php do_action( 'bp_before_directory_members' ); ?>

	<?php do_action( 'bp_before_directory_members_tabs' ); ?>

    <?php
    // We have added "members-order-select" section just to trigger ajax on changing our activity filters. We are hiding this element totally.
    ?>
    <div class="filters" style="display: none;">
        <div class="row">
            <div class="col-6">
                <div class="item-list-tabs" role="navigation">
                    <ul>
                        <li id="members-order-select" class="filter">
                            <label for="members-order-by"><?php _e( 'Order By:', 'boss' ); ?></label>
                            <select id="members-order-by">
                                <option value="active"><?php _e( 'Last Active', 'boss' ); ?></option>
                                <option value="newest"><?php _e( 'Newest Registered', 'boss' ); ?></option>

                                <?php if ( bp_is_active( 'xprofile' ) ) : ?>
                                    <option value="alphabetical"><?php _e( 'Alphabetical', 'boss' ); ?></option>
                                <?php endif; ?>

                                <?php do_action( 'bp_members_directory_order_options' ); ?>
                            </select>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-6">
                <?php bp_get_template_part( 'common/search/dir-search-form' ); ?>
            </div>
        </div>
    </div>

	<form action="" method="post" id="members-directory-form" class="dir-form">
        <?php 
        // wdl_all_members_nav();
        echo do_shortcode('[wpdevlms_all_members_nav]');

        // Activities and Interests xprofile field id.
        $interests_field = new BP_XProfile_Field( 525 );

        // echo "<pre> other_field = ";
        // print_r($other_field);
        // echo "</pre>";

        $interests    = $interests_field->get_children();

        // echo "<pre> interests = ";
        // print_r($interests);
        // echo "</pre>";
        
        $interests_str = '';
        if(!empty($interests)) {
            
            foreach ($interests as $interest) {
                if('other' == strtolower($interest->name)) {
                    continue;
                }
                $interests_str .= '<option value="'.$interest->id.'">'.$interest->name.'</option>';
            }
            // For more info: refer activity-interest-handler in WPDevLMS members plugin.
            $wpdevlms_other_activities = get_option('_wpdevlms_other_activities');
            $other_interests = array();
            if(!empty($wpdevlms_other_activities)) {
                $other_interests = array_map('ucfirst', $wpdevlms_other_activities);
            }
            if(!empty($other_interests)) {
                foreach ($other_interests as $other_interest) {
                    $interests_str .= '<option value="'.$other_interest.'" data-type="other">'.$other_interest.'</option>';
                }
            }
        }


        if(!empty($interests_str)) {
        ?>
            <div class="search-interests">
                <select class="wpdevlms-interests-select2" name="interests[]" id="interests" multiple="multiple" data-placeholder="<?php echo __('Start typing...', 'boss'); ?>">
                  <?php
                  echo $interests_str;
                  ?>
                </select>
                <input type="button" id="wpdevlms_members_filter" class="btn" value="<?php echo __('Search', 'boss'); ?>">
            </div>
        <?php
        }
        ?>
        <?php /* ?>
        <div class="filters">
            <div class="row">
                <div class="col-6">
                    <div class="item-list-tabs" role="navigation">
                        <ul>
                            <li id="members-order-select" class="filter">
                                <label for="members-order-by"><?php _e( 'Order By:', 'boss' ); ?></label>
                                <select id="members-order-by">
                                    <option value="active"><?php _e( 'Last Active', 'boss' ); ?></option>
                                    <option value="newest"><?php _e( 'Newest Registered', 'boss' ); ?></option>

                                    <?php if ( bp_is_active( 'xprofile' ) ) : ?>
                                        <option value="alphabetical"><?php _e( 'Alphabetical', 'boss' ); ?></option>
                                    <?php endif; ?>

                                    <?php do_action( 'bp_members_directory_order_options' ); ?>
                                </select>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-6">
                    <?php bp_get_template_part( 'common/search/dir-search-form' ); ?>
                </div>
            </div>
        </div>
        <?php
        */
        ?>

        <!-- needed for member list scroll -->
        <div id="subnav"></div>

		<div id="members-dir-list" class="members dir-list">
			<?php bp_get_template_part( 'members/members-loop' ); ?>
		</div><!-- #members-dir-list -->

		<?php do_action( 'bp_directory_members_content' ); ?>

		<?php wp_nonce_field( 'directory_members', '_wpnonce-member-filter' ); ?>

		<?php do_action( 'bp_after_directory_members_content' ); ?>

	</form><!-- #members-directory-form -->

	<?php do_action( 'bp_after_directory_members' ); ?>

</div><!-- #buddypress -->

<?php do_action( 'bp_after_directory_members_page' ); ?>
