<?php

namespace App\Models;

use App\Contracts\TextSourceInterface;
use App\Services\TextAnalyzer;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\News
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $link
 * @property string $published_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|News newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|News newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|News query()
 * @method static \Illuminate\Database\Eloquent\Builder|News whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereUpdatedAt($value)
 * @property float $accent_ratio_index
 * @method static \Illuminate\Database\Eloquent\Builder|News whereAccentRatioIndex($value)
 * @mixin \Eloquent
 */
class News extends Model implements TextSourceInterface
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'link',
        'published_at',
        'accent_ratio_index',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function (News $news) {
            $analyzer = app(TextAnalyzer::class, [$news]);
            $analyzer->analyze();
            $news->accent_ratio_index = $analyzer->getAccentRatioIndex();
        });
    }


    public static function getOrderedNews(): Collection
    {
        return News::query()
            ->orderByDesc('created_at')
            ->get();
    }

    public function getText(): string|null
    {
        return $this->description;
    }
}
