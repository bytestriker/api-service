<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Banner
 * @package App\Models
 * @version November 4, 2024, 11:03 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection $photos
 * @property string $section
 * @property string $slug
 * @property boolean $is_published
 * @property string $date_from
 * @property string $date_to
 */
class Banner extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'banners';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'section',
        'slug',
        'is_published',
        'date_from',
        'date_to'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'section' => 'string',
        'slug' => 'string',
        'is_published' => 'boolean',
        'date_from' => 'date',
        'date_to' => 'date'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'section' => 'required|string|max:255',
        'slug' => 'required|string|max:255',
        'is_published' => 'required|boolean',
        'date_from' => 'required',
        'date_to' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function photos()
    {
        return $this->hasMany(\App\Models\Photo::class, 'banner_id');
    }
}
