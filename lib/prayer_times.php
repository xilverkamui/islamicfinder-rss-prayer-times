<?php
// Include PHP Simple HTML DOM Parser library
include('lib/simple_html_dom.php');

/**
 * Function to get prayer times from HTML script
 *
 * @param string $html_content The HTML script containing prayer times
 * @return array An array containing prayer times, city name, and date
 */
function getPrayerTimes($html_content) {
    $prayer_times = array(); // Initialize an array to store prayer times

    // Create HTML object
    $html = str_get_html($html_content);

    // Extract city name
    $city_element = $html->find('a.inline-link', 0);
    $city = $city_element ? $city_element->plaintext : 'Unknown';
    $prayer_times['City'] = $city;

    // Extract date
    $date_element = $html->find('.text-center p', 0);
    $dateOriginal = $date_element ? $date_element->plaintext : 'Unknown';
    $date = DateTime::createFromFormat('l, M d, Y', $dateOriginal);
    //$date->setTimezone(new DateTimeZone('Asia/Jakarta'));
    $prayer_times['Date'] = $date->format('Y-m-d');
    //$prayer_times['DateISO'] = $date->format('D, d M Y 00:00:00 O');
    $prayer_times['DateISO'] = $date->format('D, d M Y 00:00:00 +0700');
    $prayer_times['DateOriginal'] = $dateOriginal;
    $prayer_times['DateHost'] = date('Y-m-d H:i:s');

    // Extract prayer times
    $times_elements = $html->find('.d-flex.flex-direction-row.flex-justify-sb.pad-top-sm.pad-left-sm.pad-right-sm');
    foreach ($times_elements as $time_element) {
        $prayer_name = $time_element->find('p', 0)->plaintext;
        $prayer_time = $time_element->find('p', 2)->plaintext;

        // Removing extra spaces and adding to the array
        $prayer_times[trim($prayer_name)] = trim($prayer_time);
    }
    
    return $prayer_times;
}
?>
