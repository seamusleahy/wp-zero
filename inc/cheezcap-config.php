<?php
if( class_exists('CheezCap') ) {

  $cap = new CheezCap( array(
      new CheezCapGroup( 'Social Links', 'social-links',
        array(
          new CheezCapTextOption(
            'Facebook link',
            '',
            'link_facebook',
            'http://facebook.com'
          ),
          new CheezCapTextOption(
            'Twitter link',
            '',
            'link_twitter',
            'http://twitter.com'
          ),
          new CheezCapTextOption(
            'Pinterest link',
            '',
            'link_pinterest',
            'http://pinterest.com'
          ),
          new CheezCapTextOption(
            'Google+ link',
            '',
            'link_gplus',
            'http://plus.google.com'
          ),
          
        )
      ),
      new CheezCapGroup( 'Third Party Integration', 'third-party',
        array(
          new CheezCapTextOption(
            'Google Analytics Account',
            '',
            'ga_ua',
            'UAXXXXXXXX1'
          ),                
        )
      ),

    ), array(
      'themename' => 'Site', // used on the title of the custom admin page
      'req_cap_to_edit' => 'manage_options', // the user capability that is required to access the CheezCap settings page
      'cap_menu_position' => 99, // OPTIONAL: This value represents the order in the dashboard menu that the CheezCap menu will display in. Larger numbers push it further down.
      'cap_icon_url' => '', // OPTIONAL: Path to a custom icon for the CheezCap menu item. ex. $cap_icon_url = WP_CONTENT_URL . '/your-theme-name/images/awesomeicon.png'; Image size should be around 20px x 20px.
    )
  );
}