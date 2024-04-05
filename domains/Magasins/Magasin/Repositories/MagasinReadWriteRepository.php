<?php

declare(strict_types=1);

namespace Domains\Magasins\Magasin\Repositories;

use App\Models\Magasins\Magasin;
use Core\Data\Repositories\Eloquent\EloquentReadWriteRepository;

/**
 * ***`MagasinReadWriteRepository`***
 *
 * This class extends the EloquentReadWriteRepository class, which suggests that it is responsible for providing read-only access to the Magasin $instance data.
 *
 * @package ***`Domains\Magasins\Magasin\Repositories`***
 */
class MagasinReadWriteRepository extends EloquentReadWriteRepository
{
    /**
     * Create a new MagasinReadWriteRepository instance.
     *
     * @param  \App\Models\Magasins\Magasin $model
     * @return void
     */
    public function __construct(Magasin $model)
    {
        parent::__construct($model);
    }
    
}