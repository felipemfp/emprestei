<?php

return array(


    'pdf' => array(
        'enabled' => true,
        'binary'  => '/usr/bin/wkhtmltopdfx',
        'timeout' => false,
        'options' => array(),
        'env'     => array(),
    ),
    'image' => array(
        'enabled' => false,
        'binary'  => '/usr/local/bin/wkhtmltoimage',
        'timeout' => false,
        'options' => array(),
        'env'     => array(),
    ),


);
