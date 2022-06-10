<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Organizations\UpdateOrganizationRequest;
use App\Http\Requests\Frontend\UpdateCsoRequest;
use App\Http\Responses\RedirectResponse;
use App\Models\Coalition\Coalition;
use App\Models\CsoUser;
use App\Models\Organization\Organization;
use App\Models\OrganizationCoalition\OrganizationCoalition;
use App\Repositories\Backend\Change\ChangeRepository;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function __construct(private ChangeRepository $repository)
    {
    }
    public function approval()
    {
        if(auth()->user())
            $cs=CsoUser::where('user_id',auth()->user()->id)->first();
        else
            $cs='';

        if(auth()->user()->approved_at && auth()->user()->status->value=='active')
            return redirect()->route('frontend.index');
        return view('frontend.approved', compact('cs'));
    }
    public function coalitions()
    {
        if(auth()->user())
            $cs=CsoUser::where('user_id',auth()->user()->id)->first();
        else
            $cs='';
        return view('frontend.dashboard2.dashboard' , compact('cs'));
    }

    public function coalitionsList()
    {
        if(auth()->user())
            $cs=CsoUser::where('user_id',auth()->user()->id)->first();
        else
            $cs='';
        $coalitions=Coalition::orderBy('name')->get();
        return view('frontend.dashboard2.table' , compact('cs','coalitions'));
    }
    public function index()
    {
        if(auth()->user())
        $cs=CsoUser::where('user_id',auth()->user()->id)->first();
        else
        $cs='';
        $list=Organization::select('starting_date','name')->get();
        return view('frontend.dashboard.overall',compact('list','cs'));
    }
    public function social()
    {
        if(auth()->user())
            $cs=CsoUser::where('user_id',auth()->user()->id)->first();
        else
            $cs='';
        return view('frontend.dashboard4.index',compact('cs'));


    }
    public function socialSecondPage()
    {
        if(auth()->user())
            $cs=CsoUser::where('user_id',auth()->user()->id)->first();
        else
            $cs='';
        return view('frontend.dashboard4.dashboard5',compact('cs'));
    }
    public function individual($slug)
    {
        if(auth()->user())
            $cs=CsoUser::where('user_id',auth()->user()->id)->first();
        else
            $cs='';
        $organization=Organization::where('slug',$slug)->firstorfail();
        $list=Organization::select('name','slug')->get();
        return view('frontend.dashboard.individual',compact('list','organization', 'cs'));
    }
    public function download()
    {
        return response()->download(public_path('/downloads/The_State_of_Civil_Society_in_Lebanon.pdf'));
    }
    public function thirdOverall()
    {

        if(auth()->user())
            $cs=CsoUser::where('user_id',auth()->user()->id)->first();
        else
            $cs='';

        return view('frontend.dashboard3.overall', compact('cs'));
    }
    public function updateCso($slug)
    {
        $organization=Organization::where('slug',$slug)->firstorfail();
        if(auth()->user())
            $cs=CsoUser::where('user_id',auth()->user()->id)->first();
        else
            $cs='';
        if($organization->id!=$cs->organization_id)
            abort(404);
        return view('frontend.dashboard.update-cso', compact('cs','organization'));
    }
    public function storeCso($id, UpdateCsoRequest $request)
    {
        $organization=Organization::find($id);
        $this->repository->create( $request->validated(),$organization->id);
        return new RedirectResponse(route('frontend.updateCso',$organization->slug), ['flash_success' =>'your Request is pending admin approval']);
    }

    public function thirdIndividual($slug)
    {
        if(auth()->user())
            $cs=CsoUser::where('user_id',auth()->user()->id)->first();
        else
            $cs='';
        $list=Organization::select('name','slug')->get();

        $organization=Organization::where('slug',$slug)->firstorfail();
        return view('frontend.dashboard3.individual',compact('organization','list' ,'cs'));
    }
    public function websiteCount(){
        return Organization::where('website','!=','')->count()/Organization::all()->count()*100;
    }
    public function sameOpinion($slug){
        $organization=Organization::where('slug',$slug)->firstorfail();

        return Organization::where('opinion_civil_state',$organization->opinion_civil_state)->
            where('opinion_neutrality',$organization->opinion_neutrality)->
            where('opinion_weapons',$organization->opinion_weapons)->
            where('decentralization',$organization->decentralization)->
            count()/Organization::all()->count()*100;
    }

    public function distributionData()
    {
        $list=Organization::all()->groupBy('type');
        $data = array();

        $i=0;
        foreach ($list as $type => $organization)
        {
            $names='';
            $j=1;
            foreach ($organization as $org)
            {
                if($j!=1 && $j%2==0)
                    $names.=', ';
                $names.=$org->name;
                if($j%2==0)
                    $names.='<br>';
                $j++;
            }
            $data['list'][$i]=$names;
            $data['count'][$i]=$organization->count();
            $data['type'][$i]=$type;
            $i++;
            //  array_push($data,$type,$organization->count());
        }
        return $data;
    }
    public function civilState()
    {
        $list=Organization::all()->groupBy('opinion_civil_state');
        $data = array();
        $i=0;
        foreach ($list as $type => $organization)
        {
            $data['count'][$i]=$organization->count();
            if($type=='with')
                $type='In favour of a civil state';
            else
                $type='Not in favour of a civil state';
            $data['type'][$i]=$type;
            $i++;
            //  array_push($data,$type,$organization->count());
        }
        return $data;

    }
    public function decentralizationChart()
    {
        $list=Organization::all()->groupBy('decentralization');
        $data = array();
        $i=0;
        foreach ($list as $type => $organization)
        {
            if($type=="")
                $type="No Opinion";
            $data['count'][$i]=$organization->count();
            $data['type'][$i]=$type;
            $i++;
            //  array_push($data,$type,$organization->count());
        }
        return $data;

    }
    public function neutrality()
    {
        $list=Organization::all()->groupBy('opinion_neutrality');
        $data = array();
        $i=0;
        foreach ($list as $type => $organization)
        {
            $names='';
            $j=1;
            foreach ($organization as $org)
            {
                if($j!=1 && $j%3==0)
                    $names.=', ';
                $names.=$org->name;
                if($j%3==0)
                    $names.='<br>';
                $j++;
            }
            $data['list'][$i]=$names;
            $data['count'][$i]=$organization->count();
            if($type=='with')
            {
                $data['type'][$i]='With Neutrality and Border Demarcation';
            }
            elseif ($type=='against')
            {
                $data['type'][$i]='With a state-sponsored Neutrality and border demarcation';
            }
            else {
                $data['type'][$i] = $type;
            }
            $i++;
            //  array_push($data,$type,$organization->count());
        }
        return $data;

    }
    public function registrationStatus()
    {
        $list=Organization::all()->groupBy('official_status');
        $data = array();
        $i=0;
        foreach ($list as $type => $organization)
        {
            $names='';
            $j=1;
            foreach ($organization as $org)
            {
                if($j!=1 && $j%2==0)
                    $names.=', ';
                $names.=$org->name;
                if($j%2==0)
                    $names.='<br>';
                $j++;
            }
            $data['list'][$i]=$names;
            $data['count'][$i]=$organization->count();
            if($type=='')
            {
                $data['type'][$i]='N/A';
            }
            else
            $data['type'][$i]=$type;
            $i++;
            //  array_push($data,$type,$organization->count());
        }
        return $data;
    }

    public function weaponsOpinion()
    {
        $list=Organization::all()->groupBy('opinion_weapons');
        $data = array();
        $i=0;
        foreach ($list as $type => $organization)
        {
            $names='';
            $j=1;
            foreach ($organization as $org)
            {
                if($j!=1 && $j%2==0)
                    $names.=', ';
                $names.=$org->name;
                if($j%2==0)
                    $names.='<br>';
                $j++;
            }
            $data['list'][$i]=$names;
            $data['count'][$i]=$organization->count();
            $data['type'][$i]=$type;
            $i++;
            //  array_push($data,$type,$organization->count());
        }
        return $data;
    }
    public function individualWeapons($slug)
    {
        $organization=Organization::where('slug',$slug)->firstorfail();

        if($organization->opinion_weapons=='no opinion about weapons')
            return ['val'=>0,'label'=>$organization->opinion_weapons];
        if($organization->opinion_weapons=="Weapon correlated with region status")
            return ['val'=>25,'label'=>$organization->opinion_weapons];
        if($organization->opinion_weapons=="With application of Taif Agreement")
            return ['val'=>50,'label'=>$organization->opinion_weapons];
        if($organization->opinion_weapons=="With defense strategy for \"the resistance\".")
            return ['val'=>75,'label'=>$organization->opinion_weapons];
        if($organization->opinion_weapons=="With immediate disarmament")
            return ['val'=>100,'label'=>$organization->opinion_weapons];

        return ['val'=>0,'label'=>$organization->opinion_weapons];

    }
    public function IndividualNeutrality($slug)
    {
        $organization=Organization::where('slug',$slug)->firstorfail();
        if($organization->opinion_neutrality=='no opinion')
            return ['val'=>0,'label'=>$organization->opinion_neutrality];
        if($organization->opinion_neutrality=="With a state-sponsored solution")
            return ['val'=>50,'label'=>$organization->opinion_neutrality];
        if($organization->opinion_neutrality=="With, unconditionally")
            return ['val'=>100,'label'=>$organization->opinion_neutrality];
    }
    public function economicPlan()
    {
        $list=Organization::all()->groupBy('economic_plan');
        $count=Organization::all()->count();
        $data = array();
        $i=0;
        foreach ($list as $type => $organization)
        {
            $data['count'][$i]=$organization->count();
            $data['type'][$i]=$type;
            $i++;
            //  array_push($data,$type,$organization->count());
        }
        return $data;
    }
    public function financing()
    {
        $list=Organization::all()->groupBy('financing_method');

        $count=Organization::all()->count();
        $data = array();
        $i=0;
        foreach ($list as $type => $organization)
        {
            $data['count'][$i]=round($organization->count()/$count*100);
            if($type=='')
            {
                $data['type'][$i]='No response';
            }
                else
            $data['type'][$i]=$type;
            $i++;
            //  array_push($data,$type,$organization->count());
        }
        return $data;
    }
    public function startingDate()
    {
        $list=Organization::orderBy('starting_date')->get();
//        $l=Organization::where('starting_date','2020')->count();
//ddd($l);
        $data = array();
        $d=array();
        $i=0;
        $y=array();
        $x=1;
        $year=0;
        foreach ($list as  $organization)
        {
            $d['0']['x']='starting date';

//            else {
if($organization->starting_date==$year) {
    $x=$x+15;
}
else
{
    $x=1;
}
$m1=ceil($x/30);
$m2=ceil(($x+15)/30);
$ddd1=$x%30;
            $ddd2=($x+15)%30;

            $dtToronto = Carbon::create($organization->starting_date,  $m1, $ddd1);
            $date=$dtToronto->timestamp;
        //    ddd($m1.$m2);
          //  $date = Carbon::createFromTimestamp($date);
          //  ddd($m1);
            $y[0] =$date*1000;
            $dtToronto1 = Carbon::create($organization->starting_date, $m2, $ddd2);
            $date1=$dtToronto1->timestamp;
            $y[1] =  $date1*1000;
            $d['0']['y']=$y;
//            }

            $data[$i]['name']=$organization->name;
            $data[$i]['data']=$d;
            $i++;
            $year=$organization->starting_date;

//        $list=Organization::all();
//        $data = array();
//        $i=0;
//        foreach ($list as  $organization)
//        {
//            $data[$i]['x']=$i;
//            if($organization->starting_date<2004)
//            {
//                $data[$i]['y']=2004;
//                $data[$i]['date']=$organization->starting_date;
//
//            }
//            else {
//                $data[$i]['y'] = $organization->starting_date;
//                $data[$i]['date'] = $organization->starting_date;
//            }
//
//            $data[$i]['name']=$organization->name;
//            $i++;
            //  array_push($data,$type,$organization->count());
        }
        return $data;
    }
    public function getCoalitions()
    {
        $list=Organization::all();
        $data = array();
        $i=0;
        foreach ($list as  $organization)
        {
            $data['id']=$organization->id;
            $data['Strength']=$i;
            $data['selected']='false';
            $data['name']=$organization->name;
            $data['NodeType']='RedWine';

            //  array_push($data,$type,$organization->count());
            $d['x']=rand(1,2000);
            $d['y']=rand(1,1000);
            $ddd['position']=$d;
            $ddd['data']=$data;
            $dd[$i]=$ddd;
            $starting_id=$organization->id;
            $i++;
        }
        $coalitions=Coalition::all();
        foreach ($coalitions as $coalition)
        {
            $data['id']=$coalition->id+$starting_id;
            $data['Strength']=70;
            $data['selected']='false';
            $data['name']=$coalition->name;
            $data['NodeType']='WhiteWine';

            //  array_push($data,$type,$organization->count());
            $d['x']=rand(1,2000);
            $d['y']=rand(1,1000);
            $ddd['position']=$d;
            $ddd['data']=$data;
            $dd[$i]=$ddd;
            $starting_id2=$coalition->id;
            $i++;

        }
        $id=$starting_id2+$starting_id;
$connections=OrganizationCoalition::all();
$j=0;
        foreach ($connections as $connection)
        {
                            $edge['id'] = $id+$connection->id;
                $edge['source']=$connection->organization_id;
               $edge['selected']='false';
               $edge['target']=$connection->coalition_id+$starting_id;
               $info['data']=$edge;
              $edges[$j]=$info;
              $j++;
        }
        $nodes['nodes']=$dd;
        $nodes['edges']=$edges;
        return $nodes;
    }
    public function home()
    {
        return view('frontend.index' );

    }
    public function coals()
    {
        $coalition1 = Coalition::create([
            'name' => 'Revolution Coordination Commission Oct-19'
        ]);
        $coalition2 = Coalition::create([
            'name' => 'Revolution Coordination Commission Dec-19'
        ]);
        $coalition3 = Coalition::create([
            'name' => 'Daleel Thawra - 2019'
        ]);
        $coalition4 = Coalition::create([
            'name' => 'National Civic Front'
        ]);
        $coalition5 = Coalition::create([
            'name' => 'The Initiative - Drabzeen'
        ]);
        $coalition6 = Coalition::create([
            'name' => 'Civilian Front Alliance'
        ]);
        $coalition7 = Coalition::create([
            'name' => 'Electoral Groups for the Council of Candidates of Groups of the Revolution'
        ]);
        $coalition8 = Coalition::create([
            'name' => 'National Rescue Initiative'
        ]);
        $coalition9 = Coalition::create([
            'name' => 'National Help/support convention'
        ]);
        $coalition10 = Coalition::create([
            'name' => 'University Students Support Coalision'
        ]);
        $coalition11 = Coalition::create([
            'name' => '6th of December front'
        ]);
        $coalition12 = Coalition::create([
            'name' => 'The Pulse'
        ]);
        $coalition13 = Coalition::create([
            'name' => 'Field group alliance'
        ]);
        $coalition14 = Coalition::create([
            'name' => 'Video Expats Coalition'
        ]);
        $coalition15 = Coalition::create([
            'name' => 'Activist Key1'
        ]);
        $coalition16 = Coalition::create([
            'name' => 'Activist Key 2'
        ]);
        $coalition17 = Coalition::create([
            'name' => 'Activist Key 3'
        ]);
        $coalition18 = Coalition::create([
            'name' => 'Collective Video'
        ]);
        $coalition19 = Coalition::create([
            'name' => 'Meeting with Shinker'
        ]);
        $organizations = Organization::all();
        foreach ($organizations as $organization) {
            if ($organization->revolution_oct_19 == 'Yes') {
                OrganizationCoalition::create([
                    'organization_id' => $organization->id,
                    'coalition_id' => $coalition1->id
                ]);
            }
            if ($organization->revolution_dec_19 == 'Yes') {
                OrganizationCoalition::create([
                    'organization_id' => $organization->id,
                    'coalition_id' => $coalition2->id
                ]);
            }
            if ($organization->daleel_thawra_2019 == 'Yes') {
                OrganizationCoalition::create([
                    'organization_id' => $organization->id,
                    'coalition_id' => $coalition3->id
                ]);
            }
            if ($organization->national_civic_front == 'Yes') {
                OrganizationCoalition::create([
                    'organization_id' => $organization->id,
                    'coalition_id' => $coalition4->id
                ]);
            }
            if ($organization->the_initiative == 'Yes') {
                OrganizationCoalition::create([
                    'organization_id' => $organization->id,
                    'coalition_id' => $coalition5->id
                ]);
            }
            if ($organization->civil_front_alliance == 'Yes') {
                OrganizationCoalition::create([
                    'organization_id' => $organization->id,
                    'coalition_id' => $coalition6->id
                ]);
            }
            if ($organization->electoral_groups == 'Yes') {
                OrganizationCoalition::create([
                    'organization_id' => $organization->id,
                    'coalition_id' => $coalition7->id
                ]);
            }
            if ($organization->national_rescue_initiative == 'Yes') {
                OrganizationCoalition::create([
                    'organization_id' => $organization->id,
                    'coalition_id' => $coalition8->id
                ]);
            }
            if ($organization->national_help_convention == 'Yes') {
                OrganizationCoalition::create([
                    'organization_id' => $organization->id,
                    'coalition_id' => $coalition9->id
                ]);
            }
            if ($organization->university_students_support_coalision == 'Yes') {
                OrganizationCoalition::create([
                    'organization_id' => $organization->id,
                    'coalition_id' => $coalition10->id
                ]);
            }
            if ($organization->{'6th_dec_front'} == 'Yes') {
                OrganizationCoalition::create([
                    'organization_id' => $organization->id,
                    'coalition_id' => $coalition11->id
                ]);
            }
            if ($organization->the_pulse == 'Yes') {
                OrganizationCoalition::create([
                    'organization_id' => $organization->id,
                    'coalition_id' => $coalition12->id
                ]);
            }
            if ($organization->field_group_alliance == 'Yes') {
                OrganizationCoalition::create([
                    'organization_id' => $organization->id,
                    'coalition_id' => $coalition13->id
                ]);
            }
            if ($organization->video_expats_coalition == 'Yes') {
                OrganizationCoalition::create([
                    'organization_id' => $organization->id,
                    'coalition_id' => $coalition14->id
                ]);
            }
            if ($organization->activist_key_1 == 'Yes') {
                OrganizationCoalition::create([
                    'organization_id' => $organization->id,
                    'coalition_id' => $coalition15->id
                ]);
            }
            if ($organization->activist_key_2 == 'Yes') {
                OrganizationCoalition::create([
                    'organization_id' => $organization->id,
                    'coalition_id' => $coalition16->id
                ]);
            }
            if ($organization->activist_key_3 == 'Yes') {
                OrganizationCoalition::create([
                    'organization_id' => $organization->id,
                    'coalition_id' => $coalition17->id
                ]);
            }
            if ($organization->collective_video == 'Yes') {
                OrganizationCoalition::create([
                    'organization_id' => $organization->id,
                    'coalition_id' => $coalition18->id
                ]);
            }
            if ($organization->meeting_with_shinker == 'Yes') {
                OrganizationCoalition::create([
                    'organization_id' => $organization->id,
                    'coalition_id' => $coalition19->id
                ]);
            }
        }
        ddd('success');
    }
    public function socialMediaFrequency()
    {
        $twittter=Organization::whereNotNull('twitter_username')->count();
        $fb=Organization::whereNotNull('fb_username')->count();
        $insta=Organization::whereNotNull('insta_username')->count();
        $all=Organization::count();
        $data = array();
        $data['count'][0]=round($twittter/$all*100);
        $data['type'][0]='Twitter';
        $data['count'][1]=round($fb/$all*100);
        $data['type'][1]='Facebook';
        $data['count'][2]=round($insta/$all*100);
        $data['type'][2]="Instagram";
//        foreach ($list as $type => $organization)
//        {
//            $data['count'][$i]=$organization->count();
//            if($type=='with')
//                $type='In favour of a civil state';
//            else
//                $type='Not in favour of a civil state';
//            $data['type'][$i]=$type;
//            $i++;
//            //  array_push($data,$type,$organization->count());
//        }
        return $data;

    }
    public function socialMediaPresence()
    {

        $all=Organization::all();
        $count=Organization::count();
        $data = array();
        $data['count'][0]=0;
        $data['type'][0]='0';
        $data['count'][1]=0;
        $data['type'][1]='1';
        $data['count'][2]=0;
        $data['type'][2]="2";
        $data['count'][3]=0;
        $data['type'][3]="3";
        foreach ($all as $organization)
        {
            $i=0;
           if($organization->twitter_username!=null)
               $i++;
            if($organization->fb_username!=null)
                $i++;
            if($organization->insta_username!=null)
                $i++;
            $data['count'][$i]++;
            //  array_push($data,$type,$organization->count());
        }
        $data['count'][0]= round($data['count'][0]/$count*100);
        $data['count'][1]= round($data['count'][1]/$count*100);
        $data['count'][2]= round($data['count'][2]/$count*100);
        $data['count'][3]= round($data['count'][3]/$count*100);

        return $data;
    }
    public function socialMediaScore()
    {
        $all=Organization::orderBY('overall_score','desc')->get();
        $data = array();
        $i=0;
        foreach ($all as $organization)
        {

            $data['first'][$i]=$organization->overall_score;
            if($organization->overall_score==null)
                $data['first'][$i]=0;
            $data['second'][$i]=$organization->activity_score;
            if($organization->activity_score==null)
                $data['second'][$i]=0;
            $data['third'][$i]=$organization->popularity_score;
            if($organization->popularity_score==null)
                $data['third'][$i]=0;
            $data['type'][$i]=$organization->name;
            $i++;
            //  array_push($data,$type,$organization->count());
        }
        return $data;
    }
    public function fblikes()
    {

        $all=Organization::orderBY('fb_likes','desc')->get();
        $data = array();
        $i=0;
        foreach ($all as $organization)
        {

            $data['count'][$i]=$organization->fb_likes;
            if($organization->fb_likes==null)
                $data['count'][$i]=0;

            $data['type'][$i]=$organization->name;
            $i++;
            //  array_push($data,$type,$organization->count());
        }
        return $data;

    }
    public function instaFollowers()
    {

        $all=Organization::orderBY('insta_followers','desc')->get();
        $data = array();
        $i=0;
        foreach ($all as $organization)
        {

            $data['count'][$i]=$organization->insta_followers;
            if($organization->insta_followers==null)
                $data['count'][$i]=0;

            $data['type'][$i]=$organization->name;
            $i++;
            //  array_push($data,$type,$organization->count());
        }
        return $data;

    }
    public function twitterFollowers()
    {

        $all=Organization::orderBY('twitter_followers','desc')->get();
        $data = array();
        $i=0;
        foreach ($all as $organization)
        {

            $data['count'][$i]=$organization->twitter_followers;
            if($organization->twitter_followers==null)
                $data['count'][$i]=0;

            $data['type'][$i]=$organization->name;
            $i++;
            //  array_push($data,$type,$organization->count());
        }
        return $data;

    }
}
