<?php

namespace Netgen\IbexaFieldTypeHtmlText\Utils;

use HTMLPurifier as BaseHTMLPurifier;
use HTMLPurifier_Config;
use HTMLPurifier_HTML5Config;

final class HtmlPurifier
{
    private BaseHTMLPurifier $purifier;

    public function __construct(?HTMLPurifier_Config $config = null)
    {
        if ($config === null) {
            $config = HTMLPurifier_HTML5Config::create(['Cache.DefinitionImpl' => null]);
            $config->set('Attr.AllowedFrameTargets', ['_blank']);
        }

        $this->purifier = new BaseHTMLPurifier($config);
    }

    public function purify(string $value): string
    {
        return $this->purifier->purify($value);
    }
}