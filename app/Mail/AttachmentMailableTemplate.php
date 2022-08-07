<?php

namespace App\Mail;

use App\Helpers;
use App\Models\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AttachmentMailableTemplate extends Mailable
{
    use Queueable, SerializesModels;

    public $to_email, $to_name, $title, $view, $data, $attachment, $transaction_id, $receipt;

    /**
     * Create a new message instance.
     * @param $to_email
     * @param $to_name
     * @param $title
     * @param $view
     * @param $data
     * @param $attachment
     */
    public function __construct($to_email, $to_name, $data, $title, $view, $attachment = null, $transaction_id = null, $receipt = null)
    {
        $this->to_email = $to_email;
        $this->to_name = $to_name;
        $this->title = $title;
        $this->view = $view;
        $this->data = $data;
        $this->attachment = $attachment;
        $this->transaction_id = $transaction_id;
        $this->receipt = $receipt;
    }

    /**
     * Build the message
     *
     * @return $this
     */
    public function build()
    {

        if (!empty($this->receipt)) {
            $transaction = Transaction::find($this->transaction_id);
            if (!is_null($transaction)) {
                $this->receipt = $transaction->generateReceipt();
            }
        }

        $result = $this->subject("Awal: Transaction Receipt")
            ->to($this->to_email, $this->to_name)
            ->view($this->view, $this->data);

        if (!empty($this->receipt)) {
            $this->receipt = Helpers::getCDNLink($this->receipt);
            $result->attach($this->receipt, [
                'as' => 'receipt.pdf',
                'mime' => 'application/pdf',
            ]);
        }

        return $result;

    }
}
