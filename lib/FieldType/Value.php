<?php

declare(strict_types=1);

namespace Netgen\IbexaFieldTypeHtmlText\FieldType;

use Ibexa\Core\FieldType\Value as BaseValue;

class Value extends BaseValue
{
    /**
     * Text content.
     *
     * @var string
     */
    public $text;

    /**
     * Construct a new Value object and initialize it $text.
     *
     * @param string $text
     */
    public function __construct($text = '')
    {
        $this->text = $text;
    }

    public function __toString()
    {
        return $this->text;
    }
}
