<?php

declare(strict_types=1);

namespace Domains\Finances\PlansComptable\Services\RESTful;

use Core\Logic\Services\Contracts\ReadWriteServiceContract;
use Core\Logic\Services\RestJson\RestJsonReadWriteService;
use Domains\Finances\PlansComptable\Services\RESTful\Contracts\PlanComptableRESTfulReadWriteServiceContract;

/**
 * The ***`PlanComptableRESTfulReadWriteService`*** class provides RESTful CRUD operations for the "PlanComptable" resource.
 *
 * This service class extends the `RestJsonReadWriteService` class to handle the read and write operations for the "PlanComptable" resource.
 * It implements the `PlanComptableRESTfulReadWriteServiceContract` interface that defines the contract for this service.
 * The class leverages the `JsonResponseTrait` to create consistent JSON responses with `success`, `error`, and `validation` error structures.
 *
 * @package ***`\Domains\Finances\PlansComptable\Services\RESTful`***
 */
class PlanComptableRESTfulReadWriteService extends RestJsonReadWriteService implements PlanComptableRESTfulReadWriteServiceContract
{
    /**
     * Constructor for the PlanComptableRESTfulReadWriteService class.
     *
     * @param ReadWriteServiceContract $readWriteService The query service instance to be used.
     */
    public function __construct(ReadWriteServiceContract $readWriteService)
    {
        parent::__construct($readWriteService);
    }

}