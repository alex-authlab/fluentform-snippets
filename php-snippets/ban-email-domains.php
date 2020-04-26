<?php

/*
 * This snippet will for your email fields where it will ban certain domains
 * Please check both available snippet and use which is applicable for you.
 * Don't forget to change the values where it mentioned
 */

/*
 * Snippet: 1
 * This will apply for all the forms in your site
 */
add_filter('fluentform_validate_input_item_input_email', function ($error, $field, $formData, $fields, $form) {
    /*
     * add your not accepted domains here
     * The mentioned domains will be failed to submit the form
     */
    $invalidDomains = ['gmail.com', 'hotmail.com', 'test.com']; // You may change here
    $errorMessage = 'The provided email domain is not accepted'; // You may change here

    $fieldName = $field['name'];
    $value = (isset($formData[$fieldName]));
    if (!$value) {
        return $error;
    }

    $inputDomain = array_pop(explode('@', $value));

    if (in_array($inputDomain, $invalidDomains)) {
        return $errorMessage;
    }

    return $error;

}, 10, 5);

/*
 * Snippet: 2
 * This will apply for only form id: 12
 */
add_filter('fluentform_validate_input_item_input_email', function ($error, $field, $formData, $fields, $form) {
    /*
     * add your not accepted domains here
     * The mentioned domains will be failed to submit the form
     */
    // You may change the following 3 lines
    $targetFormId = 12;
    $invalidDomains = ['gmail.com', 'hotmail.com', 'test.com']; // You may change here
    $errorMessage = 'The provided email domain is not accepted';

    if ($form->id != $targetFormId) {
        return $error;
    }

    $fieldName = $field['name'];
    $value = (isset($formData[$fieldName]));
    if (!$value) {
        return $error;
    }

    $inputDomain = array_pop(explode('@', $value));

    if (in_array($inputDomain, $invalidDomains)) {
        return $errorMessage;
    }
    return $error;

}, 10, 5);

