<?php

namespace App\Traits;

trait HideTimestampsTrait
{
    /**
     * Get the hidden attributes for the model,
     * hiding the timestamps in the process.
     *
     * @return array
     */
    public function getHidden()
    {
        return array_merge([
            'created_at',
            'updated_at',
        ], $this->hidden);
    }
}
