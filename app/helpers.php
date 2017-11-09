<?php

use Illuminate\Http\Request;

function separar_autores($autores)
{
     $data = explode(";", $autores);
     return $data;

}
