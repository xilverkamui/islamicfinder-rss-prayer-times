<?php
// Include the prayer_times.php file
require('lib/prayer_times.php');

// Website URL containing prayer times
// Replace with the actual website URL
$link = 'https://www.islamicfinder.org/prayer-widget/1625822/shafi/6/0/20.0/18.0'; 
$output = 'rss';
$static = true;

// Download content from the provided URL
$html_content = file_get_contents($link);
$output = isset($_GET['output']) ? $_GET['output'] : 'rss';
$static = isset($_GET['static']) ? $_GET['static'] : true;

// Getting prayer times from the downloaded HTML script
$feedLink = htmlspecialchars( 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], ENT_QUOTES, 'UTF-8' );
$feedHome = htmlspecialchars( 'https://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']), ENT_QUOTES, 'UTF-8' );
$prayer_times = getPrayerTimes($html_content);
$city = $prayer_times['City'];
$date = $prayer_times['Date'];
$guid = $link . "?tanggal=" . str_replace(',','',str_replace(' ','',$prayer_times['Date']));;
$subuh = $prayer_times['Fajr'];
$dhuhur = $prayer_times['Dhuhr'];
$ashar = $prayer_times['Asr'];
$maghrib = $prayer_times['Maghrib'];
$isya = $prayer_times['Isha'];
$pubDate = $prayer_times['DateISO'];


// Handle output based on the 'filetype' query parameter
if ($output === 'html') {
    header('Content-Type: text/html');
    print_r($prayer_times);
} else {
    // Output as RSS
    header('Content-type: application/xml');
    if ($static) {
        header('Cache-Control: public, max-age=14400');
    }
    $content  = '
    <strong>' . $tanggal2 . '</strong><br>
    Subuh &nbsp; &nbsp;: ' . $subuh . '<br>
    Dhuhur &nbsp;: ' . $dhuhur . '<br>
    Ashar &nbsp; &nbsp; &nbsp;: ' . $ashar . '<br>
    Maghrib : ' . $maghrib . '<br>
    Isya &nbsp; &nbsp; &nbsp; &nbsp; : ' . $isya . '<br><br>
    
    Ayo sholat berjamaah !';
    
    echo '<?xml version="1.0" encoding="UTF-8"?> 
<rss version="2.0" 
    xmlns:atom="http://www.w3.org/2005/Atom"
    xmlns:content="http://purl.org/rss/1.0/modules/content/" 
    xmlns:dc="http://purl.org/dc/elements/1.1/"
    xmlns:creativeCommons="http://backend.userland.com/creativeCommonsRssModule" 
    xmlns:media="http://search.yahoo.com/mrss/"
>
<channel>
<title>Jadwal Waktu Sholat Kota ' . $city . '</title>
<atom:link href="' . $feedLink . '" rel="self" type="application/rss+xml" />
<link>' . $feedHome . '</link>
<description>Jadwal Waktu Sholat Kota ' . $city . '</description>
<language>id-ID</language>
<copyright>Copyright ' . date('Y') . '</copyright>
<creativeCommons:license>http://creativecommons.org/licenses/by-nc-sa/3.0/</creativeCommons:license>
<item>
    <title>Jadwal Waktu Sholat Kota ' . $city . '</title>
    <guid>' . $guid . '</guid>
    <pubDate>' . $pubDate . '</pubDate>
    <dc:creator>Xilver Kamui</dc:creator>
    <description><![CDATA[' . $content . ']]></description>
    <content:encoded><![CDATA[' . $content . ']]>
    </content:encoded>
    <media:content medium="image" url=""/>
</item>

</channel>
</rss>';
}
?>
