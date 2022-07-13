<?php

namespace App\Models;

use App\Constants\Attributes;
use App\Constants\Tables;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class EliteServicesContent
 * @package App\Models
 *
 * @property string section_type
 * @property string background_image
 * @property string heading_top
 * @property string heading
 * @property string subheading
 * @property string paragraph
 * @property string text
 * @property string square_image
 * @property string big_image
 * @property boolean has_bullet_points
 */
class EliteServicesContent extends Model
{
    use HasFactory;
    protected $table = Tables::ELITE_SERVICES_CONTENT;

    protected $fillable = [
        Attributes::SECTION_TYPE,
        Attributes::BACKGROUND_IMAGE,
        Attributes::HEADING_TOP,
        Attributes::HEADING,
        Attributes::SUBHEADING,
        Attributes::PARAGRAPH,
        Attributes::TEXT,
        Attributes::SQUARE_IMAGE,
        Attributes::BIG_IMAGE,
        Attributes::HAS_BULLET_POINTS
    ];
    /**
     * Relationship: bullet points content
     * @return HasMany
     */
    public function bulletPointsContent() {
        return $this->hasMany(BulletPointsContent::class, Attributes::SECTION_CONTENT_ID, Attributes::ID);
    }
}
