<?php

spl_autoload_register(
        function ($className) {
            $baseDir = DIR_APP . DS;
            require $baseDir . str_replace('\\', DS, $className) . '.php';
        });