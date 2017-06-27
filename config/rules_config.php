<?php

return
[
	'<action:(index|create|test)>/?'=>'site/<action>',
    ['pattern'=>'<controller:[\w-_]+>/<action:[\w-_]+>/?',     'route'=>'<controller>/<action>' ,   'name'=>'r1', 
	                                                           'defaults'=>['controller'=>'site',   'action'=>'index'], 
															                                        'name'=>'r4'], 
	['pattern'=>'<controller>/<action:(index|create|test)/?>', 'route'=>'<controller>/<action>',    'name'=>'r0',],
    ['pattern'=>'site/<action:[\w-_]+>/?',                     'route'=>'site/<action>',            'name'=>'r1',],
    ['pattern'=>'post/<action:[\w-_]+>/?',                     'route'=>'post/<action>',            'name'=>'r2',],
    ['pattern'=>'/?',                                          'route'=>'post/index',               'name'=>'r5',],

];



