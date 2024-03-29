<?php

declare(strict_types=1);

namespace Domains\TauxAndSalaries\DataTransfertObjects;

use App\Models\TauxAndSalary;
use Core\Utils\DataTransfertObjects\BaseDTO;

/**
 * Class ***`UpdateTauxAndSalaryDTO`***
 *
 * This class extends the ***`BaseDTO`*** class.
 * It represents the data transfer object for updating a new ***`TauxAndSalary`*** model.
 *
 * @package ***`\Domains\TauxAndSalaries\DataTransfertObjects`***
 */
class UpdateTauxAndSalaryDTO extends BaseDTO
{

    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Get the class name of the model associated with the DTO.
     *
     * @return string The class name of the model.
     */
    protected function getModelClass(): string
    {
        return TauxAndSalary::class;
    }

    /**
     * Get the validation rules for the DTO object.
     *
     * @return array The validation rules.
     */
    public function rules(array $rules = []): array
    {
        $rules = array_merge([
            "taux"                      => ["required", "array"],
            "taux.*"                    => ["distinct", "array", "min:2"],
            "taux.*.taux_id"            => ["required", "uuid", "exists:taux_and_salaries,id"],
            "taux.*.rate"               => ["sometimes", "numeric", "regex:/^\d+(\.\d{1,2})?$/"],
            "taux.*.hint"               => ["sometimes", "numeric", "regex:/^\d+(\.\d{1,2})?$/"],
            "taux.*.unite_mesure_id"    => ["sometimes", "uuid", "exists:unite_mesures,id"],
            'taux.*.can_be_deleted'     => ['nullable', 'boolean', 'in:'.true.','.false]
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