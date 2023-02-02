<?php

namespace App\Http\Livewire\Settings\Page;

use App\Services\CacheKeys;
use App\Traits\HasInternet;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use App\Models\About as Setting;
use Livewire\WithFileUploads;

class About extends Component
{
    use HasInternet, WithFileUploads;
    public $settings;
    public $title,$description, $heroImage,$heroImagePreview,$firstSectionFirstImage,$firstSectionFirstImagePreview,
    $firstSectionSecondImage,$firstSectionSecondImagePreview,$firstSectionTitle,$firstSectionSubTitle,
    $firstSectionBody,$firstSectionBodyTwo,$secondSectionTitle,$secondSectionSubtitle,
    $secondSectionBody,$thirdSectionImage,$thirdSectionImagePreview,
    $secondSectionImage,$secondSectionImagePreview,
    $thirdSectionTitle,$thirdSectionSubTitle,$thirdSectionFirstBody,
    $thirdSectionSecondBody,$thirdSectionButtonText,$thirdSectionButtonUrl
    ;

    protected $messages = [
        'heroImagePreview.max'=>'The image cannot be greater than 1 MB',
        'heroImagePreview.image'=>'The file must be an image',

        'firstSectionFirstImagePreview.max' => 'The image cannot be greater than 1 MB',
        'firstSectionFirstImagePreview.image'=>'The file must be an image',
        'firstSectionSecondImagePreview.max' => 'The image cannot be greater than 1 MB',
        'firstSectionSecondImagePreview.image'=>'The file must be an image',

        'thirdSectionImagePreview.max' => 'The image cannot be greater than 1 MB',
        'thirdSectionImagePreview.image'=>'The file must be an image',
        'thirdSectionImage.max' => 'The image cannot be greater than 1 MB',
        'thirdSectionImage.image'=>'The file must be an image',
        'thirdSectionImagePreview.required' => 'Please choose an image to upload',

        'secondSectionImagePreview.image'=>'The file must be an image',
        'secondSectionImage.max' => 'The image cannot be greater than 1 MB',
        'secondSectionImage.image'=>'The file must be an image',
        'secondSectionImagePreview.required' => 'Please choose an image to upload',
    ];

    private function refreshComponent()
    {
        $this->mount();
        $this->render();
    }

    public function mount()
    {
        $this->settings = Cache::remember(CacheKeys::ABOUT_PAGE_SETTINGS_CACHE, now()->addDays(30), function (){
            return Setting::first();
        });
        $this->fill([
            'title' => $this->settings?->title ?? null,
            'description' => $this->settings?->description ?? null,
            'heroImage' => $this->settings?->heroImage ?? null,
            'firstSectionFirstImage' => $this->settings?->firstSectionFirstImage ?? null,
            'firstSectionSecondImage' => $this->settings?->firstSectionSecondImage ?? null,
            'firstSectionTitle' => $this->settings?->firstSectionFirstTitle ?? null,
            'firstSectionSubTitle' => $this->settings?->firstSectionFirstSubTitle ?? null,
            'firstSectionBody' => $this->settings?->firstSectionFirstBody ?? null,
            'firstSectionBodyTwo' => $this->settings?->firstSectionSecondBody ?? null,
            'secondSectionTitle' => $this->settings?->secondSectionTitle ?? null,
            'secondSectionSubtitle' => $this->settings?->secondSectionSubTitle ?? null,
            'secondSectionBody' => $this->settings?->secondSectionBody ?? null,
            'thirdSectionImage' => $this->settings?->thirdSectionImage ?? null,
            'secondSectionImage' => $this->settings?->secondSectionImage ?? null,
            'thirdSectionTitle' => $this->settings?->thirdSectionTitle ?? null,
            'thirdSectionSubTitle' => $this->settings?->thirdSectionSubTitle ?? null,
            'thirdSectionFirstBody' => $this->settings?->thirdSectionFirstBody ?? null,
            'thirdSectionSecondBody' => $this->settings?->thirdSectionSecondBody ?? null,
            'thirdSectionButtonText' => $this->settings?->thirdSectionButtonText ?? null,
            'thirdSectionButtonUrl' => $this->settings?->thirdSectionButtonUrl ?? null,
        ]);
    }
    public function SaveThirdSectionData()
    {
        $response = null;
        if ($this->settings === null){
            $response = Setting::create([
                'thirdSectionTitle'=>$this->thirdSectionTitle,
                'thirdSectionSubTitle' => $this->thirdSectionSubTitle,
                'thirdSectionFirstBody' => $this->thirdSectionFirstBody,
                'thirdSectionSecondBody' => $this->thirdSectionSecondBody,
                'thirdSectionButtonText' => $this->thirdSectionButtonText,
                'thirdSectionButtonUrl' => $this->thirdSectionButtonUrl,
            ]);
        }else{
            $response =  $this->settings->update([
                'thirdSectionTitle'=>$this->thirdSectionTitle,
                'thirdSectionSubTitle' => $this->thirdSectionSubTitle,
                'thirdSectionFirstBody' => $this->thirdSectionFirstBody,
                'thirdSectionSecondBody' => $this->thirdSectionSecondBody,
                'thirdSectionButtonText' => $this->thirdSectionButtonText,
                'thirdSectionButtonUrl' => $this->thirdSectionButtonUrl,
            ]);
        }
        if ($response){
            $this->emit('changes-saved');
        }else{
            $this->emit('changes-not-saved');
        }
        return back();
    }
    public function SaveSecondSectionData()
    {
        $response = null;
        if ($this->settings === null){
            $response = Setting::create([
                'secondSectionTitle'=>$this->secondSectionTitle,
                'secondSectionSubTitle' => $this->secondSectionSubtitle,
                'secondSectionBody' => $this->secondSectionBody,
            ]);
        }else{
            $response =  $this->settings->update([
                'secondSectionTitle'=>$this->secondSectionTitle,
                'secondSectionSubTitle' => $this->secondSectionSubtitle,
                'secondSectionBody' => $this->secondSectionBody,
            ]);
        }
        if ($response){
            $this->emit('changes-saved');
        }else{
            $this->emit('changes-not-saved');
        }
        return back();
    }
    public function SaveFirstSectionData()
    {
        $response = null;
        if ($this->settings === null){
           $response = Setting::create([
                'firstSectionFirstTitle'=>$this->firstSectionTitle,
                'firstSectionFirstSubTitle' => $this->firstSectionSubTitle,
                'firstSectionFirstBody' => $this->firstSectionBody,
                'firstSectionSecondBody' => $this->firstSectionBodyTwo
            ]);
        }else{
          $response =  $this->settings->update([
                'firstSectionFirstTitle'=>$this->firstSectionTitle,
                'firstSectionFirstSubTitle' => $this->firstSectionSubTitle,
                'firstSectionFirstBody' => $this->firstSectionBody,
                'firstSectionSecondBody' => $this->firstSectionBodyTwo
            ]);
        }
        if ($response){
            $this->emit('changes-saved');
        }else{
            $this->emit('changes-not-saved');
        }
        return back();
    }
    public function UploadThirdSectionImage()
    {
        $this->validate([
            'thirdSectionImagePreview'=>['required','image','max:1024']
        ]);

        if ($this->ConnectedToInternet()){
            $response = null;
            //upload
            $image = Cloudinary::upload($this->thirdSectionImagePreview->getRealPath(), [
                'folder'=>'pages',
                'transformation'=>[
                    'width'=>1280,
                    'crop' => 'fill',
                ]
            ])->getSecurePath();
            if ($this->settings === null){
                $response = Setting::create([
                    'thirdSectionImage'=> $image
                ]);
            }else{
                $response = $this->settings->update([
                    'thirdSectionImage'=> $image
                ]);
            }

            if ($response){
                $this->emit('changes-saved');
            }else{
                $this->emit('changes-not-saved');
            }
        }else{
            $this->emit('no-internet');
        }
        $this->refreshComponent();
        return back();
    }
    public function UploadSecondSectionImage()
    {
        $this->validate([
            'secondSectionImagePreview'=>['required','image','max:1024']
        ]);

        if ($this->ConnectedToInternet()){
            $response = null;
            //upload
            $image = Cloudinary::upload($this->secondSectionImagePreview->getRealPath(), [
                'folder'=>'pages',
                'transformation'=>[
                    'width'=>1280,
                    'crop' => 'fill',
                ]
            ])->getSecurePath();
            if ($this->settings === null){
                $response = Setting::create([
                    'secondSectionImage'=> $image
                ]);
            }else{
                $response = $this->settings->update([
                    'secondSectionImage'=> $image
                ]);
            }

            if ($response){
                $this->emit('changes-saved');
            }else{
                $this->emit('changes-not-saved');
            }
        }else{
            $this->emit('no-internet');
        }
        $this->refreshComponent();
        return back();
    }
    public function UploadFirstSectionSecondImage()
    {
        $this->validate([
            'firstSectionSecondImagePreview'=>['required','image','max:1024']
        ]);

        if ($this->ConnectedToInternet()){
            $response = null;
            //upload
            $image = Cloudinary::upload($this->firstSectionSecondImagePreview->getRealPath(), [
                'folder'=>'pages',
                'transformation'=>[
                    'width'=>1280,
                    'crop' => 'fill',
                ]
            ])->getSecurePath();
            if ($this->settings === null){
                $response = Setting::create([
                    'firstSectionSecondImage'=> $image
                ]);
            }else{
                $response = $this->settings->update([
                    'firstSectionSecondImage'=> $image
                ]);
            }

            if ($response){
                $this->emit('changes-saved');
            }else{
                $this->emit('changes-not-saved');
            }
        }else{
            $this->emit('no-internet');
        }
        $this->refreshComponent();
        return back();
    }
    public function UploadFirstSectionFirstImage()
    {
        $this->validate([
            'firstSectionFirstImagePreview'=>['required','image','max:1024']
        ]);

        if ($this->ConnectedToInternet()){
            $response = null;
            //upload
            $image = Cloudinary::upload($this->firstSectionFirstImagePreview->getRealPath(), [
                'folder'=>'pages',
                'transformation'=>[
                    'width'=>1280,
                    'crop' => 'fill',
                ]
            ])->getSecurePath();
            if ($this->settings === null){
                $response = Setting::create([
                    'firstSectionFirstImage'=> $image
                ]);
            }else{
                $response = $this->settings->update([
                    'firstSectionFirstImage'=> $image
                ]);
            }

            if ($response){
                $this->emit('changes-saved');
            }else{
                $this->emit('changes-not-saved');
            }
        }else{
            $this->emit('no-internet');
        }
        $this->refreshComponent();
        return back();
    }
    public function UploadHeroImage()
    {
        $this->validate([
            'heroImagePreview'=>['required','image','max:1024']
        ]);
        if ($this->ConnectedToInternet()){
            $response = null;
            //upload
            $image = Cloudinary::upload($this->heroImagePreview->getRealPath(), [
                'folder'=>'pages',
                'transformation'=>[
                    'width'=>1280,
                    'crop' => 'fill',
                ]
            ])->getSecurePath();
            if ($this->settings === null){
                $response = Setting::create([
                    'heroImage'=> $image
                ]);
            }else{
                $response = $this->settings->update([
                    'heroImage'=> $image
                ]);
            }

            if ($response){
                $this->emit('changes-saved');
            }else{
                $this->emit('changes-not-saved');
            }
        }else{
            $this->emit('no-internet');
        }
        $this->refreshComponent();
        return back();
    }
    public function SeoSettings()
    {
        $this->validate([
            'title'=>['required','string','max:150'],
            'description'=>['required','string','max:160'],
        ]);
        $response = null;
        if ($this->settings === null){
            //create a new setting
            $response = Setting::create([
                'title' =>$this->title,
                'description' => $this->description
            ]);
        } else{
           $response = $this->settings->update([
               'title' =>$this->title,
               'description' => $this->description
           ]);
        }
        if ($response){
            $this->emit('changes-saved');
        } else{
            $this->emit('changes-not-saved');
        }
        return back();
    }
    public function render()
    {
        return view('livewire.settings.page.about');
    }
}
