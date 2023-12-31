<?php

namespace App\Message;

use App\Entity\Feedback;

class SendEmail
{
    public function __construct(private readonly Feedback $feedback)
    {
    }

    public function getFeedback(): Feedback
    {
        return $this->feedback;
    }
}