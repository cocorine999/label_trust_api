<?php

declare(strict_types=1);

namespace Domains\Finances\PlansComptable\Services\RESTful;

use Core\Logic\Services\Contracts\QueryServiceContract;
use Core\Logic\Services\RestJson\RestJsonQueryService;
use Domains\Finances\PlansComptable\Services\RESTful\Contracts\PlanComptableRESTfulQueryServiceContract;

/**
 * Class ***`PlanComptableRESTfulQueryService`***
 *
 * The `PlanComptableRESTfulQueryService` class is responsible for providing a RESTful implementation of the query service for the PlansComptable module.
 * It extends the `RestJsonQueryService` class provided by the Core module and implements the `PlanComptableRESTfulQueryServiceContract` interface.
 *
 * The `PlanComptableRESTfulQueryService` class primarily serves as a wrapper around the underlying query service, providing RESTful capabilities for querying PlanComptable resources.
 *
 * @package ***`\Domains\Finances\PlansComptable\Services\RESTful`***
 */
class PlanComptableRESTfulQueryService extends RestJsonQueryService implements PlanComptableRESTfulQueryServiceContract
{
    /**
     * Constructor for the PlanComptableRESTfulQueryService class.
     *
     * @param QueryServiceContract $queryService The query service instance to be used.
     */
    public function __construct(QueryServiceContract $queryService)
    {
        parent::__construct($queryService);
    }

}