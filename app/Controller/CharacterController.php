<?php

namespace App\Controller;

use App\Model\Randomizer;

class CharacterController
{
    public function random(): void
    {
        $character = Randomizer::randomChar();

        view('char', [
            'title' => 'Personagem aleatório',
            'character' => $character
        ]);
    }
}