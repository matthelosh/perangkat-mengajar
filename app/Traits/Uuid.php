<?php

namespace App\Traits;
use Ramsey\Uuid\Exception\UnsupportedOperationException;
use Ramsey\Uuid\Uuid as Generator;

trait Uuid
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            try {
                $model->id = Generator::uuid4()->toString();
            } catch (\Ramsey\Uuid\Exception\UnsupportedOperationException $e) {
                abort(500, $e->getMessage());
            }
        });
    }
}
