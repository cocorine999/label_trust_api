<?php

declare(strict_types = 1);

namespace App\Http\Controllers\API\RESTful\V1;

use App\Http\Requests\Employees\v1\CreateEmployeeRequest;
use App\Http\Requests\Employees\v1\UpdateEmployeeRequest;
use Core\Utils\Controllers\RESTful\RESTfulResourceController;
use Domains\Employees\Services\RESTful\Contracts\EmployeeRESTfulQueryServiceContract;
use Domains\Employees\Services\RESTful\Contracts\EmployeeRESTfulReadWriteServiceContract;

/**
 * **`EmployeeController`**
 *
 * Controller for managing Employee resources. This controller extends the RESTfulController
 * and provides CRUD operations for Employee resources.
 *
 * @package **`\App\Http\Controllers\APIs\RESTful\V1`**
 */
class EmployeeController extends RESTfulResourceController
{
    /**
     * Create a new EmployeeController instance.
     *
     * @param \Domains\Employees\Services\RESTful\Contracts\EmployeeRESTfulQueryServiceContract $EmployeeRESTfulQueryService
     *        The Employee RESTful Query Service instance.
     */
    public function __construct(EmployeeRESTfulReadWriteServiceContract $EmployeeRESTfulReadWriteService, EmployeeRESTfulQueryServiceContract $EmployeeRESTfulQueryService)
    {
        parent::__construct($EmployeeRESTfulReadWriteService, $EmployeeRESTfulQueryService);

        // Set specific request classes for store and update methods
        $this->setRequestClass('store', CreateEmployeeRequest::class);
        $this->setRequestClass('update', UpdateEmployeeRequest::class);
    }
}
