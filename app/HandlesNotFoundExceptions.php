<?php

namespace App;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Http;

trait HandlesNotFoundExceptions
{
    /**
     * Handle ModelNotFoundException and Exception in controller methods.
     *
     * @param callable $callable
     */
    protected function handleNotFoundException(callable $callable)
    {
        try {
            return $callable();
        } catch (ModelNotFoundException) {
            return response()->json([
                'message' => 'Car Not Found.',
            ], 404);
        } catch (Exception $e) {
            // Http::post(config('discord.webhook'), [
            //     'content' => "```\nError#{$e->getCode()}\n{$e->getMessage()}```",
            // ]);

            return response()->json([
                'message' => "Something went really wrong! jhbj",
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
