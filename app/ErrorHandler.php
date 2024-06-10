<?php

namespace App;

trait ErrorHandler
{
    /**
     * Handle exceptions in controller methods.
     *
     * @param callable $callable
     */
    protected function handleError(callable $callable)
    {
        try {
            return $callable();
        } catch (\Exception) {
            return view("error");
        }
    }
}
