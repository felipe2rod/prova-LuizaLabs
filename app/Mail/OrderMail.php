<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        $address = 'no-reply@nexadev.com.br';
        $subject = 'Seus pedidos';
        $name = 'Felipe Rodrigues';

        return $this->view('emails.order')
                    ->from($address, $name)
                    ->subject($subject)
                    ->with([
                        'date' => $this->data['order_date'],
                        'observation' => $this->data['order_date'],
                        'pay_method' => $this->data['pay_method'],
                        'name' => $this->data['client']['name'],
                        'sex' => $this->data['client']['sex'],
                        'cpf' => $this->data['client']['cpf'],
                        'email' => $this->data['client']['email'],
                        'itens' => $this->data['order_item'],
                        'total_value' => array_sum(array_map(function($item) { 
                            return $item['quantity']*$item['product']['price']; 
                        }, $this->data['order_item']))
                    ]);
    }
}
