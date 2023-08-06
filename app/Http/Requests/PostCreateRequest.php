<?php


namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use \Carbon\Carbon;

class PostCreateRequest extends FormRequest
{


    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['string', 'max:255','required'],
            'body' => ['string', 'max:1000','required'],
            'date_publish' => ['date','required']
        ];
    }

    protected function prepareForValidation()
    {

        if ($this->has('date_publish')) {
            $datePublish = $this->input('date_publish');
            $datePublish = Carbon::parse($datePublish)->format('Y-m-d');
            $this->merge(['date_publish' => $datePublish]);
        }
    }



}
