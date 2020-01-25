# php-abordagens

Alguns conceitos e práticas da linguagem PHP para utilizar no dia a dia, com base nas abordagens do livro PHP Moderno - Josh Lockhart

## Instalação

Após clonar o projeto, execute o composer para instalar as dependências:

```bash
composer install
```

Para rodar o projeto usando o servidor interno do PHP, acesse a pasta do projeto no terminal e digite:

```bash
php -S localhost:4000
```
Acesse no browser http://localhost:4000

## Closures

Funções anônimas que podem ser usadas a partir da versão 5.3.0 do PHP. Estas funções podem ser atribuídas a variáveis e passadas por ai, como qualquer outro objeto PHP.

- [atributo.php](https://github.com/leandrocfe/php-abordagens/blob/master/app/exemplos/closures/atributo.php)

    Neste exemplo, um objeto closure é criado e atribuído para $status. A closure tem o mesmo comportamento de uma função, com argumentos e retorno de valor. Porém, sem nome:

```php
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
```

- [callback.php](https://github.com/leandrocfe/php-abordagens/blob/master/app/exemplos/closures/callback.php)

    As closures também podem ser passadas para outras funções PHP como argumentos, como qualquer outro valor. Neste exemplo a closure é utilizada como argumento do tipo callback, para modificar o objeto inicial e adicionar elementos:

```php
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
```