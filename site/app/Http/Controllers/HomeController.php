<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VisitorModel;
use App\Models\ServicesModel;
use App\Models\CourseModel;
use App\Models\ProjectsModel;

class HomeController extends Controller
{
    function HomeIndex(){

        $UserIP=$_SERVER['REMOTE_ADDR'];
        date_default_timezone_set("Asia/Dhaka");
        $timeDate=date("Y-m-d h:i:sa");

        VisitorModel::insert(['ip_address'=>$UserIP,'visit_time'=>$timeDate]);
        

        $servicesData=json_decode(ServicesModel::all());
        $CoursesData=json_decode(CourseModel::orderBy('id','desc')->limit(6)->get());
        $ProjectData=json_decode(ProjectsModel::orderBy('id','desc')->limit(10)->get());
        return view('Home',[
            'servicesData'=>$servicesData,
            'CoursesData'=>$CoursesData,
            'ProjectData'=>$ProjectData
        ]);
    }
}
