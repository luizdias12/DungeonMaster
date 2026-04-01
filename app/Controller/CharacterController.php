<?php

namespace App\Controller;

use App\Model\Randomizer;

class CharacterController
{
    public function random(): void
    {
        $character = Randomizer::randomChar();

        view('character', [
            'title' => 'Personagem aleatório',
            'character' => $character
        ]);
    }
}