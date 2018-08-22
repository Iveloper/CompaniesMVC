<?php

return $router->defineRoutes(
                [
                    'auth' => [
                        'companylist' => 'CompanyController@companylist',
                        'companyadd' => 'CompanyController@companyadd',
                        'companyedit' => 'CompanyController@companyedit',
                        'companysave' => 'CompanyController@companysave',
                        'companydelete' => 'CompanyController@companydelete',
                        'companyperson' => 'CompanyController@companyperson',
                        'companyrecord' => 'CompanyController@companyrecord',
                        'displayperson' => 'CompanyController@displayperson',
                        
                        'personlist' => 'PersonController@personlist',
                        'personadd' => 'PersonController@personadd',
                        'personedit' => 'PersonController@personedit',
                        'personsave' => 'PersonController@personsave',
                        'persondelete' => 'PersonController@persondelete',
                        'personrecord' => 'PersonController@personrecord',
                        
                        'useradd' => 'UserController@useradd',
                        'usersave' => 'UserController@usersave',
                        'userlist' => 'UserController@userlist',
                        'useredit' => 'UserController@useredit',
                        'userdelete' => 'UserController@userdelete',
                        'userrecord' => 'UserController@userrecord',
                        'useractivate' => 'UserController@useractivate',
                        'avatarupload' => 'UserController@avatarupload',
                        'getAvatar' => 'UserController@getAvatar',
                        
                        'logout' => 'AuthController@logout'
                    ],
                    'guest' => [
                        'login' => 'AuthController@login'
                    ]
                ]
);

