<?php // echo "<pre>"; print_r($_POST); die; ?>
<?php
session_start();

function curl($url, $postData){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

    $headers = array();
    $headers[] = 'Content-Type: application/x-www-form-urlencoded';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);

    //Create XML object
    $xmlObject = new SimpleXMLElement($result);
    //Create JSON Object
    $jsonObject = json_encode($xmlObject);
    //Convert JSON object into an associative array
    $result_array = json_decode($jsonObject, true);
    return $result_array;
    // echo "<pre>"; print_r($result_array); die;   
}

$userid = '1A1PCPPP57089';
$password = 'X9328IM76U8604Z';

// running address validation api
$validation_url =   'https://secure.shippingapis.com/ShippingAPI.dll';
$validation_xml =   '<AddressValidateRequest USERID="'.$userid.'">
                        <Revision>1</Revision>
                        <Address ID="0">
                            <Address1>'.$_POST['address_1'].'</Address1>
                            <Address2>'.$_POST['address_2'].'</Address2>
                            <City>'.$_POST['city'].'</City>
                            <State>'.$_POST['state'].'</State>
                            <Zip5>'.$_POST['zip_5'].'</Zip5>
                            <Zip4>'.$_POST['zip_4'].'</Zip4>
                        </Address>
                    </AddressValidateRequest>';
$validation_data = [
    'API'=>'Verify',
    'XML'=>$validation_xml
];
$validation_response = curl($validation_url,http_build_query($validation_data));
// echo "<pre>"; print_r($validation_response); die;
if(!isset($validation_response['Address']['ReturnText'])){
    // echo "<pre>"; print_r($validation_response); die;
    $zipDestination = (isset($_POST['zip_5']) && !empty($_POST['zip_5'])) ? $_POST['zip_5'] : $_POST['zip_4'];
    $rate_url = 'https://secure.shippingapis.com/ShippingAPI.dll';
    $rate_xml = '<RateV4Request USERID="'.$userid.'" PASSWORD="'.$password.'">
                    <Revision>2</Revision>
                    <Package ID="0">
                        <Service>PRIORITY</Service>
                        <ZipOrigination>22201</ZipOrigination>
                        <ZipDestination>'.$zipDestination.'</ZipDestination>
                        <Pounds>'.$_POST['pounds'].'</Pounds>
                        <Ounces>'.$_POST['ounces'].'</Ounces>
                        <Container></Container>
                        <Width>'.$_POST['width'].'</Width>
                        <Length>'.$_POST['length'].'</Length>
                        <Height>'.$_POST['height'].'</Height>
                        <Girth>'.$_POST['girth'].'</Girth>
                        <Machinable>TRUE</Machinable>
                    </Package>
                </RateV4Request>';
    $rate_data = [
        'API'=>'RateV4',
        'XML'=>$rate_xml
    ];
    
    $rate_response = curl($rate_url,http_build_query($rate_data));

    if(!isset($rate_response['Package']['Error'])){
        $rate = $rate_response['Package']['Postage']['Rate'];

        $schedule_url = 'https://secure.shippingapis.com/ShippingAPI.dll';
        $schedule_xml = '<CarrierPickupScheduleRequest USERID="'.$userid.'">
                            <FirstName>'.$_POST['first_name'].'</FirstName>
                            <LastName>'.$_POST['last_name'].'</LastName>
                            <FirmName>ABC Corp.</FirmName>
                            <SuiteOrApt>'.$_POST['address_1'].'</SuiteOrApt>
                            <Address2>'.$_POST['address_2'].'</Address2>
                            <Urbanization></Urbanization>
                            <City>'.$_POST['city'].'</City>
                            <State>'.$_POST['state'].'</State>
                            <ZIP5>'.$_POST['zip_5'].'</ZIP5>
                            <ZIP4>'.$_POST['zip_4'].'</ZIP4>
                            <Phone>'.$_POST['phone'].'</Phone>
                            <Extension>201</Extension>
                            <Package>
                                <ServiceType>PriorityMailExpress</ServiceType>
                                <Count>1</Count>
                            </Package>
                            <EstimatedWeight>'.$_POST['pounds'].'</EstimatedWeight>
                            <PackageLocation>Front Door</PackageLocation>
                            <SpecialInstructions>Packages are behind the screen door.</SpecialInstructions>
                        </CarrierPickupScheduleRequest>';
        $schedule_data = [
            'API'=>'CarrierPickupSchedule',
            'XML'=>$schedule_xml
        ];
        
        $schedule_response = curl($schedule_url,http_build_query($schedule_data));

        echo "Price: ".$rate."<br>";
        echo "Service Type: ". $schedule_response['Package']['ServiceType']."<br>";

        // echo "<pre>"; print_r($schedule_response); die;
    }else{
        echo 'Error: '.$rate_response['Package']['Error']['Description'];
    }

}else{ 
    echo 'Error: '.$validation_response['Address']['ReturnText'];
}

?>