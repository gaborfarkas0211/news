<?php

namespace App\Services;

use App\Contracts\TextSourceInterface;
use Illuminate\Support\Collection;

class TextAnalyzer implements Analyzer
{
    private string $cleanedDescription;
    private Collection $uniqueWords;
    private int $wordsCount;
    private int|float $accentRatioIndex = 0;

    public function __construct(private readonly TextSourceInterface $textSource)
    {
    }

    public function analyze(): void
    {
        $this->cleanDescription();
        $this->setUniqueWords();

        if (0 === $this->wordsCount) {
            return;
        }

        $this->calculateAccentRatioIndex();
    }

    public function getAccentRatioIndex(): float|int
    {
        return $this->accentRatioIndex;
    }

    private function cleanDescription(): void
    {
        $this->cleanedDescription = preg_replace('/\p{P}/u', '', mb_strtolower($this->textSource->getText()));
    }

    private function setUniqueWords(): void
    {
        $words = array_filter(explode(' ', $this->cleanedDescription));
        $this->wordsCount = count($words);
        $this->uniqueWords = collect($words);
    }

    private function calculateAccentRatioIndex(): void
    {
        $accentRatios = $this->calculateAccentRatios();
        $mostCommonRatiosCount = $this->getMostCommonAccentRatioCount($accentRatios);

        $this->accentRatioIndex = $mostCommonRatiosCount / $this->wordsCount;
    }

    private function calculateAccentRatios(): Collection
    {
        return $this->uniqueWords->map(fn(string $word) => $this->calculateAccentRatioForWord($word));
    }

    private function getMostCommonAccentRatioCount(Collection $accentRatios): int
    {
        $mostCommonRatiosCounts = $accentRatios->map(static fn(int|float $ratio) => $ratio * 10)->countBy();

        return $mostCommonRatiosCounts->max();
    }

    private function calculateAccentRatioForWord(string $word): float
    {
        $accentCharsCount = count(preg_grep('/[áéíóöőúüű]/u', mb_str_split($word)));
        $charsCount = mb_strlen($word);

        return round($accentCharsCount / $charsCount, 1);
    }
}
