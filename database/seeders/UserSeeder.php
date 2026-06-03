<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\PurchaseRequest;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::create([
            'name'              => 'Admin User',
            'email'             => 'admin@test.com',
            'password'          => Hash::make('password123'),
            'email_verified_at' => now(),
        ]);

        PurchaseRequest::create([
            'pr_no'        => 'PR-2024-001',
            'title'        => 'Office Supplies Purchase',
            'description'  => 'Requesting purchase of office supplies including pens, paper, staplers, and folders for Q1 2024 team use.',
            'status'       => 'Pending',
            'requested_by' => $user->id,
        ]);

        PurchaseRequest::create([
            'pr_no'        => 'PR-2024-002',
            'title'        => 'Laptop for New Developer',
            'description'  => 'New developer joining next month requires a laptop. Recommended: Dell Inspiron 15, 16GB RAM, 512GB SSD, Intel i7.',
            'status'       => 'Approved',
            'requested_by' => $user->id,
        ]);

        PurchaseRequest::create([
            'pr_no'        => 'PR-2024-003',
            'title'        => 'Ergonomic Standing Desk',
            'description'  => 'Requesting a height-adjustable standing desk for the design team to improve ergonomics and reduce back strain.',
            'status'       => 'Rejected',
            'requested_by' => $user->id,
        ]);

        PurchaseRequest::create([
            'pr_no'        => 'PR-2024-004',
            'title'        => 'Adobe Creative Cloud License Renewal',
            'description'  => 'Annual renewal for Adobe Creative Cloud licenses for 3 graphic designers. Current licenses expire 30th June 2024.',
            'status'       => 'Pending',
            'requested_by' => $user->id,
        ]);

        PurchaseRequest::create([
            'pr_no'        => 'PR-2024-005',
            'title'        => 'Conference Room Projector Replacement',
            'description'  => 'Current projector is 8 years old and frequently malfunctions. Recommended: Epson EB-X49 XGA Projector.',
            'status'       => 'Approved',
            'requested_by' => $user->id,
        ]);
    }
}