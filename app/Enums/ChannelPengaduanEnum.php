<?php

namespace App\Enums;

enum ChannelPengaduanEnum: string
{
    case WEBSITE = 'Website Lapak Aduan';
    case FACEBOOK = 'Facebook';
    case INSTAGRAM = 'Instagram';
    case TWITTER = 'Twitter/X';
    case WHATSAPP = 'WhatsApp';
    case EMAIL = 'Email';
    case TELEPON = 'Telepon';
    case WALK_IN = 'Langsung (Walk-in)';
    case SURAT = 'Surat';

    public function getPrefix(): string
    {
        return match($this) {
            self::WEBSITE => 'WEB',
            self::FACEBOOK => 'FB',
            self::INSTAGRAM => 'IG',
            self::TWITTER => 'TW',
            self::WHATSAPP => 'WA',
            self::EMAIL => 'EM',
            self::TELEPON => 'TEL',
            self::WALK_IN => 'WLK',
            self::SURAT => 'SRT',
        };
    }

    public static function fromName(string $name): ?self
    {
        foreach (self::cases() as $case) {
            if ($case->value === $name) {
                return $case;
            }
        }
        return null;
    }
}
