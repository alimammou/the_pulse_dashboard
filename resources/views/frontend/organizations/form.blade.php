<div class="card-body">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="card-title mb-0">
                {{ __('labels.backend.organizations.management') }}
                <small
                    class="text-muted">{{ (isset($organization)) ? __('labels.backend.organizations.edit') : __('labels.backend.organizations.create') }}</small>
            </h4>
        </div>
        <!--col-->
    </div>
    <!--row-->

    <hr>

    <div class="">
        <div class="col">

            <x-admin.fields.text-field
                name="name"
                placeholder="Name"
                required="true"
            ></x-admin.fields.text-field>
            <x-admin.fields.text-field
                name="arabic_name"
                placeholder="Arabic Name"

            ></x-admin.fields.text-field>
            <x-admin.fields.text-field
                name="type"
                placeholder="Type"

            ></x-admin.fields.text-field>
            <x-admin.fields.text-field
                name="starting_date"
                placeholder="Starting Date"

            ></x-admin.fields.text-field>
            <x-admin.fields.text-field
                name="aelem_w_5abar"
                placeholder="علم وخبر"

            ></x-admin.fields.text-field>
            <x-admin.fields.text-field
                name="official_status"
                placeholder="official status"

            ></x-admin.fields.text-field>
            <x-admin.fields.text-field
                name="address"
                placeholder="address"

            ></x-admin.fields.text-field>
            <x-admin.fields.location-field
                name="location"
                placeholder="Casa"

            ></x-admin.fields.location-field>
            <x-admin.fields.text-field
                name="the_pulse_region"
                placeholder="the pulse region"

            ></x-admin.fields.text-field>
            <x-admin.fields.text-field
                name="website"
                placeholder="website"

            ></x-admin.fields.text-field>
            <x-admin.fields.text-field
                name="affiliated_to_NGOs"
                placeholder="affiliated to NGOs"

            ></x-admin.fields.text-field>
            <x-admin.fields.text-field
                name="affiliation"
                placeholder="affiliation"

            ></x-admin.fields.text-field>
            <x-admin.fields.text-field
                name="key_figure_eng"
                placeholder="key figure eng"

            ></x-admin.fields.text-field>
            <x-admin.fields.text-field
                name="position"
                placeholder="position"

            ></x-admin.fields.text-field>
            <x-admin.fields.text-field
                name="email"
                placeholder="email"

            ></x-admin.fields.text-field>
            <x-admin.fields.text-field
                name="financing_method"
                placeholder="financing method"

            ></x-admin.fields.text-field>
            <x-admin.fields.text-field
                name="opinion_civil_state"
                placeholder="Opinion on civil state"

            ></x-admin.fields.text-field>
            <x-admin.fields.text-field
                name="opinion_neutrality"
                placeholder="Opinion on Neutrality"

            ></x-admin.fields.text-field>
            <x-admin.fields.text-field
                name="opinion_weapons"
                placeholder="Opinion on Weapons "

            ></x-admin.fields.text-field>
            <x-admin.fields.text-field
                name="decentralization"
                placeholder="decentralization"

            ></x-admin.fields.text-field>
            <x-admin.fields.text-field
                name="economic_plan"
                placeholder="Economic Plan"

            ></x-admin.fields.text-field>
            <x-admin.fields.text-field
                name="economic_plan_link"
                placeholder="Hyperlink for economic plan"

            ></x-admin.fields.text-field>
            <x-admin.fields.text-field
                name="type_based_social_media"
                placeholder="Type based on social media"

            ></x-admin.fields.text-field>
            <x-admin.fields.text-field
                name="social_media"
                placeholder="SOCIAL MEDIA"

            ></x-admin.fields.text-field>
            <x-admin.fields.text-field
                name="insta_username"
                placeholder="insta username"

            ></x-admin.fields.text-field>
            <x-admin.fields.text-field
                name="twitter_username"
                placeholder="twitter username"

            ></x-admin.fields.text-field>
            <x-admin.fields.text-field
                name="fb_username"
                placeholder="FaceBook username"

            ></x-admin.fields.text-field>
            <x-admin.fields.text-field
                name="fb_last_post"
                placeholder="FaceBook last post"

            ></x-admin.fields.text-field>
            <x-admin.fields.text-field
                name="fb_virtual_popularity"
                placeholder="FaceBook virtual popularity"

            ></x-admin.fields.text-field>
            <x-admin.fields.text-field
                name="insta_virtual_popularity"
                placeholder="insta virtual popularity"

            ></x-admin.fields.text-field>
            <x-admin.fields.text-field
                name="twitter_virtual_popularity"
                placeholder="twitter virtual popularity"

            ></x-admin.fields.text-field>
            <x-admin.fields.text-field
                name="trending_topic"
                placeholder="trending topic"
            ></x-admin.fields.text-field>
            <x-admin.fields.text-field
                name="trending_polls"
                placeholder="trending polls"
            ></x-admin.fields.text-field>
            <x-admin.fields.text-field
                name="trending_hashtags"
                placeholder="trending hashtags"
            ></x-admin.fields.text-field>
            <x-admin.fields.text-field
                name="most_shared_urls"
                placeholder="most shared urls"
            ></x-admin.fields.text-field>
            <!--form-group-->
        </div>
        <!--col-->
    </div>
    <!--row-->
</div>
<!--card-body-->

@section('page-script')
    <script type="text/javascript">
        XonBoard.Utils.documentReady(function () {
            XonBoard.Organizations.edit.init("{{ config('locale.languages.' . app()->getLocale())[1] }}");
        });
    </script>
@stop
