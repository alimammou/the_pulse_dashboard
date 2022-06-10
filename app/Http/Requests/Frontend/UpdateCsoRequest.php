<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCsoRequest extends FormRequest
{


    public function rules(): array
    {
        return [
            'name' => ['nullable', 'max:191'],
            'arabic_name' => ['nullable', 'max:191'],
            'type' => ['nullable', 'max:191'],
            'starting_date' => ['nullable', 'max:191'],
            'aelem_w_5abar' => ['nullable', 'max:191'],
            'official_status' => ['nullable', 'max:191'],
            'address' => ['nullable', 'max:191'],
            'the_pulse_region' => ['nullable', 'max:191'],
            'website' => ['nullable', 'max:191'],
            'mission' => ['nullable', 'max:191'],
            'affiliated_to_NGOs' => ['nullable', 'max:191'],
            'affiliation' => ['nullable', 'max:191'],
            'key_figure_eng' => ['nullable', 'max:191'],
            'position' => ['nullable', 'max:191'],
            'email' => ['nullable', 'max:191'],
            'financing_method' => ['nullable', 'max:191'],
            'opinion_civil_state' => ['nullable', 'max:191'],
            'opinion_neutrality' => ['nullable', 'max:191'],
            'opinion_weapons' => ['nullable', 'max:191'],
            'decentralization' => ['nullable', 'max:191'],
            'economic_plan' => ['nullable', 'max:191'],
            'economic_plan_link' => ['nullable', 'max:191'],
            'type_based_social_media' => ['nullable', 'max:191'],
            'social_media' => ['nullable', 'max:191'],
            'insta_username' => ['nullable', 'max:191'],
            'twitter_username' => ['nullable', 'max:191'],
            'fb_username' => ['nullable', 'max:191'],
            'fb_last_post' => ['nullable', 'max:191'],
            'fb_virtual_popularity' => ['nullable', 'max:191'],
            'insta_virtual_popularity' => ['nullable', 'max:191'],
            'twitter_virtual_popularity' => ['nullable', 'max:191'],
            'trending_topic' => ['nullable', 'max:191'],
            'trending_polls' => ['nullable', 'max:191'],
            'trending_hashtags' => ['nullable', 'max:191'],
            'most_shared_urls' => ['nullable', 'max:191'],
            'logo' => ['nullable', 'file'],
            'location' => ['nullable', 'max:191'],

            'economic_plan_title' => ['nullable', 'max:191'],
            'economic_plan_upload' => ['nullable', 'file'],
        ];
    }
}
