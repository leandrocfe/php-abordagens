<?php

    require '../../../vendor/autoload.php';

    //whoops p/ exibição de erros
    $whoops = new \Whoops\Run;
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
    $whoops->register();

    //componente para valores aleatórios
    $faker = Faker\Factory::create();

    //tipos dos status e limites
    $badges = [
        'bronze' => range(0,3),
        'silver' => range(4,7),
        'gold' => range(8,10)
    ];

    //closure que recupera o status a partir do atributo stars
    $status = function($badges, $stars){

        //inicializando o status
        $badge_description = 'N/A';

        foreach ($badges as $key => $value) {
            
            //verificando o atributo stars de acordo com o array badges
            if(in_array($stars, $value)){

                //setando o badge key
                $badge_description = $key;
            }
        }

        return $badge_description;
    };

    $user = null;

    for($i=0; $i<$faker->randomDigit; $i++){

        //criando um objeto fake User
        $user[$i] = new stdClass();
        $user[$i]->uuid = $faker->uuid;
        $user[$i]->name = $faker->name;
        $user[$i]->email = $faker->email;
        $user[$i]->stars = $faker->randomDigit;

        //atribuindo o status com a closure
        $user[$i]->status = $status($badges, $user[$i]->stars);
    }

    echo json_encode($user);
?>