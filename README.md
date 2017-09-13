# wapuu-led
Select Wapuu image with WP-API

## Setup at WordPress site
1. Create a page and put the content as select-wapuu.html.
1. Install wapuu-api.php into wp-content/plugins of your site.
1. Replace '60' of the wapuu-api.php plugins into the post_id of the page.

## Setup at Raspberry Pi
1. Write Raspbian Lite image into a micro SD card.
1. Initial config by raspi-config (Locale, Timezone, Keyboard, SSH, etc).
1. Clone http://github.com/hzeller/rpi-rgb-led-matrix/
1. Make demo and led-image-viewer.
1. Put Wapuu images at ~/wapuu directory. Filenames must be "0nn-XXXXX.png".
1. Run show-wapuu.py python script.
