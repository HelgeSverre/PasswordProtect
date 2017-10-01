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


// Run after dataindex is assigned
add_action('index-post-dataindex', "password_protect");

// Run when inside the page extra fields
add_action('edit-extras', "password_protect_page_edit");

// Run when page is saved
add_action('changedata-save', "password_protect_page_save");

/**
 * Initializes the plugin, merges language files
 */
function password_protect_init()
{
    // Merge together the language files
    i18n_merge('password_protect') || i18n_merge('password_protect', "en_US");
}


/**
 * Main routine, it checks if the current page has a password associated with it,
 * and replaces the content with a login form if it does.
 */
function password_protect()
{
    // Initialize language files
    password_protect_init();

    // Globals, no way around them, sorry.
    global $data_index, $content, $title;

    $password = $data_index->password;

    $temp_title = i18n("password_protect/PASSWORD_TITLE", false);

    $html = array();
    $html[] = '<form method="post">';
    $html[] = '<label for="password">' . i18n("password_protect/ENTER_PASSWORD", false) . '</label>';
    $html[] = '<input type="password" name="password" id="password" placeholder="' . i18n("password_protect/PASSWORD_PLACEHOLDER", false) . '">';
    $html[] = '<input type="submit" value="' . i18n("password_protect/SUBMIT_BUTTON", false) . '">';
    $html[] = '</form>';

    // Replace the content with the password form
    $temp_content = implode("\n", $html);

    // If there password is not blank
    if (trim($password) !== "") {

        if (!isset($_POST["password"])) {

            $title = $temp_title;
            $content = $temp_content;
        } else {

            if ($password != $_POST["password"]) {
                $title = $temp_title;
                $content = $temp_content . i18n("password_protect/WRONG_PASSWORD", false);
            }
        }
    }
}

/**
 * Hook into edit page, adds form for password field.
 */
function password_protect_page_edit()
{
    global $data_edit;

    // Initialize language files
    password_protect_init();
    ?>

    <div class="leftopt">
        <p>
            <label for="post-password"><?= i18n('password_protect/PASSWORD_PROTECT'); ?></label>
            <input class="text short"
                   type="text"
                   id="post-password"
                   name="post-password"
                   value="<?= stripslashes($data_edit->password); ?>"
                   autocomplete="off"
            >
        </p>
    </div>
    <div class="clear"></div>
    <?php
}


/**
 * Hook into the page save routine, checks if a password was set and save it in the XML file.
 */
function password_protect_page_save()
{
    global $xml;

    // Check if password is set
    if (isset($_POST["post-password"])) {

        $password = $_POST["post-password"];

        // Check if the password is not blank
        if (trim($password) != "") {
            // Add password to page xml file
            $note = $xml->addChild('password');
            $note->addCData($password);
        }
    }
}
