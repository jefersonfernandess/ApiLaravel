<?php

namespace App\Http\Resources\V1;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        $typesArray = ['C' => 'Cartão', 'B' => 'Boleto', 'P' => 'Pix'];
        $paid = $this->paid;

        return [
            'User' => [
                'firstName' => $this->user->firstName,
                'lastName' => $this->user->lastName,
                'fullName' => $this->user->firstName . ' ' . $this->user->lastName,
                'email' => $this->user->email
            ],
            'Type' => $typesArray[$this->type],
            'Value' => 'R$'. number_format($this->value, 2, ',','.'),
            'Paid' => $paid ? 'Pago' : 'Pendente',
            'Paymentate' => $paid ? Carbon::parse($this->payment_date)->format('d/m/Y H:i:s') : NULL
        ];
    }
}
