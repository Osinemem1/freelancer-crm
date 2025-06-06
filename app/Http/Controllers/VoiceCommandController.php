<?php

namespace App\Http\Controllers;

use App\Models\VoiceCommand;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class VoiceCommandController extends Controller
{
    public function handle(Request $request)
    {
        $command = strtolower($request->input('command'));
        $response = ['message' => 'Command not recognized.', 'action' => null];

        // Remove polite filler words
        $normalized = str_replace(['go to', 'please', 'open', 'show me', 'see', 'with', 'and'], ' ', $command);

        if (str_contains($normalized, 'add customer') || str_contains($normalized, 'create customer') || str_contains($normalized, 'new customer')) {

            // Improved function to extract value after a keyword like 'name', 'email', 'phone'
            function extractValue($text, $keyword)
            {
                // Match keyword followed by optional 'is' or ':', then capture until next keyword or end of string
                $pattern = '/' . preg_quote($keyword) . '\s*(is|:)?\s*([^,]+?)(?=\s*(name|email|phone|$))/i';

                if (preg_match($pattern, $text, $matches)) {
                    return trim($matches[2]);
                }
                return '';
            }

            $name = extractValue($normalized, 'name');
            $email = extractValue($normalized, 'email');
            $phone = extractValue($normalized, 'phone');

            // Optional: clean phone number (only digits)
            $phone = preg_replace('/[^0-9]/', '', $phone);

            if ($name && $email && $phone) {
                try {
                    Customer::create([
                        'name' => $name,
                        'email' => $email,
                        'phone' => $phone,
                    ]);
                    $response = [
                        'message' => "Customer $name has been added successfully!",
                        'action' => 'customers'
                    ];
                } catch (\Exception $e) {
                    Log::error('Customer creation failed: ' . $e->getMessage());
                    $response = [
                        'message' => 'Oops! Something went wrong. Please try again.',
                        'action' => null
                    ];
                }
            } else {
                $missing = [];
                if (!$name) $missing[] = 'name';
                if (!$email) $missing[] = 'email';
                if (!$phone) $missing[] = 'phone';

                $response = [
                    'message' => 'Please provide ' . implode(', ', $missing) . ' in your command. Example: "Create customer, name John, email john@example.com, phone 1234567890".',
                    'action' => null
                ];
            }
        } elseif (str_contains($normalized, 'send invoice')) {
            $response = [
                'message' => 'Invoice action initiated.',
                'action' => '/admin/invoices/send'
            ];
        } elseif (str_contains($normalized, 'unpaid invoice')) {
            $response = [
                'message' => 'Showing unpaid invoices.',
                'action' => '/admin/invoices/unpaid'
            ];
        } elseif (str_contains($normalized, 'dashboard')) {
            $response = [
                'message' => 'Opening dashboard.',
                'action' => '/admin/dashboard'
            ];
        } elseif (str_contains($normalized, 'logout')) {
            $response = [
                'message' => 'Logging out...',
                'action' => '/logout'
            ];
        } elseif (str_contains($normalized, 'view customers')) {
            $response = [
                'message' => 'Opening customer list.',
                'action' => '/admin/customers'
            ];
        } elseif (str_contains($normalized, 'help')) {
            $response = [
                'message' => 'Try saying: "Add customer John email john@example.com phone 123456", "Show unpaid invoices", "Logout", "Dashboard".',
                'action' => null
            ];
        }

        Log::info('Voice command received: ' . $command);
        VoiceCommand::create([
            'command' => $command,
            'intent' => $response['action']
        ]);

        return response()->json($response);
    }
}
