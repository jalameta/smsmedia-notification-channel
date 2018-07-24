<?php

namespace NotificationChannels\SmsMedia\Message;

use NotificationChannels\SmsMedia\Contracts\Message\ShortMessageContract;

/**
 * Short message class
 *
 * @author      veelasky <veelasky@gmail.com>
 */
class ShortMessage implements ShortMessageContract
{
    /**
     * The short message body.
     *
     * @var string
     */
    protected $body;

    /**
     * The receivers.
     *
     * @var array
     */
    protected $receivers;

    /**
     * ShortMessage constructor.
     *
     * @param string|array $receivers
     * @param string       $body
     */
    public function __construct($receivers, $body)
    {
        $this->body = $body;
        $this->receivers = is_array($receivers)
            ? array_map('trim', $receivers)
            : [trim($receivers)];
    }

    /**
     * Get the body of the short message.
     *
     * @return string
     */
    public function body()
    {
        return $this->body;
    }

    /**
     * Determine if the short message has many receivers or not.
     *
     * @return bool
     */
    public function hasManyReceivers()
    {
        return count($this->receivers()) > 1;
    }

    /**
     * Get the receivers of the short message.
     *
     * @return array
     */
    public function receivers()
    {
        return $this->receivers;
    }

    /**
     * Get the receivers of the short message as concatenated string.
     *
     * @param  string|null $glue
     * @return string
     */
    public function receiversString($glue = null)
    {
        return implode($glue, $this->receivers);
    }

    /**
     * Get the array representation of the short message.
     *
     * @return array
     */
    public function toArray()
    {
        return array_filter([
            'Msisdns'        => $this->receiversString('|'),
            'Messages'       => $this->body(),
        ]);
    }
}