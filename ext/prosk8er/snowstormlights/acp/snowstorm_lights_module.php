<?php
/**
*
* Snowstorm & Lights extension for the phpBB Forum Software package.
*
* @copyright (c) 2014 Prosk8er <http://www.gotskillslounge.com>
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace prosk8er\snowstormlights\acp;

class snowstorm_light_module
{
	var $u_action;

	function main($id, $mode)
	{
		global $db, $user, $auth, $template, $cache, $request;
		global $config, $phpbb_root_path, $phpbb_admin_path, $phpEx;

		// Add the common lang file
		$this->user->add_lang(array('acp/common'));

		// Add the board snowstormlights ACP lang file
		$this->user->add_lang_ext('prosk8er/snowstormlights', 'info_acp_snowstorm_lights');

		// Load a template from adm/style for our ACP page
		$this->tpl_name = 'snowstorm_lights';

		// Set the page title for our ACP page
		$this->page_title = $user->lang['CHRISTMAS_LIGHTS_MOD'];

		// Define the name of the form for use as a form key
		$form_name = 'acp_snowstorm_lights';
		add_form_key($form_name);

		// If form is submitted or previewed
		if ($this->request->is_set_post('submit'))
		{
			// Test if form key is valid
			if (!check_form_key($form_name))
			{
				trigger_error('FORM_INVALID');
			}

			// Store the config enable/disable state
			$config->set('scl_enabled', $request->variable('scl_enabled', 0));
			$config->set('snow_enabled', $request->variable('snow_enabled', 0));

			// Output message to user for the update
			trigger_error($this->user->lang('SNOWSTORM_LIGHTS_SAVED') . adm_back_link($this->u_action));
		}

		// Output data to the template
		$this->template->assign_vars(array(
			'SCL_ENABLED'		=> $this->config['scl_enabled'],
			'SNOW_ENABLED'		=> $this->config['snow_enabled'],
			'U_ACTION'		=> $this->u_action,
		));
	}
}