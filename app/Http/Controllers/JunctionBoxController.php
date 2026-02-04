<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJunctionBoxRequest;
use App\Services\ServiceRequestService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class JunctionBoxController extends Controller
{
    use ApiResponse;

    protected $service;

    public function __construct(ServiceRequestService $service)
    {
        $this->service = $service;
    }

    public function create()
    {
        return view('service.form', ['type' => 'junction_box']);
    }

    public function store(StoreJunctionBoxRequest $request)
    {
        $this->setResponseStartTime();

        try {
            $serviceRequest = $this->service->createServiceRequest(
                $request->validated(),
                $request->allFiles(),
                'junction_box'
            );

            if ($request->ajax()) {
                return $this->successResponse(
                    ['redirect' => route('service.thankyou', ['request_id' => $serviceRequest->request_id])],
                    'Service request submitted successfully! We will contact you soon.'
                );
            }

            return redirect()->route('service.thankyou', ['request_id' => $serviceRequest->request_id])->with('success', 'Service request submitted successfully! We will contact you soon.');

        } catch (\Exception $e) {
            if ($request->ajax()) {
                return $this->errorResponse($e->getMessage(), 500);
            }
            return back()->with('error', 'An error occurred. Please try again.')->withInput();
        }
    }
}
