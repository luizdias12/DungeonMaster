<?php

function dd($value){
    echo "<pre>";
    print_r(json_encode($value));
    echo "</pre>";
    exit;
}

function dumper($array) {
    echo "<pre>";
    print_r(json_encode($array));
    echo "</pre>";
}

function handleRaceScore($modifiers, $attributes) {

    // echo "atributos de entrada: <br>";
    // dumper($attributes);
    // dumper($modifiers);

    foreach ($modifiers as $modifier) {
        $abilityName = $modifier["ability_name"];
        $value = $modifier["value"];
        $action = $modifier["action"];
    
        // Check if the action is "soma" (addition) based on action being 0
        if ($action == 0) {  // Assuming 0 means addition (soma)
            // Check if the ability exists in the attributes
            if (isset($attributes[$abilityName])) {
                // echo "$abilityName - $attributes[$abilityName]<br>";
                $attributes[$abilityName] += $value;  // Add the value to the attribute
                // echo "$abilityName - $attributes[$abilityName]<br>";
            }
        }

        if ($action == 1) {
            if (isset($attributes[$abilityName])) {
                $attributes[$abilityName] -= $value;  // Subtract the value to the attribute
            }
        }
    }

    return $attributes;
}