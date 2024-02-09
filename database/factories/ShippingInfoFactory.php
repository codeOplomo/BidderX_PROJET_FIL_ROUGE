<?php

namespace Database\Factories;

use App\Models\Payment;
use App\Models\User;
use App\Models\ShippingInfo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Role>
 */
class ShippingInfoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = ShippingInfo::class;

    public function definition()
    {
        $payments = Payment::pluck('id')->toArray();

        return [
            'shipping_address' => $this->faker->address,
            'tracking_number' => $this->faker->numerify('TRK#########'),
            'shipping_date' => $this->faker->dateTimeBetween('-1 month', '+1 month'),
            'payment_id' => $this->faker->randomElement($payments),
        ];
    }
}
