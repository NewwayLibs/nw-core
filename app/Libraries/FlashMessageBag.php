<?php namespace App\Libraries;

use Illuminate\Support\MessageBag;
use Illuminate\Session\SessionManager;

/**
 * Class FlashMessageBag
 * @package App\Libraries
 */
class FlashMessageBag extends MessageBag {

    protected $session_key = 'flash_messages';
    protected $session;

    public function __construct(SessionManager $session, $messages = array())
    {
	    $this->session = $session;

        if ($session->has($this->session_key))
        {
            $messages = array_merge_recursive(
                $session->get($this->session_key),
                $messages
            );
        }

        parent::__construct($messages);
    }

    public function flash()
    {
        $this->session->flash($this->session_key, $this->messages);

        return $this;
    }

	public function count( $key = null ){

		if (array_key_exists($key, $this->messages))
			return count($this->messages[$key]);

		return count($this->messages);
	}

}