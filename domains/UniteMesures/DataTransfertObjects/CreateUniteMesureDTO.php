<?php

declare(strict_types=1);

namespace Domains\UniteMesures\DataTransfertObjects;

use App\Models\UniteMesure;
use Core\Utils\Rules\ExistsForAuthUserAndUUID;
use Core\Utils\DataTransfertObjects\BaseDTO;


/**
 * Class ***`CreateUniteMesureDTO`***
 *
 * This class extends the ***`BaseDTO`*** class.
 * It represents the data transfer object for creating a new ***`UniteMesure`*** model.
 *
 * @package ***`\Domains\UniteMesures\DataTransfertObjects`***
 */
class CreateUniteMesureDTO extends BaseDTO
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
        return UniteMesure::class;
    }

    /**
     * Get the validation rules for the DTO object.
     *
     * @return array The validation rules.
     */
    public function rules(array $rules = []): array
    {
        $rules = array_merge([
            "name"            		=> ["string", "required", 'unique:unite_mesures,name'],
            "symbol"                => ["required", "string", 'unique:unite_mesures,symbol'],
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
            'can_be_deleted.boolean' => 'Le champ can_be_deleted doit être un booléen.',
            'can_be_deleted.in'      => 'Le can_be_delete doit être "true" ou "false".'
        ], $messages);

        $messages = array_merge([], $default_messages);

        return $this->messages = parent::messages($messages);
    }
}