<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationTable extends Migration
{
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();

            $table->string('name')->nullable();
            $table->string('arabic_name')->nullable();
            $table->string('type')->nullable();
            $table->string('starting_date')->nullable();
            $table->string('aelem_w_5abar')->nullable();
            $table->string('official_status')->nullable();
            $table->string('address')->nullable();
            $table->string('the_pulse_region')->nullable();
            $table->string('website')->nullable();
            $table->text('mission')->nullable();
            $table->string('affiliated_to_NGOs')->nullable();
            $table->string('affiliation')->nullable();
            $table->string('key_figure_eng')->nullable();
            $table->string('position')->nullable();
            $table->string('email')->nullable();
            $table->string('financing_method')->nullable();

            $table->string('revolution_oct_19')->nullable();
            $table->string('revolution_dec_19')->nullable();
            $table->string('daleel_thawra_2019')->nullable();
            $table->string('national_civic_front')->nullable();
            $table->string('the_initiative')->nullable();
            $table->string('civil_front_alliance')->nullable();
            $table->string('electoral_groups')->nullable();
            $table->string('national_rescue_initiative')->nullable();
            $table->string('national_help_convention')->nullable();
            $table->string('university_students_support_coalision')->nullable();
            $table->string('6th_dec_front')->nullable();

            $table->string('the_pulse')->nullable();

            $table->string('field_group_alliance')->nullable();
            $table->string('video_expats_coalition')->nullable();
            $table->string('activist_key_1')->nullable();
            $table->string('activist_key_2')->nullable();
            $table->string('activist_key_3')->nullable();
            $table->string('collective_video')->nullable();
            $table->string('meeting_with_shinker')->nullable();

            $table->string('opinion_civil_state')->nullable();
            $table->string('opinion_neutrality')->nullable();
            $table->string('opinion_weapons')->nullable();
            $table->string('decentralization')->nullable();
            $table->string('economic_plan')->nullable();
            $table->string('economic_plan_link')->nullable();

            $table->string('type_based_social_media')->nullable();
            $table->string('social_media')->nullable();
            $table->string('insta_username')->nullable();
            $table->string('twitter_username')->nullable();
            $table->string('fb_username')->nullable();
            $table->string('fb_last_post')->nullable();
            $table->string('fb_virtual_popularity')->nullable();
            $table->string('insta_virtual_popularity')->nullable();
            $table->string('twitter_virtual_popularity')->nullable();
            $table->string('trending_topic')->nullable();
            $table->string('trending_polls')->nullable();
            $table->string('trending_hashtags')->nullable();
            $table->string('most_shared_urls')->nullable();

            $table->string('economic_plan_file')->nullable();
            $table->string('economic_plan_title')->nullable();

            $table->string('slug')->nullable();
            $table->string('logo_name')->nullable();





            $table->stamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('organizations');
    }
}
