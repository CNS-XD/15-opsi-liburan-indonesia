<?php

namespace App\Http\Controllers\Frontsite;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GuideBookController extends Controller
{
    /**
     * Display the guide book page
     */
    public function index()
    {
        $data = [
            'steps' => [
                [
                    'number' => '01',
                    'title' => 'Browse & Filter Tours',
                    'description' => 'Explore our homepage and use the filter section to find your perfect adventure. Choose your departure city, trip duration, and destination to narrow down tour packages that match your travel dreams.',
                    'icon' => 'fas fa-search',
                    'image' => '/frontsite-assets/img/guide/step-1-mobile.svg'
                ],
                [
                    'number' => '02',
                    'title' => 'Review Tour Details',
                    'description' => 'Take your time to review the complete itinerary, inclusions, exclusions, and important details. Make sure this tour package is exactly what you\'re looking for before proceeding to book.',
                    'icon' => 'fas fa-list-check',
                    'image' => '/frontsite-assets/img/guide/step-2-mobile.svg'
                ],
                [
                    'number' => '03',
                    'title' => 'Fill Booking Form',
                    'description' => 'Complete the booking form with accurate personal information, travel dates, and special requests. Double-check all details to ensure a smooth reservation process.',
                    'icon' => 'fas fa-edit',
                    'image' => '/frontsite-assets/img/guide/step-3-mobile.svg'
                ],
                [
                    'number' => '04',
                    'title' => 'Choose Payment Method',
                    'description' => 'Select your preferred payment method from various secure options including Virtual Account, E-Wallet, QR Code, or Credit Card. All payments are processed securely through Xendit.',
                    'icon' => 'fas fa-credit-card',
                    'image' => '/frontsite-assets/img/guide/step-4-mobile.svg'
                ],
                [
                    'number' => '05',
                    'title' => 'Confirmation & Enjoy',
                    'description' => 'Once payment is completed, you\'ll receive a confirmation email with all booking details. Our team will contact you for final arrangements. Get ready for your amazing adventure!',
                    'icon' => 'fas fa-check-circle',
                    'image' => '/frontsite-assets/img/guide/step-5-mobile.svg'
                ]
            ]
        ];

        return view('pages.frontsite.guide-book.index', $data);
    }
}