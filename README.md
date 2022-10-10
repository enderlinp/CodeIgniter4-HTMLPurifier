# CodeIgniter4 HTML Purifier Helper
Ported from Tyler Brownell's [Codeigniter HTML Purifier Helper](https://www.github.com/refringe/CodeIgniter-HTMLPurifier).

Purify input using the HTML Purifier standalone class.  
Easily use multiple HTML Purifier configurations.

## Installation
Copy `htmlpurifier_helper.php` to your CodeIgniter4 `app/Helpers` folder.

### Requirements
- [Composer](https://getcomposer.org)
- [HTML Purifier](http://htmlpurifier.org/download)

Install [HTML Purifier](http://htmlpurifier.org/download) standalone class with composer, like so:
```console
> composer require ezyang/htmlpurifier
```

## Usage
Create and customize HTML Purifier configurations by opening the helper (`htmlpurifier_helper.php`) and editing/adding case statements as needed. There's a default configuration named "comment" that should be sufficient for basic web comments with HTML allowed, but be sure to check it and make sure it meets your standards. View the [HTML Purifier Configuration Documentation](http://htmlpurifier.org/live/configdoc/plain.html) for more information.

Use the following code to purify using the default configuration:  

```php
<?php
helper('html_purifier');

$clean_html = html_purify($dirty_html);
```

Where `$dirty_html` is a string, or an array of strings.

To use a custom configuration, pass the name of the configuration in the second parameter: 

```php
<?php
$clean_html = html_purify($dirty_html, 'comment');
```