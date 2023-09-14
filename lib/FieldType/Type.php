<?php

declare(strict_types=1);

namespace Netgen\IbexaFieldTypeHtmlText\FieldType;

use Ibexa\Contracts\Core\FieldType\Value as SPIValue;
use Ibexa\Contracts\Core\Repository\Values\ContentType\FieldDefinition;
use Ibexa\Core\Base\Exceptions\InvalidArgumentType;
use Ibexa\Core\FieldType\FieldType;
use Ibexa\Core\FieldType\ValidationError;
use Ibexa\Core\FieldType\Value as BaseValue;
use Netgen\IbexaFieldTypeHtmlText\Utils\HtmlPurifier;

use function is_int;
use function is_string;
use function mb_substr;
use function strtok;
use function trim;

class Type extends FieldType
{
    protected $settingsSchema = [
        'textRows' => [
            'type' => 'int',
            'default' => 10,
        ],
    ];

    protected $validatorConfigurationSchema = [];
    private HtmlPurifier $htmlPurifier;

    public function __construct(HtmlPurifier $htmlPurifier)
    {
        $this->htmlPurifier = $htmlPurifier;
    }

    public function getFieldTypeIdentifier()
    {
        return 'nghtmltext';
    }

    public function getName(SPIValue $value, FieldDefinition $fieldDefinition, string $languageCode): string
    {
        return (string) $value->text;
    }

    public function getEmptyValue()
    {
        return new Value();
    }

    public function isEmptyValue(SPIValue $value)
    {
        return $value->text === null || trim((string) $value->text) === '';
    }

    public function fromHash($hash)
    {
        if ($hash === null) {
            return $this->getEmptyValue();
        }

        return new Value($hash);
    }

    public function toHash(SPIValue $value)
    {
        if ($this->isEmptyValue($value)) {
            return null;
        }

        return $this->htmlPurifier->purify($value->text);
    }

    public function isSearchable()
    {
        return true;
    }

    public function validateFieldSettings($fieldSettings)
    {
        $validationErrors = [];

        foreach ($fieldSettings as $name => $value) {
            if (isset($this->settingsSchema[$name])) {
                switch ($name) {
                    case 'textRows':
                        if (!is_int($value)) {
                            $validationErrors[] = new ValidationError(
                                "Setting '%setting%' value must be of integer type",
                                null,
                                [
                                    '%setting%' => $name,
                                ],
                                "[{$name}]",
                            );
                        }

                        break;
                }
            } else {
                $validationErrors[] = new ValidationError(
                    "Setting '%setting%' is unknown",
                    null,
                    [
                        '%setting%' => $name,
                    ],
                    "[{$name}]",
                );
            }
        }

        return $validationErrors;
    }

    protected function createValueFromInput($inputValue)
    {
        if (is_string($inputValue)) {
            $inputValue = new Value($inputValue);
        }

        return $inputValue;
    }

    protected function checkValueStructure(SPIValue $value)
    {
        if (!is_string($value->text)) {
            throw new InvalidArgumentType(
                '$value->text',
                'string',
                $value->text,
            );
        }
    }

    protected function getSortInfo(BaseValue $value)
    {
        if ($this->isEmptyValue($value)) {
            return '';
        }

        return $this->transformationProcessor->transformByGroup(
            mb_substr(strtok(trim($value->text), "\r\n"), 0, 255),
            'lowercase',
        );
    }
}
