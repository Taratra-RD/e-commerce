<?php
    namespace App\Notification;

use App\Entity\Contact;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Twig\Environment;

    class ContactNotification {

        private $mailer;
        private $renderer;

        public function __construct(MailerInterface $mailer, Environment $renderer)
        {
            $this->mailer = $mailer;
            $this->renderer = $renderer;
        }
        public function notify(Contact $contact)
        {
            $message = (new Email())
                ->from('noreply@agence.fr')
                ->to('contact@agence.fr')
                ->replyTo($contact->getEmail())
                ->subject('Email system with symfony')
                ->text('Mail by text')
                ->html('<p>New mailer system</p>');

            $this->mailer->send($message);
        }
    }
?>