<?php

namespace Tests\Unit\Components;

use Orchestra\Testbench\TestCase;
use WireUi\View\Components\Select;

class SelectTest extends TestCase
{
    /**
     * @test
     * The optimized JSON must be simple, the component, disabled, and the readonly attributes
     * only will be added to option object if the value is not the default value.
     */
    public function it_should_map_the_select_options_and_return_a_optimized_json_with_label_and_value()
    {
        $select = new Select(
            optionValue: 'value',
            optionLabel: 'label',
            options: [
                [
                    'value'    => '1',
                    'label'    => 'One',
                    'disabled' => true,
                    'readonly' => true,
                ],
                [
                    'value'     => '2',
                    'label'     => 'Two',
                    'component' => 'foo',
                ],
                [
                    'value'    => '3',
                    'label'    => 'Three',
                    'disabled' => true,
                    'readonly' => false,
                ],
                [
                    'value'    => '4',
                    'label'    => 'Four',
                    'disabled' => false,
                    'readonly' => true,
                ],
                [
                    'value'    => '5',
                    'label'    => 'Five',
                    'disabled' => false,
                    'readonly' => false,
                ],
            ]
        );

        $this->assertSame(
            json_encode([
                [
                    'label'    => 'One',
                    'value'    => '1',
                    'disabled' => true,
                    'readonly' => true,
                ], [
                    'label'     => 'Two',
                    'value'     => '2',
                    'component' => 'foo',
                ], [
                    'label'    => 'Three',
                    'value'    => '3',
                    'disabled' => true,
                ], [
                    'label'    => 'Four',
                    'value'    => '4',
                    'readonly' => true,
                ], [
                    'label' => 'Five',
                    'value' => '5',
                ],
            ]),
            $select->optionsToJson()
        );
    }

    /** @test */
    public function it_should_map_the_select_options_and_return_a_optimized_json_with_simple_values()
    {
        $select = new Select(
            options: [
                'One',
                'Two',
                'Three',
            ]
        );

        $this->assertSame(
            json_encode([
                [
                    'label' => 'One',
                    'value' => 'One',
                ], [
                    'label' => 'Two',
                    'value' => 'Two',
                ], [
                    'label' => 'Three',
                    'value' => 'Three',
                ],
            ]),
            $select->optionsToJson()
        );
    }

    /** @test */
    public function it_should_map_the_select_options_and_return_a_optimized_json_with_simple_values_using_key_as_value()
    {
        $select = new Select(
            optionKeyValue: true,
            options: [
                'One',
                'Two',
                'Three',
            ]
        );

        $this->assertSame(
            json_encode([
                [
                    'label' => 'One',
                    'value' => 0,
                ], [
                    'label' => 'Two',
                    'value' => 1,
                ], [
                    'label' => 'Three',
                    'value' => 2,
                ],
            ]),
            $select->optionsToJson()
        );
    }

    /** @test */
    public function it_should_map_the_select_options_and_return_a_optimized_json_with_simple_values_using_key_as_label()
    {
        $select = new Select(
            optionKeyLabel: true,
            options: [
                'One',
                'Two',
                'Three',
            ]
        );

        $this->assertSame(
            json_encode([
                [
                    'label' => 0,
                    'value' => 'One',
                ], [
                    'label' => 1,
                    'value' => 'Two',
                ], [
                    'label' => 2,
                    'value' => 'Three',
                ],
            ]),
            $select->optionsToJson()
        );
    }
}
