<?php

return [

  /*
    |--------------------------------------------------------------------------
    | View Storage Paths
    |--------------------------------------------------------------------------
    |
    | Kebanyakan sistem templating memuat template dari disk. Di sini kamu
    | dapat menentukan array path yang akan diperiksa untuk file view.
    | Secara default, path resource/views sudah terdaftar.
    |
    */

  'paths' => [
    resource_path('views'),
  ],

  /*
    |--------------------------------------------------------------------------
    | Compiled View Path
    |--------------------------------------------------------------------------
    |
    | Opsi ini menentukan lokasi penyimpanan file hasil kompilasi Blade.
    | Secara default, file-file hasil kompilasi akan disimpan di:
    | storage/framework/views.
    |
    | Kamu dapat mengubah path ini sesuai kebutuhan. Pastikan folder yang
    | dituju ada dan memiliki permission yang benar.
    |
    */

  'compiled' => env(
    'VIEW_COMPILED_PATH',
    realpath(storage_path('framework/views'))
  ),

];
