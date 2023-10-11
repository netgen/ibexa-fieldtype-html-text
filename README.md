# ibexa-fieldtype-html-text

[![Downloads](https://img.shields.io/packagist/dt/netgen/ibexa-fieldtype-html-text.svg)](https://packagist.org/packages/netgen/ibexa-fieldtype-html-text)
[![Latest stable](https://img.shields.io/packagist/v/netgen/ibexa-fieldtype-html-text.svg)](https://packagist.org/packages/netgen/ibexa-fieldtype-html-text)
[![PHP](https://img.shields.io/badge/PHP-%E2%89%A5%208.1-%238892BF.svg)](https://www.php.net)
[![Ibexa](https://img.shields.io/badge/Ibexa-%E2%89%A5%204.0-orange.svg)](https://www.ibexa.co)

Html text field type for Ibexa CMS offers the possibility to render WYSIWYG field both on the frontend and in Ibexa administration.
 
Installation steps
-----------
### Use Composer
Run composer require:
```
composer require netgen/ibexa-fieldtype-html-text
```

### Activate the bundle
Activate the bundle in `config/bundles.php` file.

```php
<?php

return [
    ...,

    Netgen\IbexaFieldTypeHtmlTextBundle\NetgenIbexaFieldTypeHtmlTextBundle::class => ['all' => true],,

    ...
];
```

### Include the javascript file on the frontend
Inside the base twig file for your frontend siteaccess, include the built `app.js` file:
```
<script src="{{ asset('bundles/netgenibexafieldtypehtmltext/build/app.js') }}"></script>
```

