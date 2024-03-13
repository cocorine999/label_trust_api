<?php

declare(strict_types=1);

namespace Domains\Finances\PlansComptable\SubAccounts\Repositories;

use App\Models\Finances\SubAccount;
use Core\Data\Repositories\Eloquent\EloquentReadWriteRepository;

/**
 * ***`SubAccountReadWriteRepository`***
 *
 * This class extends the EloquentReadWriteRepository class, which suggests that it is responsible for providing read-only access to the SubAccount $instance data.
 *
 * @package ***`Domains\Finances\PlansComptable\SubAccounts\Repositories`***
 */
class SubAccountReadWriteRepository extends EloquentReadWriteRepository
{
    /**
     * Create a new SubAccountReadWriteRepository instance.
     *
     * @param  \App\Models\Finances\SubAccount $model
     * @return void
     */
    public function __construct(SubAccount $model)
    {
        parent::__construct($model);
    }
    
}