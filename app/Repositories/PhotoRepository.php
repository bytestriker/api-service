<?php

namespace App\Repositories;

use App\Models\Photo;
use App\Repositories\BaseRepository;

/**
 * Class PhotoRepository
 * @package App\Repositories
 * @version November 4, 2024, 11:07 pm UTC
*/

class PhotoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
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
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Photo::class;
    }
}
