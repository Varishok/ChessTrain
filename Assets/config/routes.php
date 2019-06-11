<?php
return array(

    'userreg' => 'user/registered',
    'userlog' => 'user/login',
    
    'turn/turn' => 'turn/turn',
    'turn/add' => 'turn/add',
    'turn/check' => 'turn/check',
    'turn' => 'turn',

    'puzzle/puzzle' => 'puzzle/puzzle',
    'puzzle/add' => 'puzzle/add',
    'puzzle/check' => 'puzzle/check',
    'puzzle/[0-9]*' => 'puzzle/id/$0',
    'puzzle' => 'puzzle',

    'checkmate/checkmate' => 'checkmate/checkmate',
    'checkmate/add' => 'checkmate/add',
    'checkmate/check' => 'checkmate/check',
    'checkmate/[0-9]*' => 'checkmate/id/$0',
    'checkmate' => 'checkmate',

    'game/game' => 'game/game',
    'game/add' => 'game/add',
    'game/board' => 'game/board',
    'game/[0-9]*' => 'game/id/$0',
    'game' => 'game',

    'debut/debut' => 'debut/debut',
    'debut/add' => 'debut/add',
    'debut/board' => 'debut/board',
    'debut/[0-9]*' => 'debut/id/$0',
    'debut' => 'debut',

    'literature/literature' => 'literature/literature',
    'literature/favorit' => 'literature/favorit',
    'literature/add' => 'literature/add',
    'literature' => 'literature',

    'hint/add' => 'hint/add',
    'hint' => 'hint',

    'logout' => 'index/logout',
    'registered' => 'index/registered',
    'login' => 'index/login',
    '' => 'index'
);