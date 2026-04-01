<?php

namespace App\Controller;

use App\Model\Randomizer;

class HomeController
{
    public function home(): void
    {
        view('home', [
            'title' => 'Dungeon Master',
            'data' => 'Ola, seja bem-vindo ao Dungeon Master, um gerador de personagens aleatórios para jogos de RPG.'
        ]);
    }
}