<?php

return array(

    'pdf' => array(
        'enabled' => true,
        // 'binary' => base_path('vendor\wemersonjanuario\wkhtmltopdf-windows\bin\64bit\wkhtmltopdf'),
        // 'binary' => base_path('vendor/h4cc/wkhtmltopdf-amd64/bin/wkhtmltopdf-amd64'),
        'binary' => '"C:\Program Files\wkhtmltopdf\bin\wkhtmltopdf"',
        'timeout' => false,
        'options' => array(
            'orientation' => 'portrait',
        ),
        'env' => array(),
    ),
    'image' => array(
        'enabled' => true,
        'binary' => '"C:\Program Files\wkhtmltopdf\bin\wkhtmltopdf"',
        'timeout' => false,
        'options' => array(),
        'env' => array(),
    ),

);
