<?php

namespace App\Http\Controllers; // use App\Http\Controllers\blsappointerController;

/**
 * Dependencies 
 */
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\applicant;

class blsappointerController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function dashboard()
    {
        $user = Auth::user();
        $path = "Dashboard";
        $sub_path = "None";
        return view("dashboard", [
            "username" => $user->name,
            "email"    => $user->email,
            "path"     => $path,
            "sub_path" => $sub_path
        ]);
    }
    public function applicants()
    {
        $user = Auth::user();
        $path = "Applicants";
        $sub_path = "Waiting list";

        return view("waiting_list", [
            "username" => $user->name,
            "email"    => $user->email,
            "path"     => $path,
            "sub_path" => $sub_path
        ]);
    }

    public function add_new(Request $request)
    {
        $user = Auth::user();
        $path = "Applicants";
        $sub_path = "Add new";
        return view("add_new", [
            "username" => $user->name,
            "email"    => $user->email,
            "path"     => $path,
            "sub_path" => $sub_path 
        ]);
    }

    public function submitnewapplicants(Request $request, applicant $applicant)
    {
        if($request->hasFile('applicantfile'))
        {
            if($request->applicantfile->getClientOriginalExtension() == "csv" && $request->applicantfile->isValid())
            {
                $type = "Individual";
                $file_name = fopen($request->applicantfile,"r");
                while($row = fgetcsv($file_name))
                {
                    $file[] = $row;
                }
                fclose($file_name);

                $family_count = count($file);

                if($family_count > 1)
                {
                    $type = "Family";
                } 
            
                $person = [];
                $person["family_name"] = $file[0][0];
                $person["first_name"] = $file[0][1];
                $person["passport"] = $file[0][2];
                $person["born"] = $file[0][3];
                $person["PhoneNumber"] = $file[0][4];
                $person["gmail"] = $file[0][5];
                $person["password"] = $file[0][6];
                $person["passportsub"] = $file[0][7];
                $person["passportex"] = $file[0][8];
                $person["passportplace"] = $file[0][9];
                $person["passwordbls"] = $file[0][10];
                $person["companions"] = NULL;
                if($type == "Family")
                {
                    foreach($file as $key => $value)
                    {
                        if($key == 0 ) continue;
                        $member = [];
                        $member["family_name"] = $value[0];
                        $member["first_name"] = $value[1];
                        $member["passport"] = $value[2];
                        $member["born"] = $value[3];
                        $person["companions"][] = $member;
                    } 
                }
                $passport_match = applicant::where('passportnum', $person["passport"])->first();
                if($passport_match != NULL) return back()->with('error', 'Passport Number match');
                
                $phone_match = applicant::where('phonenum', $person["PhoneNumber"])->first();
                if($phone_match != NULL) return back()->with('error', 'Phone Number match');
                
                $gmail_match = applicant::where('gmail', $person["gmail"])->first();
                if($gmail_match != NULL) return back()->with('error', 'gmail match');
            
                $applicant->applicants    = $person;
                $applicant->gmail         = $person["gmail"];
                $applicant->passportnum   = $person["passport"];
                $applicant->phonenum      = $person["PhoneNumber"];
                $applicant->password      = $person["password"];
                $applicant->passportex    = $person["passportex"];
                $applicant->passportsub   = $person["passportsub"];
                $applicant->passportplace = $person["passportplace"];
                $applicant->password_bls  = $person["passwordbls"];
                $applicant->type          = $type;//$family_count
                $applicant->members_count = $family_count;
                $applicant->save();
                
                return back()->with('success', 'File uploaded go check <a href="/applicants/waiting-list">waiting list</a>');
            }else
            {
                return back()->with('error', '<span style=font-weight:bold;">Error!! check type of file \'csv\'</span>');
            }
        }else
        {
            return back()->with('error', '<span style=font-weight:bold;">Error!! empty request</span>');
        }
    }

    
}
