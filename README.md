# THIS PROJECT IS NOT WORKING ANYMORE. PLEASE USE https://github.com/xilverkamui/rss-prayer-times INSTEAD

# IslamicFinder RSS Prayer Times

This project is a PHP script that retrieves prayer times for a specific location from the Islamic Finder website and generates an RSS feed or HTML output based on user preferences.

## Installation

1. Clone the repository to your local machine:
   ```bash
   git clone https://github.com/xilverkamui/islamicfinder-rss-prayer-times.git
   
2. Navigate to the project directory:
   ```bash
   cd islamicfinder-rss-prayer-times

3. Place the project files in your server's web directory.

## Usage
### Generating RSS Feed
- Access directly via raw file.
   ```bash
  https://raw.githubusercontent.com/xilverkamui/islamicfinder-rss-prayer-times/main/output/jadwal-sholat-surabaya.xml
- Host on your own server.
  ```bash
  http://your-domain.com/prayer_times_surabaya.php
  OR
  http://your-domain.com/prayer_times_surabaya.php?static=true

### HTML Output
- Access the script via a web browser.
  ```bash
  http://your-domain.com/prayer_times_surabaya.php?output=html

#### Parameters:
- **static**: Set to true to generate and save a static XML file.
- **output**: Set to html for HTML output.

## External References
- [**Islamic Finder**](https://www.islamicfinder.org/) - External website used to retrieve prayer times.
- [**Simple HTML DOM**](https://sourceforge.net/projects/simplehtmldom/) - PHP library for parsing HTML.
