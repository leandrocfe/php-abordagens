<?php

    require '../../../vendor/autoload.php';

    //whoops p/ exibição de erros
    $whoops = new \Whoops\Run;
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
    $whoops->register();

    //componente para valores aleatórios
    $faker = Faker\Factory::create();

    //tipos dos status
    $badges =[
        ['id' => 1, 'label' => 'bronze'],
        ['id' => 2, 'label' => 'silver'],
        ['id' => 3, 'label' => 'gold']
    ];

    //limites
    $ranges = [
        1 => ['min' => 0, 'max' => 3],
        2 => ['min' => 4, 'max' => 7],
        3 => ['min' => 8, 'max' => 10]
    ];

    //combinando o atributo range no array badges
    $badgeRanges = array_map(function($badge) use ($ranges) {

        //adicionando os valores do range para cada elemento do array
        $badge['range'] = $ranges[$badge['id']];

        return $badge;

    }, $badges);

    echo json_encode($badgeRanges);
?>