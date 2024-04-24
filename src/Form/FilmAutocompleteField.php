<?php

namespace App\Form;

use App\Entity\Film;
use App\Repository\FilmRepository;
use App\Service\Manager\FilmManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\Autocomplete\Form\AsEntityAutocompleteField;
use Symfony\UX\Autocomplete\Form\BaseEntityAutocompleteType;

#[AsEntityAutocompleteField]
class FilmAutocompleteField extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'class' => Film::class,
            'placeholder' => 'Choose a Film',
            'choice_label' => 'title'
        ]); 
    }

    public function getParent(): string
    {
        return BaseEntityAutocompleteType::class;
    }
}
