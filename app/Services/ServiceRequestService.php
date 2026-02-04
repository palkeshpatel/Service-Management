<?php

namespace App\Services;

use App\Models\ServiceRequest;
use App\Models\ErrorLog;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Exception;

class ServiceRequestService
{
    /**
     * Create a new service request.
     *
     * @param array $validatedData Validated form data
     * @param array $files Files from the request
     * @param string $type Service type
     * @return ServiceRequest
     * @throws Exception
     */
    public function createServiceRequest(array $validatedData, array $files, string $type)
    {
        try {
            $attachments = $this->handleUploads($files, $type);
            
            // Generate unique request ID
            $requestId = 'SR-' . date('Ymd') . '-' . mt_rand(1000, 9999);

            $serviceRequest = ServiceRequest::create([
                'request_id' => $requestId,
                'service_type' => $type,
                'name' => $validatedData['name'],
                'phone' => $validatedData['phone'],
                'email' => $validatedData['email'],
                'city' => $validatedData['city'],
                'delivery_date' => $validatedData['delivery_date'],
                'invoice_no' => $validatedData['invoice_no'],
                'serial_number' => $validatedData['serial_number'] ?? null,
                'attachments' => $attachments,
                'status' => 'pending',
            ]);

            return $serviceRequest;

        } catch (Exception $e) {
            // Log error to database
            ErrorLog::create([
                'action' => 'ServiceRequestService::createServiceRequest',
                'message' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
                'payload' => json_encode(['type' => $type, 'data' => $validatedData]),
            ]);

            throw $e;
        }
    }

    /**
     * Handle file uploads.
     *
     * @param array $files Files from request
     * @param string $type Service type
     * @return array
     */
    private function handleUploads(array $files, string $type): array
    {
        $attachments = [];
        $attachmentFields = $this->getAttachmentFields($type);

        foreach ($attachmentFields as $field => $config) {
            if (isset($files[$field])) {
                $uploadedFiles = $files[$field];
                
                // Handle array of files (multiple uploads)
                if (is_array($uploadedFiles)) {
                    $attachments[$field] = [];
                    foreach ($uploadedFiles as $file) {
                        $attachments[$field][] = $this->uploadFile($file, $type, $config['type']);
                    }
                } else {
                    // Handle single file
                    $attachments[$field] = $this->uploadFile($uploadedFiles, $type, $config['type']);
                }
            }
        }

        return $attachments;
    }

    /**
     * Upload a single file.
     */
    private function uploadFile($file, string $type, string $fileType)
    {
        $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('service_attachments/' . $type, $filename, 'public');
        
        return [
            'path' => $path,
            'original_name' => $file->getClientOriginalName(),
            'type' => $fileType,
        ];
    }

    /**
     * Get attachment configuration based on type.
     */
    public function getAttachmentFields($type)
    {
        if ($type === 'panel_damage') {
            return [
                'loading_video' => ['type' => 'video'],
                'pallet_images' => ['type' => 'image'],
                'damage_photos' => ['type' => 'image'],
                'pallet_id_slip' => ['type' => 'image'],
                'lr_copy' => ['type' => 'image'],
                'pallet_position' => ['type' => 'image'],
            ];
        } elseif ($type === 'junction_box') {
            return [
                'voltage_video' => ['type' => 'video'],
                'junction_box_photo' => ['type' => 'image'],
                'voltage_power' => ['type' => 'image'],
                'site_photograph' => ['type' => 'image'],
            ];
        } elseif ($type === 'hotspot') {
            return [
                'loading_video' => ['type' => 'video'],
                'damage_photos' => ['type' => 'image'],
                'pallet_id_slip' => ['type' => 'image'],
                'installation_site' => ['type' => 'image'],
                'issue_photos' => ['type' => 'image'],
            ];
        }

        return [];
    }
}
