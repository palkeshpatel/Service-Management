<?php

namespace App\Http\Controllers;

use App\Models\ServiceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function index()
    {
        return view('service.index');
    }

    public function showForm($type)
    {
        $validTypes = ['panel_damage', 'junction_box', 'hotspot'];
        
        if (!in_array($type, $validTypes)) {
            abort(404);
        }

        return view('service.form', compact('type'));
    }

    public function thankYou(Request $request)
    {
        $requestId = $request->query('request_id');
        return view('service.thankyou', compact('requestId'));
    }

    public function store(Request $request)
    {
        $type = $request->input('service_type');
        $validTypes = ['panel_damage', 'junction_box', 'hotspot'];
        
        if (!in_array($type, $validTypes)) {
            return back()->withErrors(['service_type' => 'Invalid service type'])->withInput();
        }

        $rules = $this->getValidationRules($type);
        
        try {
            $validated = $request->validate($rules);
        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $e->errors()
                ], 422);
            }
            throw $e;
        }

        // Handle file uploads
        $attachments = [];
        
        foreach ($this->getAttachmentFields($type) as $field => $config) {
            if ($request->hasFile($field)) {
                $files = $request->file($field);
                
                // Handle array of files (multiple uploads)
                if (is_array($files)) {
                    $attachments[$field] = [];
                    foreach ($files as $file) {
                        $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
                        $path = $file->storeAs('service_attachments/' . $type, $filename, 'public');
                        $attachments[$field][] = [
                            'path' => $path,
                            'original_name' => $file->getClientOriginalName(),
                            'type' => $config['type'],
                        ];
                    }
                } else {
                    // Handle single file
                    $filename = Str::random(20) . '.' . $files->getClientOriginalExtension();
                    $path = $files->storeAs('service_attachments/' . $type, $filename, 'public');
                    $attachments[$field] = [
                        'path' => $path,
                        'original_name' => $files->getClientOriginalName(),
                        'type' => $config['type'],
                    ];
                }
            }
        }

        $serviceRequest = ServiceRequest::create([
            'service_type' => $type,
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'city' => $validated['city'],
            'delivery_date' => $validated['delivery_date'],
            'invoice_no' => $validated['invoice_no'],
            'serial_number' => $validated['serial_number'],
            'attachments' => $attachments,
            'status' => 'pending',
        ]);

        // Return JSON response for AJAX requests
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Service request submitted successfully! We will contact you soon.',
                'redirect' => route('service.thankyou')
            ]);
        }

        return redirect()->route('service.thankyou')->with('success', 'Service request submitted successfully! We will contact you soon.');
    }

    public function adminIndex(Request $request)
    {
        $query = ServiceRequest::orderBy('created_at', 'desc');
        
        if ($request->has('service_type') && $request->service_type) {
            $query->where('service_type', $request->service_type);
        }
        
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }
        
        $requests = $query->paginate(20)->withQueryString();
        return view('admin.requests.index', compact('requests'));
    }

    public function adminShow($id)
    {
        $request = ServiceRequest::findOrFail($id);
        return view('admin.requests.show', compact('request'));
    }

    public function adminUpdate(Request $request, $id)
    {
        $serviceRequest = ServiceRequest::findOrFail($id);
        
        $serviceRequest->update([
            'status' => $request->input('status'),
            'admin_notes' => $request->input('admin_notes'),
        ]);

        return redirect()->route('admin.requests.show', $id)->with('success', 'Request updated successfully');
    }

    private function getValidationRules($type)
    {
        $baseRules = [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'city' => 'required|string|max:255',
            'delivery_date' => 'required|date|date_format:Y-m-d',
            'invoice_no' => 'required|string|max:255',
        ];

        if ($type === 'panel_damage') {
            $baseRules['serial_number'] = 'required|string|max:255';
            $baseRules['loading_video'] = 'required|file|mimes:mp4,avi,mov,wmv|max:10240';
            $baseRules['pallet_images'] = 'required|array|min:4|max:4';
            $baseRules['pallet_images.*'] = 'required|image|mimes:jpeg,jpg,png|max:5120';
            $baseRules['damage_photos'] = 'required|array|min:2|max:10';
            $baseRules['damage_photos.*'] = 'required|image|mimes:jpeg,jpg,png|max:5120';
            $baseRules['pallet_id_slip'] = 'required|image|mimes:jpeg,jpg,png|max:5120';
            $baseRules['lr_copy'] = 'required|image|mimes:jpeg,jpg,png|max:5120';
            $baseRules['pallet_position'] = 'nullable|image|mimes:jpeg,jpg,png|max:5120';
        } elseif ($type === 'junction_box') {
            $baseRules['serial_number'] = 'required|string|max:255';
            $baseRules['voltage_video'] = 'required|file|mimes:mp4,avi,mov,wmv|max:10240';
            $baseRules['junction_box_photo'] = 'required|image|mimes:jpeg,jpg,png|max:5120';
            $baseRules['voltage_power'] = 'required|image|mimes:jpeg,jpg,png|max:5120';
            $baseRules['site_photograph'] = 'required|image|mimes:jpeg,jpg,png|max:5120';
        } elseif ($type === 'hotspot') {
            $baseRules['serial_number'] = 'required|string|max:255';
            $baseRules['loading_video'] = 'required|file|mimes:mp4,avi,mov,wmv|max:10240';
            $baseRules['damage_photos'] = 'required|array|min:2|max:10';
            $baseRules['damage_photos.*'] = 'required|image|mimes:jpeg,jpg,png|max:5120';
            $baseRules['pallet_id_slip'] = 'required|image|mimes:jpeg,jpg,png|max:5120';
            $baseRules['installation_site'] = 'required|image|mimes:jpeg,jpg,png|max:5120';
            $baseRules['issue_photos'] = 'required|array|min:2|max:10';
            $baseRules['issue_photos.*'] = 'required|image|mimes:jpeg,jpg,png|max:5120';
        }

        return $baseRules;
    }

    private function getAttachmentFields($type)
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
