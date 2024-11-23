<?php

use PHPUnit\Framework\TestCase;
use MailcareOnline\Mailcare;

class MailcareTest extends TestCase
{
    public function testSendTransactionalEmail()
    {
        $this->expectNotToPerformAssertions();
        $apiToken = 'test_token';
        $transactionalUid = 'test_transactional_uid';
        $variables = ['key' => 'value'];

        $mailcare = new Mailcare($apiToken);
        $mailcare->sendTransactionalEmail('test@example.com', $transactionalUid, $variables);
    }
}
