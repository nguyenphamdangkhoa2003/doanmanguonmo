<?php

namespace App\Livewire\Profile;

use App\Models\Image;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\WithFileUploads;
class UpdateProfileInformationForm extends Component
{
    use WithFileUploads;
    public $photo;
    public string $name = '';
    public string $address = "";
    public string $phone = "";
    public string $email = '';

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;
        $this->address = Auth::user()->address ?? "";
        $this->phone = Auth::user()->phone ?? "";
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateProfileInformation(): void
    {
        $user = Auth::user();
        $validated = $this->validate([
            'phone' => ['required', 'string', 'regex:/^(\+?\d{1,4}[-.\s]?|)?\(?\d{1,4}\)?[-.\s]?\d{1,4}[-.\s]?\d{1,9}$/', Rule::unique(User::class)->ignore($user->id)],
            'address' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
            'photo' => ['nullable', 'max:1024']
        ]);
        $user->fill([...$validated, "email" => $this->email]);
        $image = $user->avatar;

        if (isset($image) && isset($this->photo)) {
            Cloudinary::destroy($image->public_image_id);
            Image::destroy($image->id);
            $cloundinary = cloudinary()->upload($this->photo->getRealPath());
            Image::create([
                "url" => $cloundinary->getSecurePath(),
                "public_image_id" => $cloundinary->getPublicId(),
                "user_id" => $user->id,
            ]);
        } elseif (!isset($image) && isset($this->photo)) {
            $cloundinary = cloudinary()->upload($this->photo->getRealPath());
            Image::create([
                "url" => $cloundinary->getSecurePath(),
                "public_image_id" => $cloundinary->getPublicId(),
                "user_id" => $user->id,
            ]);
        }
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        $this->dispatch('profile-updated', name: $user->name);
    }

    /**
     * Send an email verification notification to the current user.
     */
    public function sendVerification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended();

            return;
        }

        $user->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }
    public function render()
    {
        return view('livewire.profile.update-profile-information-form');
    }
}
