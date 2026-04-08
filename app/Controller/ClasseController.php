<?php

namespace App\Controller;

use App\Core\BaseController;
use App\Core\Request;
use App\Model\Classe;

class ClasseController extends BaseController
{
    public function index(Request $request): array
    {
        $all = Classe::index();
        return $this->success($all);
    }

    public function show(Request $request, string $id): array
    {
        $classe = Classe::show($id);
        if (!$classe) {
            return $this->error('Classe não encontrada', 404);
        }
        return $this->success($classe);
    }
}