<?php  if ( ! defined('EXT') ) exit('Invalid file request');
/**
 * A basic ExpressionEngine extension skeleton for add-on development.
 *
 * @package		ExpressionEngine
 * @category	Extention
 * @author		Todd Henderson <mthenderson@icloud.com>
 * @copyright	Copyright (c) 2013, Todd Henderson
 * @license		http://www.gnu.org/copyleft/gpl.html GNU General Public License, version 3
 */
require_once PATH_THIRD . 'extension_skeleton/config.php';

class Extension_skeleton_ext {

	public  $settings       = array();
	public  $name           = EXTENSION_SKELETON_NAME;
	public  $version        = EXTENSION_SKELETON_VERSION;
	public  $description    = EXTENSION_SKELETON_DESC;
	public  $settings_exist = 'y';
	public  $docs_url       = EXTENSION_SKELETON_DOCS;

	private $__debug = FALSE;


	//------------------------------------------------------------------------------
	//!**** Magic Methods ****
	//------------------------------------------------------------------------------

	/**
	 * Constructor
	 * 
	 * @access public
	 * @param mixed  
	 * @return void
	 */
	public function __construct($settings = '')
	{
		$this->EE =& get_instance();
		$this->settings = $settings;
	}

	//------------------------------------------------------------------------------
	//!**** ExpressionEengine Extention Methods ****
	//------------------------------------------------------------------------------

	/**
	 * EE method called when the extension is activated.
	 * 
	 * @access public
	 * @return void
	 */
	public function activate_extension ()
	{
		$settings = array();
		$settings['admin_email']	= EXTENSION_SKELETON_SETTINGS_ADMIN_EMAIL;
		$settings['mail_host']		= EXTENSION_SKELETON_SETTINGS_MAIL_HOST;


		$hooks = array(
			'member_member_logout' => 'member_member_logout'
		);

		foreach ($hooks as $hook => $method)
		{
			$this->EE->db->insert('extensions',
				array(
					'extension_id'	=> '',
					'class'			=> __CLASS__,
					'method'		=> $method,
					'hook'			=> $hook,
					'settings'		=> serialize($settings),	
					'priority'		=> 10,						// Hook Priority 0-10
					'version'		=> $this->version,
					'enabled'		=> "y"
				)
			);
		}
	}

	/**
	 * EE method called when the extension is updated.
	 * 
	 * @access public
	 * @param string The current version.
	 * @return bool Returns FALSE if the version is up to date.
	 */
	public function update_extension($current = '')
	{
		if ($current == '' OR $current == $this->version)
			return FALSE;

		$this->EE->db->where('class', __CLASS__);
		$this->EE->db->update('extensions', array('version' => $this->version));
	}

	/**
	 * EE method called when the extension is disabled
	 * 
	 * @access public
	 * @return void
	 */
	public function disable_extension()
	{
		$this->EE->db->where('class', __CLASS__);
		$this->EE->db->delete('extensions');
	}

	/**
	 * Configuration for the extension settings page.
	 * 
	 * @access public
	 * @return array Returns an array of the current settings.
	 */
	public function settings()
	{
		$settings = array();
		$settings['admin_email']	= $this->admin_email;
		$settings['mail_host']		= $this->mail_host;

		return $settings;
	}

	//------------------------------------------------------------------------------
	//!	*** Hook Methods ***
	//------------------------------------------------------------------------------

	
	/**
	 * Called by the member_member_logout hook.
	 * 
	 * @access public
	 * @return void
	 */
	public function member_member_logout() 
	{
		$this->__logout();
	}
	
	//------------------------------------------------------------------------------
	//!**** Public Methods ****
	//----------------------------------------------------------------------------


	//------------------------------------------------------------------------------
	//!**** Private Methods ****
	//----------------------------------------------------------------------------


	/**
	 * Logs the currently logged in user out.
	 * 
	 * @access private
	 * @return void
	 */
	private function __logout()
	{
		return true;
	}
}
// END CLASS Extension_skeleton_ext
/* End of file ext.extension_skeleton.php */
/* Location: ./system/expressionengine/third_party/extension_skeleton/ext.extension_skeleton.php */
