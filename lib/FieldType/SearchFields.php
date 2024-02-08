<?php

declare(strict_types=1);

namespace Netgen\IbexaFieldTypeHtmlText\FieldType;

use Ibexa\Contracts\Core\FieldType\Indexable;
use Ibexa\Contracts\Core\Persistence\Content\Field;
use Ibexa\Contracts\Core\Persistence\Content\Type\FieldDefinition;
use Ibexa\Contracts\Core\Search;
use Ibexa\Contracts\Core\Search\FieldType\StringField;

use function mb_substr;
use function strtok;
use function trim;

class SearchFields implements Indexable
{
    public function getIndexData(Field $field, FieldDefinition $fieldDefinition)
    {
        return [
            new Search\Field(
                'value',
                $this->extractShortText($field->value->data),
                new StringField(),
            ),
            new Search\Field(
                'fulltext',
                $field->value->data,
                new Search\FieldType\FullTextField(),
            ),
        ];
    }

    public function getIndexDefinition()
    {
        return [
            'value' => new StringField(),
        ];
    }

    public function getDefaultMatchField()
    {
        return 'value';
    }

    public function getDefaultSortField()
    {
        return $this->getDefaultMatchField();
    }

    private function extractShortText($string)
    {
        if ($string === null || trim($string) === '') {
            return '';
        }

        return mb_substr(strtok(trim((string) $string), "\r\n"), 0, 255);
    }
}
