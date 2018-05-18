<?php
/**
 * Plugin: Block Banned Profiles
 * Description: Blocks users access to the profiles of banned users.
 * File: bbp.php
 * Author:  Brian. ( https://community.mybb.com/user-115119.html )
 * Version 1.1
**/

if (!defined('IN_MYBB')) 
{
	die('Direct initialization of this file is not allowed.<br /><br />Please make sure IN_MYBB is defined.');
}

$plugins->add_hook('member_profile_start', 'bbp_run');

function bbp_info()
{
	return array(
		'name'          =>  'Block Banned Profiles',
		'description'   =>  'Blocks users access to the profiles of banned users.',
		'website'       =>  'https://community.mybb.com/user-115119.html',
		'author'        =>  'Brian.',
		'authorsite'    =>  'https://community.mybb.com/user-115119.html',
		'version'       =>  '1.1',
		'compatibility' =>  '18*',
	);
}

function bbp_run() {
	global $db, $mybb, $lang;
		$query = $db->simple_select("users", "*", "uid='" . $mybb->input['uid'] . "'");
		$bbp = $db->fetch_array($query);
		$query = $db->simple_select("banned", "reason", "uid='" . $mybb->input['uid'] . "'");
		$reason = $db->fetch_array($query);
	if($bbp['usergroup'] == '7') // Change this if you are not using the default banned group.
	{
		$lang->load('bbp');
		error($lang->sprintf($lang->bbp_statement, $bbp['username'], $reason['reason']));
	}
}

?>
