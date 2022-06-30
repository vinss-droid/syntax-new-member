<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewMemberNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($memberName, $link)
    {
        $this->member = $memberName;
        $this->wa_group_link = $link->whatsapp_group_link;
        $this->dc_server_link = $link->discord_server_link;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $nameMember = $this->member;

        $whatsapp_group_link = $this->wa_group_link;

        $discord_server_link = $this->dc_server_link;

        return $this->view('Mail.NewMemberMail', compact('nameMember', 'whatsapp_group_link', 'discord_server_link'));

    }
}
