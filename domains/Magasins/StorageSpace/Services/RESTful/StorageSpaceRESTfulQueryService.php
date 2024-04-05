<?php

declare(strict_types=1);

namespace Domains\Magasins\StorageSpace\Services\RESTful;

use Core\Logic\Services\Contracts\QueryServiceContract;
use Core\Logic\Services\RestJson\RestJsonQueryService;
use Domains\Magasins\StorageSpace\Services\RESTful\Contracts\StorageSpaceRESTfulQueryServiceContract;

/**
 * Class ***`StorageSpaceRESTfulQueryService`***
 *
 * The `StorageSpaceRESTfulQueryService` class is responsible for providing a RESTful implementation of the query service for the StorageSpace module.
 * It extends the `RestJsonQueryService` class provided by the Core module and implements the `StorageSpaceRESTfulQueryServiceContract` interface.
 *
 * The `StorageSpaceRESTfulQueryService` class primarily serves as a wrapper around the underlying query service, providing RESTful capabilities for querying StorageSpace resources.
 *
 * @package ***`\Domains\Magasins\StorageSpace\Services\RESTful`***
 */
class StorageSpaceRESTfulQueryService extends RestJsonQueryService implements StorageSpaceRESTfulQueryServiceContract
{
    /**
     * Constructor for the StorageSpaceRESTfulQueryService class.
     *
     * @param QueryServiceContract $queryService The query service instance to be used.
     */
    public function __construct(QueryServiceContract $queryService)
    {
        parent::__construct($queryService);
    }

}