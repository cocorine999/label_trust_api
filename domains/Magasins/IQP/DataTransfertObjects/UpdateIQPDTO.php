<?php

declare(strict_types=1);

namespace Domains\Magasins\IQP\DataTransfertObjects;

use App\Models\Magasins\IQP;
use Core\Utils\DataTransfertObjects\BaseDTO;
use Core\Utils\Enums\TypeIQPEnum;
use Core\Utils\Enums\TypeOfIQPEnum;
use Illuminate\Validation\Rules\Enum;

/**
 * Class ***`UpdateIQPDTO`***
 *
 * This class extends the ***`BaseDTO`*** class.
 * It represents the data transfer object for updating a new ***`IQP`*** model.
 *
 * @package ***`\Domains\Magasins\IQP\DataTransfertObjects`***
 */
class UpdateIQPDTO extends BaseDTO
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
        return IQP::class;
    }

    /**
     * Get the validation rules for the DTO object.
     *
     * @return array The validation rules.
     */
    public function rules(array $rules = []): array
    {
        $rules = array_merge([
            "name"            		        => ["string", "sometimes", 'unique:iqps,name'],
            "type_of_iqp"                   => ["sometimes", "string", new Enum(TypeIQPEnum::class)],
            "iqp_type"                      => ["sometimes", "string", new Enum(TypeOfIQPEnum::class)],
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