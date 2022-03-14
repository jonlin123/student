<?php

namespace App\Admin\Repositories;

use App\Models\Classes as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class Classes extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
