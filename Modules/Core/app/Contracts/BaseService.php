<?php

namespace Modules\Core\app\Contracts;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Throwable;

abstract class BaseService
{
    protected function execute(
        callable $callback,
        string $errorMessage = 'Internal Server Error!',
        string $successMessage = 'Operation Completed Successfully!',
        bool $useTransaction = true,
    ): ServiceResponse {
        try {
            $result = $useTransaction
                ? DB::transaction($callback)
                : $callback();

            return ServiceResponse::success($result, $successMessage);
        } catch (ValidationException $e) {
            return ServiceResponse::error(
                $e->getMessage(),
                $e->validator->errors()->toArray()
            );
        } catch (Throwable $e) {

            Log::error($errorMessage, [
                'exception' => $e,
                'trace' => $e->getTraceAsString(),
                'user_id' => Auth::id() ?? null,
            ]);

            report($e);

            return ServiceResponse::error(
                $errorMessage,
                env('APP_DEBUG') ? $e->getMessage() : null,
            );
        }
    }
}
