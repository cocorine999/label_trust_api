<?php

declare(strict_types=1);

namespace Domains\Finances\PlansComptable\Accounts\Services\RESTful\Contracts;

use Core\Logic\Services\RestJson\Contracts\RestJsonQueryServiceContract;

/**
 * Interface ***`AccountRESTfulQueryServiceContract`***
 *
 * The `AccountRESTfulQueryServiceContract` interface is a contract that defines the methods
 * for a RESTful query service specific to Account resources.
 *
 * This interface extends the RestJsonQueryServiceContract interface, which provides
 * a set of common methods for performing RESTful queries on JSON-based resources.
 *
 * Implementing classes should provide the necessary implementation for each method
 * defined in this interface, which includes `querying`, `filtering`, `sorting`, `pagination`,
 * and other operations specific to Account resources.
 *
 * @package ***`\Domains\Finances\PlansComptable\Accounts\Services\RESTful\Contracts`***
 */
interface AccountRESTfulQueryServiceContract extends RestJsonQueryServiceContract
{

}