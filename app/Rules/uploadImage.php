<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class uploadImage implements Rule
{
    private $request, $name;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($request, $name)
    {
        $this->request = $request;
        $this->name = $name;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if ($this->request->hasFile($this->name)) {
            $allowedfileExtension = ['jpg', 'png'];
            $files = $this->request->file($this->name);
            foreach ($files as $file) {
                $extension = $file->getClientOriginalExtension();
                $check = in_array($extension, $allowedfileExtension);
                if ($check) {
                    return true;
                } else {
                    return false;
                }
            }
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Foto gagal diupload.';
    }
}
