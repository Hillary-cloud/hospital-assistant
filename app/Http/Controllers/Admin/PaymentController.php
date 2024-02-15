<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Payment;
use App\Models\Consultation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Unicodeveloper\Paystack\Paystack;
use App\Notifications\AdCreatedNotification;

class PaymentController extends Controller
{

    public function showPaymentPage($id)
    {
        $consultation = Consultation::where('id', $id)->firstOrFail();
        // Pass the advert data to the payment page view
        return view('payment-page', compact('consultation'));
    }

    protected $paystack;

    public function __construct(Paystack $paystack)
    {
        $this->paystack = $paystack;
    }


    public function redirectToGateway($id)
    {
        try {

            $consultations = Consultation::where('id', $id)->firstOrFail();
            $email = auth()->user()->email;
            $name = auth()->user()->name;
            // Replace this with your desired payment amount and other details
            // $amountInNaira = 100000;
            // $amountInKobo = $amountInNaira * 100; // Convert Naira to Kobo

            
              
                $paymentData = [
                    'amount' => 100000, // Amount in kobo
                    'email' => $email,
                    'metadata' => [
                        'custom_fields' => [
                            ['display_name' => "Payment For", 'variable_name' => "payment_for", 'value' => "Consultation"],
                            ['display_name' => "Customer Name", 'variable_name' => "customer_name", 'value' => $name],
                            ['display_name' => "Ad ID", 'variable_name' => "consultation_id", 'value' => $id],
                        ]
                    ]
                ];

            // Generate the callback URL with the UUID included
            $callbackUrl = URL::route('payment.callback', ['id' => $id]);

            // Append the callback URL to the payment data
            $paymentData['callback_url'] = $callbackUrl;

            return $this->paystack->getAuthorizationUrl($paymentData)->redirectNow();
        } catch (\Exception $e) {
            // Handle the exception and return an error response
            $errorMessage = 'Payment redirection failed. Please try again later.';
            return view('admin.consultations.index', compact('errorMessage', 'consultations'));
        }
    }

    public function handleGatewayCallback($id)
    {
        try {
            
            $paymentDetails = $this->paystack->getPaymentData();

            $status = $paymentDetails['data']['status'];
            $metadata = $paymentDetails['data']['metadata'];

            // Extract custom fields from metadata
            $paymentFor = null;
            foreach ($metadata['custom_fields'] as $customField) {
                if ($customField['variable_name'] === 'payment_for') {
                    $paymentFor = $customField['value'];
                    break;
                }
            }
            // dd($paymentDetails);

            // Process payment details and update your database accordingly
            // For example, you can check if the payment was successful and update the user's order status.
            if ($status === 'success') {
                $consultation = Consultation::where('id', $id)->firstOrFail();
                // $consultation->update(['expiration_date' => $expirationDate, 'list_date' => now(), 'notification_sent' => false, 'draft' => false, 'active' => true]);

                // Create a new payment record and associate it with the authenticated user and advert
                Payment::create([
                    'reference_number' => $paymentDetails['data']['reference'],
                    'amount' => $paymentDetails['data']['amount'] / 100, // Assuming the amount is in kobo and needs to be converted to naira
                    'payment_for' => $paymentFor,
                    'user_id' => auth()->user()->id,
                    'consultation_id' => $consultation->id, // Associate with the advert
                ]);
            }

            // Dispatch the AdCreatedNotification
            $user = Auth::user(); // Get the user who created the ad
            // $advert->user->notify(new AdCreatedNotification($advert));

            return redirect()->back()->with('message', 'Payment successful.'); // Redirect to a success page
        } catch (\Exception $e) {
            // Handle the exception and return an error response
            $errorMessage = 'Payment failed. Please try again later.';
            return redirect()->route('consultations.index', compact('errorMessage'));
        }
    }

    public function showTransactionHistoryPage()
    {
        $payments = Payment::all();

        return view('admin.payment-history', compact('payments'));
    }

    public function showMyTransactionHistoryPage()
    {
        $payments = Payment::where('user_id', auth()->user()->id)->get();

        return view('admin.payment-history', compact('payments'));
    }
}
