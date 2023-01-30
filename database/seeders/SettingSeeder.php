<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Settings;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /** @var array */
    protected $settings = [
        [
            'key'   => 'company_name',
            'value' => 'APPECOM',
        ],
        [
            'key'   => 'site_title',
            'value' => 'APPECOM',
        ],
        [
            'key'   => 'company_email_address',
            'value' => 'connect@zakarialabib.com',
        ],
        [
            'key'   => 'company_phone',
            'value' => '+212638041919',
        ],
        [
            'key'   => 'company_address',
            'value' => 'Casablanca, Maroc',
        ],
        [
            'key'   => 'currency_code',
            'value' => 'MAD',
        ],
        [
            'key'   => 'currency_symbol',
            'value' => 'DH',
        ],
        [
            'key'   => 'currency_position',
            'value' => 'right',
        ],
        [
            'key'   => 'site_logo',
            'value' => '',
        ],
        [
            'key'   => 'site_favicon',
            'value' => '',
        ],
        [
            'key'   => 'page_status',
            'value' => '1',
        ],
        [
            'key'   => 'footer_copyright_text',
            'value' => '',
        ],
        [
            'key'   => 'seo_meta_title',
            'value' => 'APPECOM',
        ],
        [
            'key'   => 'seo_meta_description',
            'value' => 'APPECOM',
        ],
        [
            'key'   => 'social_facebook',
            'value' => '#',
        ],
        [
            'key'   => 'social_twitter',
            'value' => '#',
        ],
        [
            'key'   => 'social_instagram',
            'value' => '#',
        ],
        [
            'key'   => 'social_linkedin',
            'value' => '#',
        ],
        [
            'key'   => 'social_whatsapp',
            'value' => '#',
        ],
        [
            'key'   => 'head_tags',
            'value' => '',
        ],
        [
            'key'   => 'body_tags',
            'value' => '',
        ],
        [
            'key'   => 'enableRegistrationTerms',
            'value' => '1',
        ],
        [
            'key'   => 'site_maintenance_message',
            'value' => 'Site is under maintenance',
        ],
        [
            'key'   => 'site_return',
            'value' => '0',
        ],
        [
            'key'   => 'site_refund',
            'value' => '0',
        ],
        [
            'key'   => 'site_terms',
            'value' => '0',
        ],
        [
            'key'   => 'site_privacy',
            'value' => '0',
        ],
        [
            'key'   => 'site_about',
            'value' => '0',
        ],
        [
            'key'   => 'site_contact',
            'value' => '0',
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->settings as $index => $setting) {
            $result = Settings::create($setting);

            if ( ! $result) {
                $this->command->info("Insert failed at record $index.");

                return;
            }
        }
        $this->command->info('Inserted '.count($this->settings).' records');
    }
}
