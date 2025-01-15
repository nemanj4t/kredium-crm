<?php

namespace App\Http\Controllers;

abstract class Controller
{
    protected const DEFAULT_ERROR_MESSAGE = 'Whoops, something went wrong!';

    protected function successMessage(string $beautifulPart): string
    {
        return "Congrats! You have successfully $beautifulPart!";
    }
}
