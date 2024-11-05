<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Photo
 * @package App\Models
 * @version November 4, 2024, 11:07 pm UTC
 *
 * @property \App\Models\Banner $banner
 * @property integer $banner_id
 * @property string $small_image
 * @property string $cover_image
 * @property string $title
 * @property string $body
 * @property string $caption
 * @property string $link
 * @property boolean $is_published
 * @property string $date_from
 * @property string $date_to
 */
class Photo extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'photos';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'banner_id',
        'small_image',
        'cover_image',
        'title',
        'body',
        'caption',
        'link',
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
        'banner_id' => 'integer',
        'small_image' => 'string',
        'cover_image' => 'string',
        'title' => 'string',
        'body' => 'string',
        'caption' => 'string',
        'link' => 'string',
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
        'banner_id' => 'required',
        'small_image' => 'required|string|max:255',
        'cover_image' => 'required|string|max:255',
        'title' => 'nullable|string|max:255',
        'body' => 'nullable|string|max:255',
        'caption' => 'nullable|string|max:255',
        'link' => 'nullable|string|max:255',
        'is_published' => 'required|boolean',
        'date_from' => 'required',
        'date_to' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function banner()
    {
        return $this->belongsTo(\App\Models\Banner::class, 'banner_id');
    }
}
