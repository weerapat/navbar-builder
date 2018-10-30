<?php
namespace App\Http\Requests\NavigationBar;
use Illuminate\Foundation\Http\FormRequest;
class SaveSettingRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'items.*.order' => 'required|integer|min:0',
            'items.*.type' => 'required|in:standard,link',
            'items.*.color' => 'required|string',
            'items.*.category_name' => 'required|array',
            'items.*.title' => 'required_if:items.*.type,standard',
            'items.*.link' => 'required_if:items.*.type,link',
            'items.*.pages' => 'required_if:items.*.type,standard',
            'items.*.pages.*.order' => 'required_if:items.*.type,standard',
            'items.*.pages.*.icon' => 'required_if:items.*.type,standard',
            'items.*.pages.*.title' => 'required_if:items.*.type,standard',
            'items.*.pages.*.link' => 'required_if:items.*.type,standard',
            'items.*.related_article_id' => 'required|nullable',
            'related_article_amount' => 'required|integer',
        ];
    }
}
