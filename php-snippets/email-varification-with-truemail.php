<?php

/*
 * This snippet will for your email fields where You can verify the provided email
 * using truemail api
 */

/*
 * Snippet: 1
 * This will apply for all the forms in your site
 */

add_filter('fluentform_validate_input_item_input_email', function ($default, $field, $formData, $fields, $form) {

    $errorMessage = 'Looks like email is not correct'; // You may change here
    $trueMailApiKey = 'INSERT_YOUR_TRUEMAIL.IO_API_KEY';

    $fieldName = $field['name'];
    if (empty($formData[$fieldName])) {
        return $default;
    }
    $email = $formData[$fieldName];


    $request = wp_remote_get('https://truemail.io/api/v1/verify/single?address_info=1&timeout=5&access_token='.$trueMailApiKey.'&email='.$email);

    if(is_wp_error($request)) {
        return $default; // request failed so we are skipping validation
    }

    $response = wp_remote_retrieve_body($request);

    $response = json_decode($response, true);

    if($response['result'] == 'valid') {
        return $default;
    }

    return $errorMessage;

}, 10, 5);




/*
 * Snippet: 2
 * This will apply for only form id: 12
 */
add_filter('fluentform_validate_input_item_input_email', function ($default, $field, $formData, $fields, $form) {

    // You may change the following 3 lines
    $targetFormId = 12;
    $errorMessage = 'Looks like email is not correct'; // You may change here
    $trueMailApiKey = 'INSERT_YOUR_TRUEMAIL.IO_API_KEY';

    if ($form->id != $targetFormId) {
        return $default;
    }

    $fieldName = $field['name'];
    if (empty($formData[$fieldName])) {
        return $default;
    }
    $email = $formData[$fieldName];


    $request = wp_remote_get('https://truemail.io/api/v1/verify/single?address_info=1&timeout=5&access_token='.$trueMailApiKey.'&email='.$email);

    if(is_wp_error($request)) {
        return $default; // request failed so we are skipping validation
    }

    $response = wp_remote_retrieve_body($request);

    $response = json_decode($response, true);

    if($response['result'] == 'valid') {
        return $default;
    }

    return $errorMessage;

}, 10, 5);

