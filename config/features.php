<?php
/*
 * This config file is for determining which features are enabled/disabled
 * in an easy, cachable way
 *
 * Keys of the array should be the names of your features and the value should be
 * true/false depending on whether the feature is enabled. My convention is to set
 * a FEATURE_* .env variable to 'on' or 'off.'
 */
return [
    'something' => (env('FEATURE_SOMETHING', 'on') == 'on'),
    'something_else' => (env('SOME_OTHER_FEATURE', 'on') == 'on'),
    'one_more' => false,
];
