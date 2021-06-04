<?php

add_action('wp_ajax_nopriv_acteol_update_contact', 'acteol_update_contact');
add_action('wp_ajax_acteol_update_contact', 'acteol_update_contact');

function acteol_update_contact() {

    /**
     * Get user's details from form
     */
    $first_name = (isset($_POST['first_name']) && $_POST['first_name'] != '') ? $_POST['first_name'] : null;
    $last_name = (isset($_POST['last_name']) && $_POST['last_name'] != '') ? $_POST['last_name'] : null;
    $mobile = (isset($_POST['mobile']) && $_POST['mobile'] != '') ? $_POST['mobile'] : null;
    $dob = (isset($_POST['dob']) && $_POST['dob'] != '') ? $_POST['dob'] : null;
    $email = (isset($_POST['email'])) ? $_POST['email'] : null;
    $postcode = (isset($_POST['postcode']) && $_POST['postcode'] != '') ? $_POST['postcode'] : null;
    $ctc_id = (isset($_POST['ctcID']) && $_POST['ctcID'] != '') ? $_POST['ctcID'] : null;
    $supinfo_status = (isset($_POST['supinfo_status']) && $_POST['supinfo_status'] != '') ? $_POST['supinfo_status'] : null;
    $source_id = (isset($_POST['source_id']) && $_POST['source_id'] != '') ? $_POST['source_id'] : null;
    $local_business = (isset($_POST['local_business']) && $_POST['local_business'] != '') ? $_POST['local_business'] : null;
    $local_business_code = (isset($_POST['local_business_code']) && $_POST['local_business_code'] != '') ? $_POST['local_business_code'] : null;
    $sms_optin = (isset($_POST['smsOptin']) && $_POST['smsOptin'] != '') ? $_POST['smsOptin'] : null;

    // Declare response array to pass back to JS
    $response_arr = array(
        'error' => false,
    );

    if ($ctc_id == null || $email == null) {
        $response_arr['error'] = true;
        $response_arr['message'] = 'CTC ID or email missing';
        echo json_encode($response_arr);
        wp_die();
    }

    /**
     * Atreemo API details
     */
    $apiEndpoint = 'https://atreemo.mail.marugame.co.uk/';
    $user = 'olivia@ignitecreates.com';
    $pass = '1Gnite0livia2021!';

    
    /**
     * 1. Authorization
     */
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $apiEndpoint . "/token",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "grant_type=password&username=" . $user . "&password=" . $pass,
        CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache",
            "content-type: application/x-www-form-urlencoded",
        ),
    ));

    $auth = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);

    // Retrieve the access token
    $auth = json_decode($auth);
    $access_token = $auth->{'access_token'};

    if ($access_token) {
        /**
         * 2. Update account with new details.
         */

        $content = array(
            'CtcID' => $ctc_id,
            'FirstName' => $first_name,
            'LastName' => $last_name,
            'Email' => $email,
            'SourceID' => $source_id,
            'SupInfo' => array(
                array(
                    'FieldName' => 'status',
                    'FieldContent' => $supinfo_status,
                ),
            )
        );

        if ($local_business) {
            $content['SupInfo'][] = array(
                'FieldName' => 'localbusiness',
                'FieldContent' => $local_business
            );
        }
        
        if ($local_business_code) {
            $content['SupInfo'][] = array(
                'FieldName' => 'localbusinesscode',
                'FieldContent' => $local_business_code
            );
        }

        if ($mobile) {
            $content['MobilPhone'] = $mobile;
        }
        if ($dob) {
            $content['BirthDate'] = $dob . 'T12:00:00+00:00';
        }
        if ($postcode) {
            $content['Company']['PostCode'] = $postcode;
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $apiEndpoint . "/api/Contact/PutContact",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "PUT",
            CURLOPT_POSTFIELDS => json_encode($content),
            CURLOPT_HTTPHEADER => array(
                "authorization: Bearer " . $access_token,
                "cache-control: no-cache",
                "content-type: application/json",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        

        /**
         * 3. Set the user's preferences as opted-in to SMS
         */

        $content = array(
            'CustomerID' => $ctc_id,
            'SmsOptin' => $sms_optin,
        );
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $apiEndpoint . "/api/CommunicationPreference/Post",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($content),
            CURLOPT_HTTPHEADER => array(
                "authorization: Bearer " . $access_token,
                "cache-control: no-cache",
                "content-type: application/json",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        
    } else {
        $response_arr['error'] = true;
        $response_arr['message'] = 'API authorization failed';
    }

    echo json_encode($response_arr);
    wp_die();
}

?>