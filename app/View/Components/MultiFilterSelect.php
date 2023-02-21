<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MultiFilterSelect extends Component
{

    public function __construct(
        public string                $label,
        public string                $name,
        public iterable              $options,
        public array                 $selected,
        private readonly string|null $langFile = null)
    {
    }

    public function render(): View
    {
        $translatedOptions = $this->getTranslatedOptions();

        return view('components.multi-filter-select', ['translatedOptions' => $translatedOptions]);
    }

    protected function getTranslatedOptions(): array
    {
        $translatedOptions = [];

        foreach ($this->options as $option) {
            $translatedOptions[$option] = $this->getTranslatedName($option);
        }
        asort($translatedOptions);

        return $translatedOptions;
    }

    protected function getTranslatedName(string $option): string
    {
        $translatedOption = __($this->langFile . '.' . $option);

        return $translatedOption !== "{$this->langFile}.{$option}" ? $translatedOption : $option;
    }
}
