<?php

namespace App\Rules;
use Illuminate\Support\Facades\DB;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class EnseignantCoursValide implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
    }
    public function passes($attribute, $value)
{
    return DB::table('cours_classe')
           ->where('id_cours', $value)
           ->where('id_classe', request()->id_classe)
           ->where('id_enseignant', auth('enseignant')->id())
           ->exists();
}

public function message()
{
    return 'Vous n\'enseignez pas ce cours dans la classe sélectionnée.';
}
}
