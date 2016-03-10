<?php

// No direct access
defined('IN_GS') or die('Cannot load plugin directly.');

$thisfile = basename(__FILE__, ".php");

// Register the plugin
register_plugin(
    $thisfile,
    'Password Protect',
    '1.0.0',
    'Helge Sverre',
    'https://helgesverre.com/',
    'Allows users to password protect pages in their GetSimple powered site.',
    'plugins',
    'password_protect'
);


// Run this hook everywhere before anything else is loaded in.
add_action('common', 'password_protect');


/**
 * Initializes the plugin, merges language files
 */
function password_protect_init()
{
    // Merge together the language files
    i18n_merge('password_protect') || i18n_merge('password_protect', "en_US");
}


/**
 * Main routine, it essentially just does a check if your referrer is
 * in the list of spammy referrers, it ignores you ig you are whitelisted.
 */
function password_protect()
{
    // Initialize language files
    password_protect_init();


}