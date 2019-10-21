<?php

namespace App\Modules\Flash;

use Illuminate\Session\Store;

class Flash
{
	private $session;

	public function __construct(Store $session)
	{
		$this->session = $session;
	}

	public function info($message)
	{
		$this->message($message, 'info');
	}

	public function success($message)
	{
		$this->message($message, 'success');

		return 'test';
	}

	public function warning($message)
	{
		$this->message($message, 'warning');
	}

	public function error($message)
	{
		$this->message($message, 'danger');
	}

	public function message($message, $level = 'info')
	{
		$this->session->flash('flash.message', $message);
		$this->session->flash('flash.level', $level);
	}
}