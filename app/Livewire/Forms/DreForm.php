<?php

namespace App\Livewire\Forms;

use App\Models\Dre;
use Livewire\Attributes\Validate;
use Livewire\Form;

class DreForm extends Form
{
    public ?Dre $dre;

    #[Validate('required', message: 'La oficina es obligatoria')]
    #[Validate('string')]
    #[Validate('max:255')]
    public $oficina;

    #[Validate('required', message: 'El responsable es obligatorio')]
    #[Validate('string')]
    #[Validate('max:255')]
    public $responsable;

    public function setDre(Dre $dre)
    {
        $this->dre = $dre;
        $this->oficina = $dre->oficina;
        $this->responsable = $dre->responsable;
    }

    public function store()
    {
        $this->validate();

        Dre::create([
            'oficina' => $this->oficina,
            'responsable' => $this->responsable,
        ]);
    }

    public function update()
    {
        $this->validate();

        $this->dre->update($this->all());
    }
}
