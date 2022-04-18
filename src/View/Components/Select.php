<?php

namespace WireUi\View\Components;

class Select extends NativeSelect
{
    public bool $clearable;

    public string $rightIcon;

    public string $optionComponent;

    public string $optionsHash;

    public ?string $icon;

    public bool $searchable;

    public bool $multiselect;

    public function __construct(
        string $rightIcon = 'selector',
        string $optionComponent = 'select.option',
        bool $clearable = true,
        bool $searchable = true,
        bool $multiselect = false,
        bool $optionKeyLabel = false,
        bool $optionKeyValue = false,
        ?string $label = null,
        ?string $placeholder = null,
        ?string $optionValue = null,
        ?string $optionLabel = null,
        ?string $icon = null,
        $options = null
    ) {
        parent::__construct(
            $label,
            $placeholder,
            $optionValue,
            $optionLabel,
            $optionKeyLabel,
            $optionKeyValue,
            $options
        );

        $this->clearable       = $clearable;
        $this->rightIcon       = $rightIcon;
        $this->optionComponent = $optionComponent;
        $this->searchable      = $searchable;
        $this->multiselect     = $multiselect;
        $this->icon            = $icon;
        $this->optionsHash     = 'wireui:select:' . md5($this->options);
    }

    protected function getView(): string
    {
        return 'wireui::components.select';
    }

    public function optionsToJson(): string
    {
        return $this->options->map(function (mixed $rawOption, int $index) {
            $option = [
                'label' => $this->getOptionLabel($index, $rawOption),
                'value' => $this->getOptionValue($index, $rawOption),
            ];

            if ($component = data_get($rawOption, 'component')) {
                $option['component'] = $component;
            }

            if (data_get($rawOption, 'disabled')) {
                $option['disabled'] = true;
            }

            if (data_get($rawOption, 'readonly')) {
                $option['readonly'] = true;
            }

            return $option;
        })->toJson();
    }
}
