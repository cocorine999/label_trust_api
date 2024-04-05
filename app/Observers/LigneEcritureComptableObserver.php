<?php

namespace App\Observers;

use Core\Data\Eloquent\Contract\ModelContract;
use Core\Data\Eloquent\Observers\ModelContractObserver;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class LigneEcritureComptableObserver extends ModelContractObserver
{
    /**
     * Listen to the role creating event.
     *
     * Handle the Role "creating" event.
     *
     * @param ModelContract $model The model instance.
     * @return void
     */
    public function creating(ModelContract $model): void
    {
        parent::creating($model);
                
        if(!$model->ligneable->exercice_comptable_journal->exercice_comptable->plan_comptable->findAccountOrSubAccount($model->accountable->account_number)){
            throw new ModelNotFoundException('Veuillez preciser un numero de compte du plan comptable');
        }
    }
}
