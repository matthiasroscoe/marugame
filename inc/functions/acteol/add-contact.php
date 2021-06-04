<?php

add_action('wp_ajax_nopriv_acteol_add_contact', 'acteol_add_contact');
add_action('wp_ajax_acteol_add_contact', 'acteol_add_contact');

function acteol_add_contact() {
    
    /**
     * Get user's details from form
     */
    $first_name = (isset($_POST['first_name']) && $_POST['first_name'] != '') ? $_POST['first_name'] : null;
    $last_name = (isset($_POST['last_name']) && $_POST['last_name'] != '') ? $_POST['last_name'] : null;
    $email = (isset($_POST['email'])) ? $_POST['email'] : null;
    $supinfo_status = (isset($_POST['supinfo_status'])) ? $_POST['supinfo_status'] : null;
    $source_id = (isset($_POST['source_id'])) ? $_POST['source_id'] : null;
    $local_business = (isset($_POST['local_business']) && $_POST['local_business'] != '') ? $_POST['local_business'] : null;
    $local_business_code = (isset($_POST['local_business_code']) && $_POST['local_business_code'] != '') ? $_POST['local_business_code'] : null;
    
    // Declare response array to pass back to JS
    $response_arr = array(
        'error' => false,
    );
    
    if ($first_name == null || $last_name == null || $email == null) {
        $response_arr['error'] = true;
        $response_arr['message'] = 'Users email or name details are not valid.';
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
         * 2. Check if user is already signed up
         */
        
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => $apiEndpoint . "/api/Contact/GetContacts?criteria=" . $email,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_HTTPHEADER => array(
                "authorization: Bearer " . $access_token,
                "cache-control: no-cache",
                "content-type: application/json",
            ),
        ));
            
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        
        if ($response != '[]') {
            $response_arr['user_data'] = json_decode($response);
            $response_arr['message'] = 'User already exists';
            echo json_encode($response_arr);
            wp_die();
        }

        /**
         * 3. If user is not signed up, add as a new contact
         */

        $content = array(
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
                'FieldContent' => $local_business,
            );
        }
        if ($local_business_code) {
            $content['SupInfo'][] = array(
                'FieldName' => 'localbusinesscode',
                'FieldContent' => $local_business_code,
            );
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $apiEndpoint . "/api/Contact/PostContact",
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
        
        // Get the Customer ID that has been assigned by Acteol
        $response = json_decode($response);
        $ctc_id = $response->{'CtcID'};
        $response_arr['CtcID'] = $ctc_id;
        

        /**
         * 4. Set the user's preferences as opted-in to emails
         */
        $content = array(
            'CustomerID' => $ctc_id,
            'EmailOptin' => true,
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
        $response_arr['step_4'] = json_decode($response);


        /**
         * 5. Create a Member Number for the user. They will use this number to log in to the loyalty page.
         */

        // REMOVED AS NO LONGER NEEDED.
        // MEMBER # IS BEING ADDED BY THE ACTEOL GUYS
        
        // $curl = curl_init();
        
        // curl_setopt_array($curl, array(
        //     CURLOPT_URL => $apiEndpoint . "/api/Contact/AddMemberNumber?CtcID=" . $ctc_id,
        //     CURLOPT_RETURNTRANSFER => true,
        //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //     CURLOPT_HTTPHEADER => array(
        //         "authorization: Bearer " . $access_token,
        //         "cache-control: no-cache",
        //         "content-type: application/json",
        //     ),
        // ));
            
        // $response = curl_exec($curl);
        // $err = curl_error($curl);
        // curl_close($curl);
        
    } else {
        $response_arr['error'] = true;
        $response_arr['message'] = 'API authorization failed';
    }
    
    echo json_encode($response_arr);
    wp_die();
}

?>