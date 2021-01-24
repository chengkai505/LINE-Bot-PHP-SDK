# LINE-Bot-PHP-SDK
LINE Message API

## Getting started

1. Include main.php
2. Fill channel secret and channel access token in Config.php
3. Use `\LINE\IO_Center\auth()` to automatically verify connections
4. Use `\LINE\IO_Center\getEvents()` to get the events sent from LINE official server

## Create messages

Now available:

- Text: `\LINE\Messages\Text('<content>')`
- Image: `\LINE\Messages\Image('<original image url>', '<preview image url>')`. Second parameter is optional
- Flex: `\LINE\Messages\Flex('<alt text>')`
