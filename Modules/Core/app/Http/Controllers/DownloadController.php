<?php

namespace Modules\Core\Http\Controllers;

use App\Http\Controllers\Controller;
use Devrabiul\ToastMagic\Facades\ToastMagic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Modules\Core\Http\Requests\DownloadRequest;

class DownloadController extends Controller
{
    /**
     * Handle the incoming download request.
     */
    public function __invoke(DownloadRequest $request)
    {
        $path = $request->validated()['url'] ?? null;

        if (!$path) {
            ToastMagic::error('انجام نشد', 'مسیر فایل معتبر نیست');
            return back();
        }

        $path = ltrim($path, '/');

        try {
            if (Storage::disk('public')->exists($path)) {
                return Storage::disk('public')->download($path);
            }

            ToastMagic::error('انجام نشد', 'فایل مورد نظر یافت نشد');
            Log::warning("Download failed, file not found: {$path}");
            return back();

        } catch (\Exception $e) {
            Log::error('Download error: ' . $e->getMessage(), ['path' => $path]);
            ToastMagic::error('انجام نشد', 'مشکلی در فرآیند بارگیری پیش آمد');
            return back();
        }
    }

}
