<?php

declare(strict_types = 1);

namespace App\Http\Controllers\API\RESTful\V1\Finances;

use App\Http\Requests\Finances\v1\PlansComptable\CreatePlanComptableRequest;
use App\Http\Requests\Finances\v1\PlansComptable\UpdatePlanComptableRequest;
use Core\Utils\Controllers\RESTful\RESTfulResourceController;
use Domains\Finances\PlansComptable\Services\RESTful\Contracts\PlanComptableRESTfulQueryServiceContract;
use Domains\Finances\PlansComptable\Services\RESTful\Contracts\PlanComptableRESTfulReadWriteServiceContract;

/**
 * **`PlanComptableController`**
 *
 * Controller for managing classe resources. This controller extends the RESTfulController
 * and provides CRUD operations for classe resources.
 *
 * @package **`\App\Http\Controllers\APIs\RESTful\V1`**
 */
class PlanComptableController extends RESTfulResourceController
{
    /**
     * Create a new PlanComptableController instance.
     *
     * @param \Domains\PlansComptable\Services\RESTful\Contracts\PlanComptableRESTfulQueryServiceContract $planComptableRESTfulQueryService
     *        The PlanComptable RESTful Query Service instance.
     */
    public function __construct(PlanComptableRESTfulReadWriteServiceContract $planComptableRESTfulReadWriteService, PlanComptableRESTfulQueryServiceContract $planComptableRESTfulQueryService)
    {
        parent::__construct($planComptableRESTfulReadWriteService, $planComptableRESTfulQueryService);

        // Set specific request classes for store and update methods
        $this->setRequestClass('store', CreatePlanComptableRequest::class);
        $this->setRequestClass('update', UpdatePlanComptableRequest::class);
    }
}
