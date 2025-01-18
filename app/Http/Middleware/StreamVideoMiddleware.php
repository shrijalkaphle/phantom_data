<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\StreamedResponse;

class StreamVideoMiddleware
{
    public function handle($request, Closure $next)
    {
        $filePath = storage_path('app/public/videos/' . $request->get('video'));
        //dd($filePath);
        if (!file_exists($filePath)) {
            return response()->json(['error' => 'File not found'], 404);
        }

        $size = filesize($filePath);
        $start = 0;
        $length = $size;

        // Handle Range Header
        $headers = [];
        if ($range = $request->header('Range')) {
            $range = str_replace('bytes=', '', $range);
            [$start, $end] = explode('-', $range);
            $end = $end === '' ? $size - 1 : $end;
            $length = $end - $start + 1;
            $headers['Content-Range'] = "bytes $start-$end/$size";
            $headers['Content-Length'] = $length;
        }

        $response = new StreamedResponse(function () use ($filePath, $start, $length) {
            $handle = fopen($filePath, 'rb');
            fseek($handle, $start);
            echo fread($handle, $length);
            fclose($handle);
        }, 206, $headers);

        $response->headers->set('Content-Type', 'video/mp4');
        $response->headers->set('Accept-Ranges', 'bytes');

        return $response;
    }
}
