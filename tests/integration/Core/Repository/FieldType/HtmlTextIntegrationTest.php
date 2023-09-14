<?php

declare(strict_types=1);

namespace Netgen\IbexaFieldTypeHtmlText\Tests\Integration\Core\Repository\FieldType;

use Ibexa\Contracts\Core\Repository\Values\Content\Field;
use Ibexa\Core\Base\Exceptions\InvalidArgumentType;
use Ibexa\Tests\Integration\Core\Repository\FieldType\BaseIntegrationTest;
use Netgen\IbexaFieldTypeHtmlText\FieldType\Value as HtmlTextValue;

use const PHP_EOL;

/**
 * Integration test for use field type.
 *
 * @group integration
 * @group field-type
 */
class HtmlTextIntegrationTest extends BaseIntegrationTest
{
    public function getTypeName()
    {
        return 'nghtmltext';
    }

    public function getSettingsSchema()
    {
        return [
            'textRows' => [
                'type' => 'int',
                'default' => 10,
            ],
        ];
    }

    public function getValidFieldSettings()
    {
        return [
            'textRows' => 0,
        ];
    }

    public function getInvalidFieldSettings()
    {
        return [
            'somethingUnknown' => 0,
        ];
    }

    public function getValidatorSchema()
    {
        return [];
    }

    public function getValidValidatorConfiguration()
    {
        return [];
    }

    public function getInvalidValidatorConfiguration()
    {
        return [
            'unknown' => ['value' => 23],
        ];
    }

    public function getValidCreationFieldData()
    {
        return new HtmlTextValue('Example');
    }

    public function getFieldName()
    {
        return 'Example';
    }

    public function assertFieldDataLoadedCorrect(Field $field)
    {
        self::assertInstanceOf(
            HtmlTextValue::class,
            $field->value,
        );

        $expectedData = [
            'text' => 'Example',
        ];
        $this->assertPropertiesCorrect(
            $expectedData,
            $field->value,
        );
    }

    public function provideInvalidCreationFieldData()
    {
        return [
            [
                new \stdClass(),
                InvalidArgumentType::class,
            ],
        ];
    }

    public function getValidUpdateFieldData()
    {
        return new HtmlTextValue('Example  2');
    }

    public function assertUpdatedFieldDataLoadedCorrect(Field $field)
    {
        self::assertInstanceOf(
            HtmlTextValue::class,
            $field->value,
        );

        $expectedData = [
            'text' => 'Example  2',
        ];
        $this->assertPropertiesCorrect(
            $expectedData,
            $field->value,
        );
    }

    public function provideInvalidUpdateFieldData()
    {
        return $this->provideInvalidCreationFieldData();
    }

    public function assertCopiedFieldDataLoadedCorrectly(Field $field)
    {
        self::assertInstanceOf(
            HtmlTextValue::class,
            $field->value,
        );

        $expectedData = [
            'text' => 'Example',
        ];
        $this->assertPropertiesCorrect(
            $expectedData,
            $field->value,
        );
    }

    public function provideToHashData()
    {
        return [
            [
                new HtmlTextValue('Simple value'),
                'Simple value',
            ],
            // HTML purifier test cases
            [
                new HtmlTextValue('<b>Bold'),
                '<b>Bold</b>',
            ],
            [
                new HtmlTextValue("<h1>News</h1><script>alert('Something malicious');</script><a onclick=\"alert('Another malicious thing');\" href=\"https://netgen.io\">Netgen</a>"),
                '<h1>News</h1><a href="https://netgen.io">Netgen</a>',
            ],
        ];
    }

    public function provideFromHashData()
    {
        return [
            [
                'Foobar',
                new HtmlTextValue('Foobar'),
            ],
        ];
    }

    public function providerForTestIsEmptyValue()
    {
        return [
            [new HtmlTextValue()],
            [new HtmlTextValue(null)],
            [new HtmlTextValue('')],
            [new HtmlTextValue("\n\n\n")],
            [new HtmlTextValue("\r\r\r")],
            [new HtmlTextValue('   ')],
        ];
    }

    public function providerForTestIsNotEmptyValue()
    {
        return [
            [
                $this->getValidCreationFieldData(),
            ],
            [new HtmlTextValue(0)],
            [new HtmlTextValue('0')],
        ];
    }

    protected function getValidSearchValueOne()
    {
        return 'caution is the " path to mediocrity' . PHP_EOL . 'something completely different';
    }

    protected function getSearchTargetValueOne()
    {
        // ensure case-insensitivity
        return mb_strtoupper('caution is the " path to mediocrity');
    }

    protected function getValidSearchValueTwo()
    {
        return "truth suffers from ' too much analysis\n hello and goodbye";
    }

    protected function getSearchTargetValueTwo()
    {
        // ensure case-insensitivity
        return mb_strtoupper("truth suffers from ' too much analysis");
    }

    protected function getFullTextIndexedFieldData()
    {
        return [
            ['path', 'analysis'],
        ];
    }
}
