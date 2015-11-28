<?php
require('./inc/script_start.inc.php');

if (isset($_POST['usr_cust_save'])) {

    $old_settings = $s_cust;

    $s_cust['language'] = get_request_data('usr_cust_language');
    $s_cust['askdel'] = get_request_data('usr_cust_askdel') == $usr_strings['Yes'] ? 1 : 0;

    $settings_changed = true;
}

// reset the customizing values to the configuration defaults
if (isset($_POST['usr_cust_defaults'])) {

    $old_settings = $s_cust;
    $s_cust = get_customize_defaults($s_useragent);

    $settings_changed = true;
}

if ($settings_changed = true && isset($old_settings)) {

    if ($old_settings['language'] != $s_cust['language']) {

        include('./lang/' . $s_cust['language'] . '.inc.php');
        fix_language($s_cust['language']);
    }

    set_customize_cookie($s_cust);

    // force reloading of the stylesheet
    $s_stylesheet_etag = '';
}

header("Location: " . $_SERVER["HTTP_REFERER"]);

require('./inc/script_end.inc.php');

?>