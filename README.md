# 🧙‍♂️ DungeonMaster

Gerador de personagens RPG desenvolvido em PHP com arquitetura MVC, sem uso de frameworks.

## 🚀 Funcionalidades

- 🎲 Geração aleatória de personagens
- 🧬 Raça, sub-raça, classe e gênero dinâmicos
- 📊 Atributos com distribuição baseada em regras
- ✨ Sistema de "Easter Egg" para personagens especiais
- 📈 Barras visuais animadas para atributos
- 🎨 Interface moderna com CSS

## 🧱 Estrutura do Projeto

```
DungeonMaster/
├─ app/
│  ├─ Controller/
│  ├─ Model/
│  ├─ View/
│  └─ Core/
├─ public/
│  ├─ css/
│  ├─ js/
│  └─ index.php
├─ routes/
│  └─ web.php
├─ resources/
│  └─ functions/
├─ vendor/
├─ composer.json
```

## ⚙️ Requisitos

- PHP 8+
- Composer
- Laragon (ou outro servidor local)

## 🔧 Instalação

```bash
git clone https://github.com/seu-usuario/dungeonmaster.git
cd dungeonmaster
composer install
```

## ▶️ Execução

```bash
php -S localhost:8000 -t public
```

Ou via Laragon:

http://dungeonmaster.test

## 🧠 Arquitetura

```
URL → Router → Controller → Model → View
```

## ✨ Exemplo

```
Nome: Arannis
Raça: Elfo
Classe: Mago

Força        ███████░░░
Destreza     ██████████
Inteligência ████████████
```

## 👨‍💻 Autor

Luiz Junior
