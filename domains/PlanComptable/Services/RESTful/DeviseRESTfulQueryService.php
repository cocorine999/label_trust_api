<?php

declare(strict_types=1);

namespace Domains\Devises\Services\RESTful;

use Core\Logic\Services\Contracts\QueryServiceContract;
use Core\Logic\Services\RestJson\RestJsonQueryService;
use Domains\Devises\Services\RESTful\Contracts\DeviseRESTfulQueryServiceContract;

/**
 * Class ***`DeviseRESTfulQueryService`***
 *
 * The `DeviseRESTfulQueryService` class is responsible for providing a RESTful implementation of the query service for the Devises module.
 * It extends the `RestJsonQueryService` class provided by the Core module and implements the `DeviseRESTfulQueryServiceContract` interface.
 *
 * The `DeviseRESTfulQueryService` class primarily serves as a wrapper around the underlying query service, providing RESTful capabilities for querying Devise resources.
 *
 * @package ***`\Domains\Devises\Services\RESTful`***
 */
class DeviseRESTfulQueryService extends RestJsonQueryService implements DeviseRESTfulQueryServiceContract
{
    /**
     * Constructor for the DeviseRESTfulQueryService class.
     *
     * @param QueryServiceContract $queryService The query service instance to be used.
     */
    public function __construct(QueryServiceContract $queryService)
    {
        parent::__construct($queryService);
    }

}