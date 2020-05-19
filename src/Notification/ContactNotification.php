<?php

namespace App\Notification;

use App\Entity\Contact;
use Twig\Environment;

/**
 * Class ContactNotification
 *
 * @package \App\Notification
 */
class ContactNotification
{

    // unused file, method to send mails in consumer controller
    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * @var Environment
     */
    private $renderer;

    public function __construct(\Swift_Mailer $mailer, Environment $renderer)
    {
        $this->mailer = $mailer;
        $this->renderer = $renderer;
    }

    public function notify(Contact $contact)
    {
        $message = (new \Swift_Message('Prise de contact'))

            ->setFrom('noreply@server.com')
            ->setTo('yourname@outlook.com') //$contact->getEmail()
            ->setBody($this->renderer->render('email/contact.html.twig', [
                'contact' => $contact
            ]), 'text/html');

        $this->mailer->send($message);
    }

}
