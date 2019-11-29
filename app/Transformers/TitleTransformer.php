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
            'titleIdentifier' => (int)$title->id,
            'titleName' => (string)$title->title,
            'createdDate' => $title->created_at,
            'changeDate' => $title->updated_at,
        ];
    }
}
