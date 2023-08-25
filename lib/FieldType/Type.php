<?php

declare(strict_types=1);

namespace Netgen\IbexaFieldTypeHtmlText\FieldType;

use Ibexa\Contracts\Core\FieldType\Value as SPIValue;
use Ibexa\Contracts\Core\Repository\Values\ContentType\FieldDefinition;
use Ibexa\Core\Base\Exceptions\InvalidArgumentType;
use Ibexa\Core\FieldType\FieldType;
use Ibexa\Core\FieldType\ValidationError;
use Ibexa\Core\FieldType\Value as BaseValue;

class Type extends FieldType
{
    protected $settingsSchema = [
        'textRows' => [
            'type' => 'int',
            'default' => 10,
        ],
    ];

    protected $validatorConfigurationSchema = [];

    protected function createValueFromInput($inputValue)
    {
        if (is_string($inputValue)) {
            $inputValue = new Value($inputValue);
        }

        return $inputValue;
    }

    public function getFieldTypeIdentifier()
    {
        return 'nghtmltext';
    }

    public function getName(SPIValue $value, FieldDefinition $fieldDefinition, string $languageCode): string
    {
        return (string)$value->text;
    }

    public function getEmptyValue()
    {
        return new Value();
    }

    public function isEmptyValue(SPIValue $value)
    {
        return $value->text === null || trim((string)$value->text) === '';
    }

    public function fromHash($hash)
    {
        if ($hash === null) {
            return $this->getEmptyValue();
        }

        return new Value($hash);
    }

    protected function checkValueStructure(SPIValue $value)
    {
        if (!is_string($value->text)) {
            throw new InvalidArgumentType(
                '$value->text',
                'string',
                $value->text
            );
        }
    }

    public function toHash(SPIValue $value)
    {
        if ($this->isEmptyValue($value)) {
            return null;
        }

        return $value->text;
    }

    public function isSearchable()
    {
        return true;
    }

    protected function getSortInfo(BaseValue $value)
    {
        if ($this->isEmptyValue($value)) {
            return '';
        }

        return $this->transformationProcessor->transformByGroup(
            mb_substr(strtok(trim($value->text), "\r\n"), 0, 255),
            'lowercase'
        );
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
                                "[$name]"
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
                    "[$name]"
                );
            }
        }

        return $validationErrors;
    }
}
