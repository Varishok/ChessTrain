<?php
return array(
    'registered' => 'user/registered',
    'login/userlogin' => 'user/login',
    'userlogin' => 'user/login',

    'groups/addgroup' => 'groups/addgroup',
    'addgroup' => 'groups/addgroup',
    'groups' => 'groups/groups',

    'group=([0-9]+)/addcontact' => 'contacts/addcontact',
    'addcontact' => 'contacts/addcontact',
    'group=([0-9]+)' => 'contacts/contacts/$1',

    'login' => 'index/login',
    'settings' => 'index/settings',
    '' => 'index'
);