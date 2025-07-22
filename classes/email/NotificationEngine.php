<?php

class NotificationEngine {

    /**
     *
     * @var type 
     */
    private static $config;

    /**
     * Get Current Configuration
     * @return
     */
    public static function getConfig() {
        return self::$config;
    }

    /**
     * Set Configuration
     * @param config
     */
    public static function setConfig($config) {
        self::$config = $config;
    }

    /**
     * Set Configuration
     * @param config
     */
    public static function notify($to = '', $subject = '', $body = '') {
        $notifyObj = new Notification();
        if (!empty($to)) {
            $notifyObj->to = $to;
        }
        if (!empty($subject)) {
            $notifyObj->subject = $subject;
        }
        if (!empty($body)) {
            $notifyObj->body = $body;
        }
        self::send($notifyObj);
    }

    /**
     * Set Configuration
     * @param config
     */
    public static function sendNotifications($emailObjs) {
        if ($emailObjs != null) {
            $length = count($emailObjs);
            for ($x = 0; $x < $length; $x++) {
                $emailObj = $emailObjs[$x];
                self::send($emailObj);
            }
        }
    }

    /**
     * Set Configuration
     * @param config
     */
    public static function send($emailObj) {
        $status = TRUE;
        try {
            if (is_null(self::$config)) {
                self::$config = new NotificationConfig("neetastudio.in");
            }
            if (!is_null($emailObj)) {
                $notifyObj = null;
                if (is_array($emailObj) && !($emailObj instanceof Notification)) {
                    $notifyObj = new Notification();
                    $notifyObj->setFrom($emailObj['from'], $emailObj['fromNm']);
                    $notifyObj->setReplyTo($emailObj['replyTo'], $emailObj['replyToNm']);
                    $notifyObj->setTo($emailObj['to']);
                    $notifyObj->setSubject($emailObj['subject']);
                    $notifyObj->setBody($emailObj['body']);
                    if (!is_null(OnclickUtils::getProperty('footer', $emailObj))) {
                        $notifyObj->setFooter($emailObj['footer']);
                    }
                    if (!is_null(OnclickUtils::getProperty('attachment', $emailObj))) {
                        $notifyObj->setAttachment($emailObj['attachment']);
                    }
                } else {
                    $notifyObj = $emailObj;
                }
                self::sendNotification($notifyObj);
            } else {
                $status = FALSE;
            }
        } catch (Exception $e) {
            $status = FALSE;
        }
        return $status;
    }

    /**
     * 
     * @param type $notification
     * @return boolean
     */
    private static function sendNotification($notification) {
        if (!is_null(self::$config)) {
            if (self::$config->isEnabled()) {
                try {
                    //
                    if (is_null($notification->getFrom())) {
                        $from = self::$config->getFrom();
                        $notification->setFrom($from['email'], $from['name']);
                    }
                    if (is_null($notification->getReplyTo())) {
                        $replyto = self::$config->getReplyTo();
                        $notification->setReplyTo($replyto['email'], $replyto['name']);
                    }
                    //
                    if (self::$config->getEnvironment() != CONSTANTS::ONCLICK_PROD) {
                        $testFooter = "<br/><br/><hr><strong>Email Recipients</strong>"
                                . "<table>";
                        $tostr = "";
                        if (!is_null($notification->getToRecipients()) && count($notification->getToRecipients()) > 0) {
                            foreach ($notification->getToRecipients() as $recipient) {
                                $tostr = $tostr . "<tr><td>To:</td><td>" . $recipient . "</td></tr>";
                            }
                        } else {
                            $tostr = $tostr . "<tr><td>To:</td><td> - </td></tr>";
                        }
                        $testFooter = $testFooter . $tostr;
                        $ccstr = "";
                        if (!is_null($notification->getCcRecipients()) && count($notification->getCcRecipients()) > 0) {
                            foreach ($notification->getCcRecipients() as $recipient) {
                                $ccstr = $ccstr . "<tr><td>Cc:</td><td>" . $recipient . "</td></tr>";
                            }
                        } else {
                            $ccstr = $ccstr . "<tr><td>Cc:</td><td> - </td></tr>";
                        }
                        $testFooter = $testFooter . $ccstr;

                        $bccstr = "";
                        if (!is_null($notification->getBCCRecipients()) && count($notification->getBCCRecipients()) > 0) {
                            foreach ($notification->getBCCRecipients() as $recipient) {
                                $bccstr = $bccstr . "<tr><td>Bcc:</td><td>" . $recipient . "</td></tr>";
                            }
                        } else {
                            $bccstr = $bccstr . "<tr><td>Bcc:</td><td> - </td></tr>";
                        }
                        $testFooter = $testFooter . $bccstr;

                        $attstr = "";
                        if (!is_null($notification->getAttachments()) && count($notification->getAttachments()) > 0) {
                            foreach ($notification->getAttachments() as $attachment) {
                                $attstr = $attstr . "<tr><td>Attachment:</td><td>" . $attachment['path'] . ", " . $attachment['name'] . "</td></tr>";
                            }
                        } else {
                            $attstr = $attstr . "<tr><td>Attachment:</td><td> - , - </td></tr>";
                        }

                        $testFooter = $testFooter . $attstr
                                . "</table>";
                        $notification->setFooter($notification->getFooter() . $testFooter);
                        $notification->setTo(self::$config->getTestGroup());
                        $notification->setCc(null);
                        $notification->setSubject(self::$config->getEnvironment() . " :: " . $notification->getSubject());
                    }
                    return MailHelper::send($notification, self::$config);
                } catch (Exception $e) {
                    return false;
                }
            } else {
                // Emails are disabled so true is correct behavior
                return true;
            }
        } else {
            return false;
        }
    }

}

?>
