<?php

use PHPUnit\Framework\TestCase;
use MailcareOnline\Mailcare;

class MailcareTest extends TestCase
{
    public function testSendTransactionalEmail()
    {
        $this->expectNotToPerformAssertions();
        $apiToken = 'test_token';
        $transactionalAlias = 'test_transactional_alias';
        $templateAlias = 'test_template_alias';
        $variables = ['key' => 'value'];

        $mailcare = new Mailcare($apiToken);
        $mailcare->sendTransactionalEmail('test@example.com', $transactionalAlias, $templateAlias, $variables);
    }
}
