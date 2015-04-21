<?php
date_default_timezone_set('America/New_York');
echo date('Ymd-h-m');echo '<br>';

$country = geoip_country_code_by_name('68.205.238.243');
if ($country) {
    echo 'This host is located in: ' . $country;
}


//print geoip_database_info(GEOIP_CITY_EDITION);

$region = geoip_record_by_name('115.109.178.168');
echo '<pre>';
if ($region) {
    print_r($region);
}
print_r(@geoip_record_by_name('qs2340.pair.com'));
?>
