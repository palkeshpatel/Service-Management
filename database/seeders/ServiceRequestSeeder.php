<?php

namespace Database\Seeders;

use App\Models\ServiceRequest;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ServiceRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sampleRequests = [
            [
                'service_type' => 'panel_damage',
                'name' => 'Rajesh Kumar',
                'phone' => '9876543210',
                'email' => 'rajesh.kumar@example.com',
                'city' => 'Mumbai',
                'delivery_date' => now()->subDays(5),
                'invoice_no' => 'INV-2024-001',
                'serial_number' => 'SN-12345-001',
                'attachments' => [
                    'loading_video' => ['path' => 'sample/loading.mp4', 'original_name' => 'loading.mp4', 'type' => 'video'],
                    'pallet_images' => [
                        ['path' => 'sample/pallet1.jpg', 'original_name' => 'pallet1.jpg', 'type' => 'image'],
                        ['path' => 'sample/pallet2.jpg', 'original_name' => 'pallet2.jpg', 'type' => 'image'],
                    ],
                    'damage_photos' => [
                        ['path' => 'sample/damage1.jpg', 'original_name' => 'damage1.jpg', 'type' => 'image'],
                        ['path' => 'sample/damage2.jpg', 'original_name' => 'damage2.jpg', 'type' => 'image'],
                    ],
                ],
                'status' => 'pending',
            ],
            [
                'service_type' => 'junction_box',
                'name' => 'Priya Sharma',
                'phone' => '9876543211',
                'email' => 'priya.sharma@example.com',
                'city' => 'Delhi',
                'delivery_date' => now()->subDays(3),
                'invoice_no' => 'INV-2024-002',
                'serial_number' => 'SN-12345-002',
                'attachments' => [
                    'voltage_video' => ['path' => 'sample/voltage.mp4', 'original_name' => 'voltage.mp4', 'type' => 'video'],
                    'junction_box_photo' => ['path' => 'sample/junction.jpg', 'original_name' => 'junction.jpg', 'type' => 'image'],
                ],
                'status' => 'in_progress',
            ],
            [
                'service_type' => 'hotspot',
                'name' => 'Amit Patel',
                'phone' => '9876543212',
                'email' => 'amit.patel@example.com',
                'city' => 'Ahmedabad',
                'delivery_date' => now()->subDays(7),
                'invoice_no' => 'INV-2024-003',
                'serial_number' => 'SN-12345-003',
                'attachments' => [
                    'loading_video' => ['path' => 'sample/loading2.mp4', 'original_name' => 'loading2.mp4', 'type' => 'video'],
                    'damage_photos' => [
                        ['path' => 'sample/hotspot1.jpg', 'original_name' => 'hotspot1.jpg', 'type' => 'image'],
                    ],
                ],
                'status' => 'resolved',
                'admin_notes' => 'Issue resolved. Replacement panel sent to customer.',
            ],
            [
                'service_type' => 'panel_damage',
                'name' => 'Sneha Reddy',
                'phone' => '9876543213',
                'email' => 'sneha.reddy@example.com',
                'city' => 'Bangalore',
                'delivery_date' => now()->subDays(2),
                'invoice_no' => 'INV-2024-004',
                'serial_number' => 'SN-12345-004',
                'attachments' => [
                    'loading_video' => ['path' => 'sample/loading3.mp4', 'original_name' => 'loading3.mp4', 'type' => 'video'],
                    'pallet_images' => [
                        ['path' => 'sample/pallet3.jpg', 'original_name' => 'pallet3.jpg', 'type' => 'image'],
                    ],
                ],
                'status' => 'pending',
            ],
            [
                'service_type' => 'junction_box',
                'name' => 'Vikram Singh',
                'phone' => '9876543214',
                'email' => 'vikram.singh@example.com',
                'city' => 'Pune',
                'delivery_date' => now()->subDays(1),
                'invoice_no' => 'INV-2024-005',
                'serial_number' => 'SN-12345-005',
                'attachments' => [
                    'voltage_video' => ['path' => 'sample/voltage2.mp4', 'original_name' => 'voltage2.mp4', 'type' => 'video'],
                    'site_photograph' => ['path' => 'sample/site.jpg', 'original_name' => 'site.jpg', 'type' => 'image'],
                ],
                'status' => 'pending',
            ],
        ];

        foreach ($sampleRequests as $request) {
            ServiceRequest::create($request);
        }

        $this->command->info('Sample service requests created successfully!');
    }
}
