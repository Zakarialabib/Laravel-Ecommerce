<?php

namespace App\Http\Livewire\Admin\Settings;

use Livewire\Component;
use App\Models\Settings;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;

    public $company_name, $site_title, $logoFile, $iconFile, $favicon, $siteImage,
    $company_email_address, $company_phone, $company_address, $social_facebook, $social_twitter, 
    $social_instagram, $social_linkedin, $social_whatsapp, $head_tags ,$body_tags,
    $seo_meta_title, $seo_meta_description, $footer_copyright_text, $enableRegistrationTerms, 
    $currency_position, $site_maintenance_message, $site_tax, $site_shipping, 
    $site_return, $site_refund, $site_terms, $site_privacy, $site_about, $site_contact;

    protected $listeners = ['save', 'uploadFavicon', 'uploadLogo'];

    public function mount()
    {
        $this->company_name = Config::get('settings.company_name');
        $this->site_title = Config::get('settings.site_title');
        $this->company_email_address = Config::get('settings.company_email_address');
        $this->company_phone = Config::get('settings.company_phone');
        $this->company_address = Config::get('settings.company_address');
        $this->siteImage = Config::get('settings.site_logo');
        $this->favicon = Config::get('settings.site_favicon');
        $this->social_facebook  = Config::get('settings.social_facebook');
        $this->social_twitter  = Config::get('settings.social_twitter');
        $this->social_instagram  = Config::get('settings.social_instagram');
        $this->social_linkedin  = Config::get('settings.social_linkedin');
        $this->social_whatsapp  = Config::get('settings.social_whatsapp');
        $this->head_tags  = Config::get('settings.head_tags');
        $this->body_tags  = Config::get('settings.body_tags');
        $this->seo_meta_title  = Config::get('settings.seo_meta_title');
        $this->seo_meta_description  = Config::get('settings.seo_meta_description');
        $this->footer_copyright_text = Config::get('settings.footer_copyright_text');
        $this->enableRegistrationTerms = (bool) Config::get('settings.enableRegistrationTerms');
        $this->currency_code  = Config::get('settings.currency_code');
        $this->currency_symbol  = Config::get('settings.currency_symbol');
        $this->currency_position = Config::get('settings.currency_position');
        $this->site_maintenance_message = Config::get('settings.site_maintenance_message');
        $this->site_return = Config::get('settings.site_return');
        $this->site_refund = Config::get('settings.site_refund');
        $this->site_terms = Config::get('settings.site_terms');
        $this->site_privacy = Config::get('settings.site_privacy');
        $this->site_about = Config::get('settings.site_about');
        $this->site_contact = Config::get('settings.site_contact');
    }

   
    public function save()
    {
        $settings = [
            'company_name' => $this->company_name,
            'site_title' => $this->site_title,
            'company_email_address' => $this->company_email_address,
            'company_phone' => $this->company_phone,
            'company_address' => $this->company_address,
            'social_facebook' => $this->social_facebook,
            'social_twitter' => $this->social_twitter,
            'social_instagram' => $this->social_instagram,
            'social_linkedin' => $this->social_linkedin,
            'social_whatsapp' => $this->social_whatsapp,
            'head_tags' => $this->head_tags,
            'body_tags' => $this->body_tags, 
            'seo_meta_title' => $this->seo_meta_title,
            'seo_meta_description' => $this->seo_meta_description,
            'footer_copyright_text' => $this->footer_copyright_text,
            'enableRegistrationTerms' => $this->enableRegistrationTerms,
            'currency_code' => $this->currency_code,
            'currency_symbol' => $this->currency_symbol,
            'currency_position' => $this->currency_position,
            'site_maintenance_message' => $this->site_maintenance_message,
            'site_return' => $this->site_return,
            'site_refund' => $this->site_refund,
            'site_terms' => $this->site_terms,
            'site_privacy' => $this->site_privacy,
            'site_about' => $this->site_about,
            'site_contact' => $this->site_contact,
        ];
        
        foreach($settings as $key => $value) {
            Settings::set($key, $value);
        }

        $this->alert('success', __('Settings updated successfully!') );
    }


    public function uploadFavicon()
    {
        $favicon = $this->upload($this->iconFile, $this->favicon, 'iconFile');
        if($favicon){
            Settings::set('site_favicon', $favicon);
            $this->alert('success', __('Favicon updated successfully!') );
            $this->iconFile = "";
            $this->favicon = $favicon;
        } else {
            $this->alert('error', __('Unable to upload your image') );
        }
    }

    private function upload($filename, $name,  $validateName)
    {
        $this->validate([
            $validateName => 'required|mimes:jpeg,png,jpg,gif,svg|max:1048'
        ]);

        if($name != null){
            Storage::delete('logo/'.$name);
        }

        $url = $filename->store('logo');

        return $url;
    }

    public function uploadLogo()
    {
        $logo = $this->upload($this->logoFile, $this->siteImage, 'logoFile');
        if($logo){
            Settings::set('site_logo', $logo);
            $this->alert('success', __('Logo updated successfully!') );
            $this->logoFile = "";
            $this->siteImage = $logo;
        } else {
            $this->alert('error', __('Unable to upload your image') );
        }
    }


    public function render()
    {
        return view('livewire.admin.settings.index');
    }

   
}
