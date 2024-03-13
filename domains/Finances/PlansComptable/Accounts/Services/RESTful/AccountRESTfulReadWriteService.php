<?php

declare(strict_types=1);

namespace Domains\Finances\PlansComptable\Accounts\Services\RESTful;

use Core\Logic\Services\Contracts\ReadWriteServiceContract;
use Core\Logic\Services\RestJson\RestJsonReadWriteService;
use Domains\Finances\PlansComptable\Accounts\Services\RESTful\Contracts\AccountRESTfulReadWriteServiceContract;

/**
 * The ***`AccountRESTfulReadWriteService`*** class provides RESTful CRUD operations for the "Account" resource.
 *
 * This service class extends the `RestJsonReadWriteService` class to handle the read and write operations for the "Account" resource.
 * It implements the `AccountRESTfulReadWriteServiceContract` interface that defines the contract for this service.
 * The class leverages the `JsonResponseTrait` to create consistent JSON responses with `success`, `error`, and `validation` error structures.
 *
 * @package ***`\Domains\Finances\PlansComptable\Accounts\Services\RESTful`***
 */
class AccountRESTfulReadWriteService extends RestJsonReadWriteService implements AccountRESTfulReadWriteServiceContract
{
    /**
     * Constructor for the AccountRESTfulReadWriteService class.
     *
     * @param ReadWriteServiceContract $readWriteService The query service instance to be used.
     */
    public function __construct(ReadWriteServiceContract $readWriteService)
    {
        parent::__construct($readWriteService);
    }

}