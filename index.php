<?php
    require_once __DIR__ . '/vendor/autoload.php';
    use BBTrello\Core\Trello;
    $key = "";
    $token= "";
    $trello = new Trello($key, $token);


    //$boards = $trelo->get("boards/------");
    // $lists =  $trelo->getListsFromBoard("------");
    //$members = $trelo->inviteMemberInBoard("a4YgEJ9D", ['email' =>  '', 'fullName' => 'Carlos Mateus Carvalho']);
    //$a = $trelo->addListsInBoard("----", ["name" => "OK, vamos la"]);
    //$a = $trelo->updateListsInBoard("", ['closed' => true]);
    //cards
    //$texto = "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto at atque autem consectetur cum debitis delectus deleniti doloremque eius eum ex facere fugit harum impedit iste magnam, maxime modi nobis odit omnis pariatur quo repellat rerum sint unde vero vitae voluptas. Accusamus ad asperiores aut autem blanditiis, commodi excepturi fuga iste, maxime molestiae necessitatibus nostrum quisquam quod sequi ullam vel voluptates? Ad consectetur facere, facilis illum laborum laudantium non officiis reiciendis sint suscipit voluptas voluptatem! Asperiores aut dolorem, hic laboriosam maiores natus nemo officiis quod voluptate voluptatem! Alias delectus, deleniti deserunt labore molestias quae. Consectetur dolore id illum labore qui.";
    //$a = $trelo->addCardInList("", ['name' => "Cobranca2" , 'desc' => $texto]);
    //$a = $trelo->getCardsFromList("");
    //$b = $trelo->updateCardInList("", ['name' => "ORA ORA ORA"]);
    //$c = $trelo->getAttachmentsFromCard("");
    //$trelo->removeAttachmentsInCard("", "");
    //$coments = $trelo->addCommentsInCard("", ['text' => "Ola mundo"]);
    //$d = $trelo->getCardFromList("");
    //$newList = $trelo->post("boards/----/lists", ["name" => "Teste Mais do PHP Create"]);

    //update a list
    //$updated = $trelo->put("lists/------", ['closed' => true]);

     //$newBoard = $trelo->addBoard(['name' => "From PHP", 'desc' => $texto]);



?>


