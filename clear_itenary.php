<?php 

$xmlRequest='<itinerary xmlns="http://www.cleartrip.com/air/">
    <cabin-type>E</cabin-type>
    <flights>
        <flight-spec>
         <fare-key>supp_AMADEUS|si-api-f613c4b5-94ea-4126-9a4c-d9d5f27602d6|fk_retail_9W-K_2736_1409503500000_B2A90JK_true__fpr_2702</fare-key>
            <segments>
                <segment-spec>
                    <departure-airport>BLR</departure-airport>
                    <arrival-airport>MAA</arrival-airport>
                    <flight-number>2736</flight-number>
                    <airline>9W-K</airline>
                    <operating-airline>9W-K</operating-airline>
                    <departure-date>2014-08-31</departure-date>
                </segment-spec>
            </segments>
        </flight-spec>
    </flights>
    <pax-info-list>
        <pax-info>
            <title>Mr</title>
            <first-name>Sharath</first-name>
            <last-name>Nath</last-name>
            <type>ADT</type>
        </pax-info>
     </pax-info-list>
    <contact-detail>
        <title>Mr</title>
        <first-name>Sharath</first-name>
        <last-name>Nath</last-name>
        <email>sharathnath87@gmail.com</email>
        <address>test,test</address>
        <mobile>919739660088</mobile>
        <landline>12345678910</landline>
        <city-name>Bangalore</city-name>
        <state-name>Karnataka</state-name>
        <country-name>India</country-name>
        <pin-code>560024</pin-code>
    </contact-detail>
</itinerary>';
                 //echo "<pre>";print_r($siv);exit;
                
            $authkey='5caebd280ccdf3463b025eca00fa5e78';
           
            
            $url = 'http://api.staging.cleartrip.com/air/1.0/itinerary/create?xmlRequest='.$xmlRequest;
	$ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-CT-API-KEY: 5caebd280ccdf3463b025eca00fa5e78','X-CT-SOURCETYPE:API'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlRequest);
$data = curl_exec($ch); 

if(curl_errno($ch))
print curl_error($ch);
else
curl_close($ch);
echo "<pre>";print_r(htmlspecialchars($data));
?>
