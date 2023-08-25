<?php

declare(strict_types=1);

namespace Netgen\IbexaFieldTypeHtmlText\Persistence\Legacy;

use Ibexa\Contracts\Core\Persistence\Content\FieldValue;
use Ibexa\Contracts\Core\Persistence\Content\Type\FieldDefinition;
use Ibexa\Core\FieldType\FieldSettings;
use Ibexa\Core\Persistence\Legacy\Content\FieldValue\Converter;
use Ibexa\Core\Persistence\Legacy\Content\StorageFieldDefinition;
use Ibexa\Core\Persistence\Legacy\Content\StorageFieldValue;

class FieldValueConverter implements Converter
{
    public function toStorageValue(FieldValue $value, StorageFieldValue $storageFieldValue): void
    {
        $storageFieldValue->dataText = $value->data;
        $storageFieldValue->sortKeyString = $value->sortKey;
    }

    public function toFieldValue(StorageFieldValue $value, FieldValue $fieldValue): void
    {
        $fieldValue->data = $value->dataText;
        $fieldValue->sortKey = $value->sortKeyString;
    }

    public function toStorageFieldDefinition(FieldDefinition $fieldDef, StorageFieldDefinition $storageDef): void
    {
        if (isset($fieldDef->fieldTypeConstraints->fieldSettings['textRows'])) {
            $storageDef->dataInt1 = $fieldDef->fieldTypeConstraints->fieldSettings['textRows'];
        }
    }

    public function toFieldDefinition(StorageFieldDefinition $storageDef, FieldDefinition $fieldDef): void
    {

        $fieldDef->fieldTypeConstraints->fieldSettings = new FieldSettings(
            [
                'textRows' => $storageDef->dataInt1,
            ]
        );
        $fieldDef->defaultValue->data = null;
        $fieldDef->defaultValue->sortKey = '';
    }

    public function getIndexColumn(): string
    {
        return 'sort_key_string';
    }
}
