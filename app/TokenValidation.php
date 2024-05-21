<?php

namespace App;

use Illuminate\Http\Request;

trait TokenValidation
{
    /**
     * Validate Token in controller methods.
     *
     * @param callable $callable
     */
    protected function validateToken(Request $request, callable $callable)
    {
        $token = $request->header('Token');
        $visitor = models\Visitor::where('token', $token)->first();

        if (!$visitor) {
            return response()->json([
                'message' => "Unauthorized",
            ], 401);
        }

        return $callable($visitor);
    }
}
