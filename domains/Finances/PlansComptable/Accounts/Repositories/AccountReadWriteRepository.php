<?php

declare(strict_types=1);

namespace Domains\Finances\PlansComptable\Accounts\Repositories;

use App\Models\Finances\Account;
use Core\Data\Repositories\Eloquent\EloquentReadWriteRepository;
use Core\Utils\Exceptions\QueryException;
use Core\Utils\Exceptions\RepositoryException;
use Domains\Finances\PlansComptable\SubAccounts\Repositories\SubAccountReadWriteRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Throwable;

/**
 * ***`AccountReadWriteRepository`***
 *
 * This class extends the EloquentReadWriteRepository class, which suggests that it is responsible for providing read-only access to the Account $instance data.
 *
 * @package ***`Domains\Finances\PlansComptable\Accounts\Repositories`***
 */
class AccountReadWriteRepository extends EloquentReadWriteRepository
{
    /**
     * @var SubAccountReadWriteRepository
     */
    protected $subAcountRepositoryReadWrite;

    /**
     * Create a new AccountReadWriteRepository instance.
     *
     * @param  \App\Models\Finances\Account $model
     * @return void
     */
    public function __construct(Account $model, SubAccountReadWriteRepository $subAcountRepositoryReadWrite)
    {
        parent::__construct($model);
        $this->subAcountRepositoryReadWrite = $subAcountRepositoryReadWrite;
    }

    /**
     * Create a new record.
     *
     * @param  array $data         The data for creating the record.
     * @return Account               The created record.
     *
     * @throws \Core\Utils\Exceptions\RepositoryException If there is an error while creating the record.
     */
    public function create(array $data): Account
    {
        try {
            $this->model = parent::create($data);

            if(isset($data['sub_accounts'])){
                $this->attachSubAccounts($this->model->id, $data['sub_accounts']);
            }

            return $this->model->refresh();
        } catch (QueryException $exception) {
            throw new QueryException(message: "Error while creating the record.", previous: $exception);
        } catch (Throwable $exception) {
            throw new RepositoryException(message: "Error while creating the record.", previous: $exception);
        }
    }

    /**
     * Attach subaccounts.
     *
     * This method associates specific taux with a given category of employee.
     *
     * @param   string      $accountId              The unique identifier of the Account.
     * @param   array       $subAccountDataArray    The array of access identifiers representing the taux to be attached.
     *
     * @return  bool                                Whether the taux were attached successfully.
     */
    public function attachSubAccounts(string $accountId, array $subAccountDataArray): bool
    {
        try {

            $this->model = $this->find($accountId);

            dd($this->model);

            foreach ($subAccountDataArray as $key => $subAccountItem) {
                if(isset($taux['sous_compte_id'])){
                    // Check if the taux is not already attached
                    if (!$this->relationExists($this->model->sous_comptes(), [$subAccountItem['sous_compte_id']])) {
                        // Attach the sous compte to principal compte
                        $this->model->sous_comptes()->syncWithoutDetaching($subAccountItem['sous_compte_id'], $subAccountItem) ? true : false;
                    }
                }else {

                    $account = $this->subAcountRepositoryReadWrite->create(array_merge($subAccountItem, ["plan_comptable_id" => $this->model->id]));
                    
                    return $this->model->sous_comptes()->syncWithoutDetaching($subAccountItem['sous_compte_id'], $subAccountItem) ? true : false;
                }
            }
    
            return false; // Taux is already attached
            
        } catch (ModelNotFoundException $exception) {
            throw new QueryException(message: "{$exception->getMessage()}", previous: $exception);
        } catch (QueryException $exception) {
            throw new QueryException(message: "Error while attaching taux to category of employee.", previous: $exception);
        } catch (Throwable $exception) {
            throw new RepositoryException(message: "Error while attaching taux to category of employee.", previous: $exception);
        }        
    }

    /**
     * Detach taux from a category of employee.
     *
     * This method associates specific taux with a given category of employee.
     *
     * @param   string      $accountId     The unique identifier of the category of employee.
     * @param   array       $subAccountIds                The array of access identifiers representing the taux to be detached.
     *
     * @return  bool                                Whether the taux were detached successfully.
     */
    public function detachTaux(string $accountId, $subAccountIds): bool
    {
        try {

            $this->model = $this->find($accountId);

            return $this->model->sous_comptes()->updateExistingPivot($subAccountIds, ['deleted_at' => now()]) ? true : false;
        } catch (ModelNotFoundException $exception) {
            throw new QueryException(message: "{$exception->getMessage()}", previous: $exception);
        } catch (QueryException $exception) {
            throw new QueryException(message: "Error while detaching taux from category of employee.", previous: $exception);
        } catch (Throwable $exception) {
            throw new RepositoryException(message: "Error while detaching taux from category of employee.", previous: $exception);
        }
    }
    
    /**
     * Check if the specified relationship exists for the given IDs.
     *
     * @param \Illuminate\Database\Eloquent\Relations\BelongsToMany $relation
     * @param array $ids
     *
     * @return bool
     */
    protected function relationExists(BelongsToMany $relation, array $ids): bool
    {
        return $relation->wherePivotIn('id', $ids)->exists();
    }
    
}