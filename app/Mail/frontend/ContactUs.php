<?php

namespace App\Mail\frontend;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class ContactUs extends Mailable
{
	use Queueable, SerializesModels;
	protected $mailData = [];

	/**
	 * Create a new message instance.
	 *
	 * @return void
	 */
	public function __construct($mailData = [])
	{
		$this->mailData = $mailData;
	}

	/**
	 * Build the message.
	 *
	 * @return $this
	 */
	public function build()
	{
		$from = $this->mailData['email'];
		$app_name = config('project.app.title');

		return $this->markdown('frontend.mails.Contactus')->with('mailData', $this->mailData)
			->from($from, $app_name)
			->subject('Contact Us')
			->replyTo('', $app_name);
	}
}
