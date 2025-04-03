<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsletterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'txtlanguage'       => 'required',
            'newsletterTitle'   => 'required',
            'img_file'          => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'pdf_file'          => 'nullable|mimes:pdf',
            'ebook_file'        => 'nullable|mimes:pdf',
        ];
    }

    public function messages()
    {
        return [
            'txtlanguage.required'      => 'The language field is required. Please choose a language.',
            'newsletterTitle.required'  => 'The title of the newsletter is required. Please provide a title.',
            'img_file.required'         => 'An image file is required. Please upload an image.',
            'img_file.image'            => 'The file must be an image (jpeg, png, or jpg).',
            'img_file.mimes'            => 'The image must be of type jpeg, png, or jpg.',
            'pdf_file.required'         => 'A PDF file is required. Please upload a PDF.',
            'pdf_file.mimes'            => 'The PDF file must be in .pdf format.',
            'ebook_file.required'       => 'An ebook file is required. Please upload a PDF ebook.',
            'ebook_file.mimes'          => 'The ebook file must be in .pdf format.',
        ];
    }
}
