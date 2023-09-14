<?php

declare(strict_types=1);

namespace Netgen\IbexaFieldTypeHtmlText\Tests\Unit\FieldType;

use Ibexa\Core\Base\Exceptions\InvalidArgumentException;

use Ibexa\Tests\Core\FieldType\FieldTypeTest;
use Netgen\IbexaFieldTypeHtmlText\FieldType\Type as HtmlTextType;
use Netgen\IbexaFieldTypeHtmlText\FieldType\Value as HtmlTextValue;
use Netgen\IbexaFieldTypeHtmlText\Utils\HtmlPurifier;

/**
 * @group type
 */
class HtmlTextTypeTest extends FieldTypeTest
{
    protected function createFieldTypeUnderTest()
    {
        $htmlPurifier = new HtmlPurifier();
        $fieldType = new HtmlTextType($htmlPurifier);
        $fieldType->setTransformationProcessor($this->getTransformationProcessorMock());

        return $fieldType;
    }

    protected function provideFieldTypeIdentifier()
    {
        return 'nghtmltext';
    }

    protected function getValidatorConfigurationSchemaExpectation()
    {
        return [];
    }

    protected function getSettingsSchemaExpectation()
    {
        return [
            'textRows' => [
                'type' => 'int',
                'default' => 10,
            ],
        ];
    }

    protected function getEmptyValueExpectation()
    {
        return new HtmlTextValue();
    }

    public function provideInvalidInputForAcceptValue()
    {

        return [
            [
                23,
                InvalidArgumentException::class,
            ],
            [
                new HtmlTextValue(23),
                InvalidArgumentException::class,
            ],
        ];
    }

    public function provideValidInputForAcceptValue()
    {
        return [
            [
                null,
                new HtmlTextValue(),
            ],
            [
                '',
                new HtmlTextValue(),
            ],
            [
                'sindelfingen',
                new HtmlTextValue('sindelfingen'),
            ],
            [
                new HtmlTextValue('sindelfingen'),
                new HtmlTextValue('sindelfingen'),
            ],
            [
                new HtmlTextValue(''),
                new HtmlTextValue(),
            ],
            [
                new HtmlTextValue(null),
                new HtmlTextValue(),
            ],
        ];
    }

    public function provideInputForToHash()
    {
        return [
            [
                new HtmlTextValue(),
                null,
            ],
            [
                new HtmlTextValue('sindelfingen'),
                'sindelfingen',
            ],
            // HTML purifier test cases
            [
                new HtmlTextValue('<b>Bold'),
                '<b>Bold</b>'
            ],
            [
                new HtmlTextValue("<h1>News</h1><script>alert('Something malicious');</script><a onclick=\"alert('Another malicious thing');\" href=\"https://netgen.io\">Netgen</a>"),
                '<h1>News</h1><a href="https://netgen.io">Netgen</a>'
            ],
        ];
    }

    public function provideInputForFromHash()
    {
        return [
            [
                '',
                new HtmlTextValue(),
            ],
            [
                'sindelfingen',
                new HtmlTextValue('sindelfingen'),
            ],
        ];
    }

    public function provideDataForGetName(): array
    {
        return [
            [$this->getEmptyValueExpectation(), '', [], 'en_GB'],
            [new HtmlTextValue('This is a piece of text'), 'This is a piece of text', [], 'en_GB'],
        ];
    }


    public function provideValidFieldSettings()
    {
        return [
            [
                [],
            ],
            [
                [
                    'textRows' => 23,
                ],
            ],
        ];
    }

    public function provideInValidFieldSettings()
    {
        return [
            [
                [
                    'non-existent' => 'foo',
                ],
            ],
            [
                [
                    // textRows must be integer
                    'textRows' => 'foo',
                ],
            ],
        ];
    }
}
