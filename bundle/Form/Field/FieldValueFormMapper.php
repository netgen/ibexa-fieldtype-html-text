<?php

declare(strict_types=1);

namespace Netgen\IbexaFieldTypeHtmlTextBundle\Form\Field;

use Ibexa\ContentForms\FieldType\Mapper\AbstractRelationFormMapper;
use Ibexa\Contracts\ContentForms\Data\Content\FieldData;
use Symfony\Component\Form\FormInterface;

class FieldValueFormMapper extends AbstractRelationFormMapper
{
    public function mapFieldValueForm(FormInterface $fieldForm, FieldData $data)
    {
        $fieldDefinition = $data->fieldDefinition;
        $formConfig = $fieldForm->getConfig();

        $fieldForm
            ->add(
                $formConfig->getFormFactory()->createBuilder()
                    ->create(
                        'value',
                        FieldValueType::class,
                        [
                            'row_attr' => ['class' => $fieldDefinition->fieldTypeIdentifier],
                            'required' => $fieldDefinition->isRequired,
                            'label' => $fieldDefinition->getName(),
                            'rows' => $data->fieldDefinition->fieldSettings['textRows'],
                        ]
                    )
                    ->setAutoInitialize(false)
                    ->getForm()
            );
    }
}
