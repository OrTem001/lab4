<?php
$patterns = [
    
    
    'phone'=> [
        'regex' => '/^[0-9]{10}$/',
        'callback' => function ($matches) {            
            $string = $matches[0];

            return '+38' .$string;
        }
    ],

    'name' => [ 
        'regex' => '/^([A-Z]{1}[a-z]{1,23})$/' 
    ],
    
    'email' => [ 
        'regex' => '/^[a-z0-9_\-]+[@][a-z0-9_\-]+([.][a-z0-9_\-]+)+[a-z.]{2,4}$/'
    ]
    

    
];
