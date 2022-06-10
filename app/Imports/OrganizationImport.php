<?php

namespace App\Imports;

use App\Models\Organization\Organization;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;

class OrganizationImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        for ($i = 0; $i < 53; $i++) {
            if ($row[$i] == 'na') {
                $row[$i] = '';
            }
        }
        for ($i = 17; $i < 36; $i++) {
            if ($row[$i] == 0) {
                $row[$i] = 'No';
            } else {
                $row[$i] = 'Yes';
            }
        }
        if ($row[36] == 1) {
            $row[36] = 'with';
        } else {
            $row[36] = 'against';
        }
        if ($row[37] == 1) {
            $row[37] = 'with';
        } elseif ($row[37] == 0) {
            $row[37] = 'no opinion';
        } else {
            $row[37] = 'against';
        }
        if ($row[38] == 1) {
            $row[38] = 'The weapon\'s issue is corrolated with the region\'s development';
        } elseif ($row[38] == 0) {
            $row[38] = 'no opinion about weapons';
        } elseif ($row[38] == 2) {
            $row[38] = 'With the disarmament of all militias as part of a statesponsored defence strategy as stated in Taif Agreement';
        } elseif ($row[38] == 3) {
            $row[38] = 'The Legal resistance has to be part of a state-sponsored defense strategy. This strategy is regarded as urgent';
        } else {
            $row[38] = 'With immediate disarmament of Hezbollah, based on UN Security Council resolutio on no. 1559';
        }
        if ($row[40] == 1) {
            $row[40] = 'Have a drafted Economic  Reform Plan';
        } elseif ($row[40] == 2) {
            $row[40] = 'Have Economic positions, but not a drafted plan';
        } else {
            $row[40] = 'Not within the scope of the CSO';
        }
        if ($row[39] == 1) {
            $row[39] = 'with';
        } elseif ($row[39] == 2) {
            $row[39] = 'against';
        }
        if ($row[0] == '')
        {
            return null;
        }
        elseif ($row[0]=='Name of Organization')
        {
            return null;
        }
        else
        return new Organization([
            'slug' => Str::slug($row[0],"-"),
            'name'     => $row[0],
            'arabic_name'     => $row[1],
            'type'     => $row[3],
            'starting_date'     => $row[4],
            'aelem_w_5abar'     => $row[5],
            'official_status'     => $row[6],
            'address'     => $row[7],
            'the_pulse_region'     => $row[8],
            'website'     => $row[9],
            'mission'     => $row[10],
            'affiliated_to_NGOs'     => $row[11],
            'affiliation'     => $row[12],
            'key_figure_eng'     => $row[13],
            'position'     => $row[14],
            'email'     => $row[15],
            'financing_method'     => $row[16],
            'revolution_oct_19'     => $row[17],
            'revolution_dec_19'     => $row[18],
            'daleel_thawra_2019'     => $row[19],
            'national_civic_front'     => $row[20],
            'the_initiative'     => $row[21],
            'civil_front_alliance'     => $row[22],
            'electoral_groups'     => $row[23],
            'national_rescue_initiative'     => $row[24],
            'national_help_convention'     => $row[25],
            'university_students_support_coalision'     => $row[26],
            '6th_dec_front'     => $row[27],
            'the_pulse'     => $row[28],
            'field_group_alliance'     => $row[29],
            'video_expats_coalition'     => $row[30],
            'activist_key_1'     => $row[31],
            'activist_key_2'     => $row[32],
            'activist_key_3'     => $row[33],
            'collective_video'     => $row[34],
            'meeting_with_shinker'     => $row[35],
            'opinion_civil_state'     => $row[36],
            'opinion_neutrality'     => $row[37],
            'opinion_weapons'     => $row[38],
            'decentralization'     => $row[39],
            'economic_plan'     => $row[40],
            'economic_plan_link'     => $row[41],
            'type_based_social_media'     => $row[42],
            'social_media' => $row[43],
            'insta_username'     => $row[44],
            'twitter_username'     => $row[45],
            'fb_username'     => $row[46],
            'fb_last_post'     => $row[47],
            'fb_virtual_popularity'     => $row[48],
            'insta_virtual_popularity'     => $row[49],
            'twitter_virtual_popularity'     => $row[50],
            'trending_topic'     => $row[51],
            'trending_polls'     => $row[52],
            'trending_hashtags'     => $row[53],
            'most_shared_urls'     => $row[54],
        ]);
    }
}
