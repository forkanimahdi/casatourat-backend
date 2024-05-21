<?php

namespace App;

use Exception;
use Illuminate\Support\Facades\Http;

trait HandlesExceptions
{
    /**
     * Handle exceptions in controller methods.
     *
     * @param callable $callable
     */
    protected function handleException(callable $callable)
    {
        try {
            return $callable();
        } catch (Exception $e) {
            // Http::post(config('discord.webhook'), [
            //     'content' => "```\nError#{$e->getCode()}\n{$e->getMessage()}```",
            // ]);

            return response()->json([
                'message' => "Something went really wrong!",
            ], 500);
        }
    }
}
