<?php

declare(strict_types=1);

namespace App\TypingImprovement\Users\Http\Controllers;

use App\TypingImprovement\Users\Actions\ChangePassword;
use App\TypingImprovement\Users\Actions\UpdateGeneralInformation;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Throwable;

class UsersController
{
    public function changePassword(ChangePassword $changer): Response|JsonResponse
    {
        $input = request()->all() ?? [];
        try {
            $changer->change($input);
            return response()->noContent();
        } catch (ValidationException $exception) {
            return response()->json(["message" => "Validation Error", "errors" => $exception->errors()], 417);
        } catch (Throwable $exception) {
            return response()->json(["message" => $exception->getMessage()], 500);
        }
    }

    public function changeGeneralInfo(UpdateGeneralInformation $updater): Response|JsonResponse
    {
        $input = request()->all() ?? [];
        try {
            $updater->update($input);
            return response()->noContent();
        } catch (ValidationException $exception) {
            return response()->json(["message" => "Validation Error", "errors" => $exception->errors()], 417);
        } catch (Throwable $exception) {
            return response()->json(["message" => $exception->getMessage()], 500);
        }
    }
}
