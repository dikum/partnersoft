<?php

namespace App\Transformers;

use App\Title;
use League\Fractal\TransformerAbstract;

class TitleTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Title $title)
    {
        return [
            'titleIdentifier' => (string)$title->title_id,
            'titleName' => (string)$title->title,
            'createdDate' => (string)$title->created_at,
            'changeDate' => (string)$title->updated_at,
        ];
    }

    public static function originalAttribute($index)
    {
        $attributes = [

            'titleIdentifier' => 'title_id',
            'titleName' => 'title',
            'createdDate' => 'created_at',
            'changeDate' => 'updated_at',

        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
