<?php

declare(strict_types=1);

namespace Netgen\IbexaFieldTypeHtmlText\OpenGraph;

use Ibexa\Contracts\Core\Repository\Values\Content\Field;
use Netgen\Bundle\OpenGraphBundle\Exception\FieldEmptyException;
use Netgen\Bundle\OpenGraphBundle\Handler\FieldType\Handler;
use Netgen\IbexaFieldTypeHtmlText\FieldType\Value;

use function str_replace;
use function strip_tags;
use function trim;

final class HtmlText extends Handler
{
    /**
     * @param array<mixed> $params
     */
    protected function getFieldValue(Field $field, string $tagName, array $params = []): string
    {
        if (!$this->fieldHelper->isFieldEmpty($this->content, $field->fieldDefIdentifier)) {
            return trim(str_replace("\n", ' ', strip_tags($field->value->text)));
        }

        throw new FieldEmptyException($field->fieldDefIdentifier);
    }

    protected function supports(Field $field): bool
    {
        return $field->value instanceof Value;
    }
}
