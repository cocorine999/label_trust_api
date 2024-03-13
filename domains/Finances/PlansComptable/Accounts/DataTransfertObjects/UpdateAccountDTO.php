<?php

declare(strict_types=1);

namespace Domains\Finances\PlansComptable\Accounts\DataTransfertObjects;

use App\Models\Finances\Account;
use Core\Utils\DataTransfertObjects\BaseDTO;
use Domains\Finances\PlansComptable\SubAccounts\DataTransfertObjects\UpdateSubAccountDTO;

/**
 * Class ***`UpdateAccountDTO`***
 *
 * This class extends the ***`BaseDTO`*** class.
 * It represents the data transfer object for updating a new ***`Account`*** model.
 *
 * @package ***`\Domains\Finances\PlansComptable\Accounts\DataTransfertObjects`***
 */
class UpdateAccountDTO extends BaseDTO
{

    public function __construct()
    {
        parent::__construct();

        $this->merge(new UpdateSubAccountDTO(), 'sub_accounts', ['array']);
    }
    
    /**
     * Get the class name of the model associated with the DTO.
     *
     * @return string The class name of the model.
     */
    protected function getModelClass(): string
    {
        return Account::class;
    }

    /**
     * Get the validation rules for the DTO object.
     *
     * @return array The validation rules.
     */
    public function rules(array $rules = []): array
    {
        $rules = array_merge([
            "account_id"            => ["required", "exists:plan_comptable_comptes,id"],
            "account_number"        => ["required", "string", "max:120", 'unique:plan_comptable_comptes,account_number,' . request()->route("account_id") . ',id'],
            "classe_id"             => ["required", "exists:classes,id"],
            "compte_id"             => ["required", "exists:comptes,id"],
            'can_be_deleted'        => ['sometimes', 'boolean', 'in:'.true.','.false],
        ], $rules);

        return $this->rules = parent::rules($rules);
    }

    /**
     * Get the validation error messages for the DTO object.
     *
     * @return array The validation error messages.
     */
    public function messages(array $messages = []): array
    {
        $default_messages = array_merge([
            'can_be_delete.boolean' => 'Le champ can_be_delete doit être un booléen.',
            'can_be_delete.in'      => 'Le can_be_delete doit être "true" ou "false".'
        ], $messages);

        $messages = array_merge([], $default_messages);

        return $this->messages = parent::messages($messages);
    }
}