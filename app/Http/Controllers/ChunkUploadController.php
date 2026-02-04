<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Traits\ApiResponse;

class ChunkUploadController extends Controller
{
    use ApiResponse;

    /**
     * Handle chunk upload.
     */
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file',
            'chunk_index' => 'required|integer',
            'total_chunks' => 'required|integer',
            'file_uuid' => 'required|string',
            'file_name' => 'required|string',
        ]);

        $file = $request->file('file');
        $chunkIndex = $request->input('chunk_index');
        $totalChunks = $request->input('total_chunks');
        $fileUuid = $request->input('file_uuid');
        $fileName = $request->input('file_name');

        // Create a temporary directory for this upload
        $tempPath = 'temp_uploads/' . $fileUuid;
        
        // Store the chunk
        $chunkName = $chunkIndex . '_' . $fileName;
        $file->storeAs($tempPath, $chunkName, 'local');

        // Check if all chunks are uploaded
        if ($this->allChunksUploaded($tempPath, $totalChunks)) {
            $finalPath = $this->mergeChunks($tempPath, $fileName, $totalChunks);
            
            // Move to a more permanent temporary location accessible by public (if needed) or keep in storage
            // For now, we keep it in storage/app/temp_uploads and return the path
            // The main form submission will move it to the final destination
            
            return $this->successResponse([
                'path' => $finalPath,
                'uuid' => $fileUuid,
                'name' => $fileName,
                'completed' => true
            ], 'File upload completed');
        }

        return $this->successResponse([
            'chunk_index' => $chunkIndex,
            'completed' => false
        ], 'Chunk uploaded successfully');
    }

    /**
     * Check if all chunks are uploaded.
     */
    private function allChunksUploaded($tempPath, $totalChunks)
    {
        $files = Storage::disk('local')->files($tempPath);
        return count($files) >= $totalChunks;
    }

    /**
     * Merge chunks into a single file.
     */
    private function mergeChunks($tempPath, $fileName, $totalChunks)
    {
        $finalPath = 'temp_uploads/' . Str::random(40) . '_' . $fileName;
        
        // Create the final file
        Storage::disk('local')->put($finalPath, '');

        for ($i = 0; $i < $totalChunks; $i++) {
            $chunkPath = $tempPath . '/' . $i . '_' . $fileName;
            $chunkContent = Storage::disk('local')->get($chunkPath);
            
            Storage::disk('local')->append($finalPath, $chunkContent, null); // null separator to avoid newlines
            
            // Delete chunk
            Storage::disk('local')->delete($chunkPath);
        }
        
        // Delete temp directory
        Storage::disk('local')->deleteDirectory($tempPath);

        return $finalPath;
    }
}