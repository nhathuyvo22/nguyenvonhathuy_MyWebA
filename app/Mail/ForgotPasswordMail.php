<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgotPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $newPassword;

    public function __construct(string $newPassword)
    {
        $this->newPassword = $newPassword;
    }

    public function build()
    {
        return $this->subject('Đặt lại mật khẩu')
            ->html("<h2>Mật khẩu mới của bạn là: {$this->newPassword}</h2>
                    <p>Vui lòng đổi mật khẩu sau khi đăng nhập.</p>");
    }
}
