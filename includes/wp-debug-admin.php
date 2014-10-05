<?php
/***********************************************************                                                          
    _____   _       _     
   |  _  |_| |_____|_|___ 
   |     | . |     | |   |
   |__|__|___|_|_|_|_|_|_|

  Wp-Debug :: Admin

*/

class WpDebugAdmin
{
    public function __construct(){
    	   add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
	   add_action( 'admin_init', array( $this, 'page_init' ) );
    }

  /**
   * Add options page
   */
  public function add_plugin_page(){
      // This page will be under "Settings"
      add_options_page(
          'WpDebug', 
          'WpDebug', 
          'manage_options', 
          'wp-debug-admin', 
          array( $this, 'create_admin_page' )
      );
  }

  /**
   * Options page callback
   */
  public function create_admin_page(){
    // Set class property
    $this->options = get_option( 'wp-debug' );
    ?>
    <div class="wrap">
      <?php screen_icon(); ?>
      <h2>WpDebug Settings</h2>           
      <form method="post" action="options.php">
        <?php
          // This prints out all hidden setting fields
          settings_fields( 'wp-debug' );   
          do_settings_sections( 'wp-debug-admin' );
          submit_button(); 
        ?>
      </form>
    </div>
    <?php
  }

  /**
   * Register and add settings
   */
  public function page_init(){        
    register_setting(
      'wp-debug', // Option group
      'wp-debug', // Option name
      array( $this, 'sanitize' ) // Sanitize
    );

    add_settings_section(
      'setting_section_id', // ID
      'General Settings', // related_posts
      array( $this, 'print_section_info' ), // Callback
      'wp-booj-admin' // Page
    );  

    add_settings_field(
      'use_WpDebug',
      'Enable Debugger',
      array( $this, 'use_WpBoojDebug_callback' ),
      'wp-debug-admin',
      'setting_section_id'
    );
  }

  public function use_WpBoojDebug_callback(){
    ?>
    <input type="checkbox" name="wp-booj[use_WpBoojDebug]" <? if( $this->options['use_WpBoojDebug'] == 'on' ){ echo 'checked="checked"'; } ?> />
    <?php
  }

  /**
   * Sanitize each setting field as needed
   *
   * @param array $input Contains all settings fields as array keys
   */
  public function sanitize( $input ){
    $new_input = array();
    
    if( isset( $input['use_WpBoojDebug'] ) )
      $new_input['use_WpBoojDebug'] = $input['use_WpBoojDebug'];

    return $new_input;
  }

  /** 
   * Print the Section text
   */
  public function print_section_info(){
    print "If you don't understand these options, you will want to leave them as they are!";
  }

}

/* ENDFILE: includes/wp-debug-admin.php */

