<?php

namespace App\Models\Organization;

use App\Models\BaseModel;
use App\Models\Organization\Traits\Attributes\OrganizationAttributes;
use App\Models\Organization\Traits\Relations\OrganizationRelationships;
use App\Models\Traits\ModelAttributes;
use Sqits\UserStamps\Concerns\HasUserStamps;

/**
 * @property mixed id
 * @property mixed name
 */
class Organization extends BaseModel
{
    use ModelAttributes, OrganizationAttributes, HasUserstamps, OrganizationRelationships;

    protected $fillable = [
        'name',
        'slug',
        'arabic_name',
        'type',
        'starting_date',
        'aelem_w_5abar',
        'official_status',
        'address',
        'the_pulse_region',
        'website',
        'mission',
        'affiliated_to_NGOs',
        'affiliation',
        'key_figure_eng',
        'position',
        'email',
        'financing_method',
        'revolution_oct_19',
        'revolution_dec_19',
        'daleel_thawra_2019',
        'national_civic_front',
        'the_initiative',
        'civil_front_alliance',
        'electoral_groups',
        'national_rescue_initiative',
        'national_help_convention',
        'university_students_support_coalision',
        '6th_dec_front',
        'the_pulse',
        'field_group_alliance',
        'video_expats_coalition',
        'activist_key_1',
        'activist_key_2',
        'activist_key_3',
        'collective_video',
        'meeting_with_shinker',
        'opinion_civil_state',
        'opinion_neutrality',
        'opinion_weapons',
        'decentralization',
        'economic_plan',
        'economic_plan_link',
        'type_based_social_media',
        'social_media',
        'insta_username',
        'twitter_username',
        'fb_username',
        'fb_likes',
        'insta_followers',
        'twitter_followers',
        'activity_score',
        'popularity_score',
        'overall_score',

        'fb_last_post',
        'fb_virtual_popularity',
        'insta_virtual_popularity',
        'twitter_virtual_popularity',
        'trending_topic',
        'trending_polls',
        'trending_hashtags',
        'most_shared_urls',
        'logo_name',
        'economic_plan_title',
        'economic_plan_file',
        'location'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];
}
