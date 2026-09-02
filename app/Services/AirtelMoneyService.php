<?php
namespace App\Services;
use App\Models\Payment;

class AirtelMoneyService
{
    /** Future Airtel API adapter. It intentionally never confirms payment without a provider callback. */
    public function initiate(Payment $payment): array
    {
        return ['status' => 'pending', 'message' => 'Airtel Money online payments are being prepared. Please contact Peaceful Home to confirm payment arrangements.'];
    }
}
