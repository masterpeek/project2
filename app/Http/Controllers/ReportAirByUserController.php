<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp;
use Illuminate\Support\Facades\DB;
use App\ReportAirByUser;
use Stichoza\GoogleTranslate\TranslateClient;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ReportAirByUserController extends Controller
{
    public function getAir(Request $request)
    {
        $tr = new TranslateClient();

        $air = $request->all();

        $image = $request->file('PicPath')->getPathname();
        $fileName = $image[0]->getClientOriginalName();
        Storage::put('upload/images/' . $fileName, file_get_contents(
            $request->file('PicPath')->getRealPath()
        ));


       //DB::table('report_air_by_user')
         //->where('air_picture', $imageTempName)
           //->update(['air_picture' => $imageName]);

        $latitude = doubleval($air['Latitude']);
        $longitude = doubleval($air['Longitude']);

        $lat = $air['Latitude'];
        $long = $air['Longitude'];

        $client = new GuzzleHttp\Client();

        $res = $client->request('GET', 'https://maps.googleapis.com/maps/api/geocode/json?latlng='.$lat.','.$long.'&key=AIzaSyBuNhJ7nKSLGV63AaNIls6M41Xu3kgK8Ss');
        $store = $res->getBody()->getContents();
        $ans = GuzzleHttp\json_decode($store);

        $air_area_name =  explode(",", $ans->results[0]->formatted_address);

        $air_province_name = explode(",",$ans->results[0]->formatted_address);

        $check = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "Chang Wat", "มหานคร", "ฯ", "จ.");

        $air_province_name1 = str_replace($check,"",$air_province_name[3]);

        $area1 = $tr->setSource('en')->setTarget('th')->translate($air_area_name[1]);
        $area2 = $tr->setSource('en')->setTarget('th')->translate($air_area_name[2]);

        $province = $tr->setSource('en')->setTarget('th')->translate($air_province_name1);

        $check2 = array("มหานคร", "ฯ", "จ.");

        $province1 = str_replace($check2,"",$province);

        $check3 = array("ตำบล");

        $area1_1 = str_replace($check3, "ต.", $area1);

        $check4 = array("อำเภอ");

        $area2_2 = str_replace($check4, "อ.", $area2);

        $data = [];
        $data['air_picture'] = $fileName;
        $data['air_smell'] = $air['SmellChoice'];
        $data['air_pollution'] = $air['PollutionChoice'];
        $data['air_comment'] = $air['Detail'];
        $data['air_lat'] = $latitude;
        $data['air_long'] = $longitude;
        $data['air_area_name'] = $area1_1." ".$area2_2;
        $data['air_province_name'] = $province1;

        $date = time();
        $data['air_thai_date'] = $this->thai_date_and_time($date);

        $data['user_id'] = intval($air['UserId']);

        ReportAirByUser::create($data);

    }

    public function thai_date_and_time($time)
    {   // 19 ธันวาคม 2556 เวลา 10:10:43
        $thai_date_return = "";

        $thai_day_arr=array("อาทิตย์","จันทร์","อังคาร","พุธ","พฤหัสบดี","ศุกร์","เสาร์");

        $thai_month_arr=array(
            "0"=>"",
            "1"=>"มกราคม",
            "2"=>"กุมภาพันธ์",
            "3"=>"มีนาคม",
            "4"=>"เมษายน",
            "5"=>"พฤษภาคม",
            "6"=>"มิถุนายน",
            "7"=>"กรกฎาคม",
            "8"=>"สิงหาคม",
            "9"=>"กันยายน",
            "10"=>"ตุลาคม",
            "11"=>"พฤศจิกายน",
            "12"=>"ธันวาคม"
        );

        $thai_month_arr_short=array(
            "0"=>"",
            "1"=>"ม.ค.",
            "2"=>"ก.พ.",
            "3"=>"มี.ค.",
            "4"=>"เม.ย.",
            "5"=>"พ.ค.",
            "6"=>"มิ.ย.",
            "7"=>"ก.ค.",
            "8"=>"ส.ค.",
            "9"=>"ก.ย.",
            "10"=>"ต.ค.",
            "11"=>"พ.ย.",
            "12"=>"ธ.ค."
        );

        $thai_date_return.= date("j",$time);
        $thai_date_return.= " ".$thai_month_arr_short[date("n",$time)];
        $thai_date_return.= " ".(date("Y",$time)+543);
        $thai_date_return.= " เวลา ".date("H:i:s",$time)." น.";

        return $thai_date_return;

    }

    public function reportAirNearby(Request $request)
    {
        $ans = "";

        $data = $request->all();

        $lat = $data["Latitude"];
        $lng = $data["Longitude"];
        $distance = $data["Distance"];

        $result = DB::select('select report_air_by_user.id,
        report_air_by_user.air_smell, 
        report_air_by_user.air_area_name, report_air_by_user.air_province_name,  
        report_air_by_user.air_lat, report_air_by_user.air_long, 
        (6371 * acos(cos(radians(' . $lat . ')) * cos(radians(report_air_by_user.air_lat)) 
        * cos(radians(report_air_by_user.air_long ) - radians(' . $lng . ')) 
        + sin(radians(' . $lat .')) * sin(radians(report_air_by_user.air_lat)))) as distance
        from report_air_by_user having distance <= '. $distance .' order by distance limit 1');

        if($result != null)
        {
            $ans = $ans.$result[0]->air_smell.";".$result[0]->air_area_name.";".$result[0]->air_province_name.";".
            $result[0]->id.";".number_format($result[0]->distance, 2);

            return $ans;
        }
        else
        {
            return "no result";
        }

    }

    public function showAir()
    {
        $arrAir["arrAir"] = [];

        $all_airs = ReportAirByUser::all();

        foreach ($all_airs as $all_air){
            array_push($arrAir["arrAir"], $all_air);
        }

        return $arrAir;
    }

    public function deleteAir()
    {
        $query = "TRUNCATE TABLE report_air_by_user";

        ReportAirByUser::getQuery($query)->delete();

    }

    public function deleteAirMarker(Request $request)
    {
        $data = $request->all();

        $id = $data["Id"];

        ReportAirByUser::where('id', $id)->delete();
    }


    public function maps()
    {
        $markers = ReportAirByUser::all();

        return view('report_air_maps')->with('markers', $markers);
    }

    public function index()
    {
        $datas = ReportAirByUser::orderBy('created_at', 'DESC')->take(8)->get();

        return view('index_report_air')->with('datas', $datas);
    }

    public function viewAll()
    {
        $datas = ReportAirByUser::orderBy('created_at', 'DESC')->get();

        return view('index_report_air')->with('datas', $datas);
    }

    public function show($id)
    {
        $data = ReportAirByUser::where('id', $id)->get()->first();

        return view('show_report_air')->with('data', $data);
    }

    public function search()
    {
        $input = Input::all();

        $datas = ReportAirByUser::where('air_province_name', $input['province'])
            ->orderBy('created_at', 'DESC')->get();

        return view('index_report_air')->with('datas', $datas);

    }

    public function updateAir(Request $request)
    {
        $data = $request->all();

        $id = intval($data["ID"]);

        $choice = $data["Choice"];

        if($choice == "0")
        {
            ReportAirByUser::where('id', $id)->delete();
        }
        else if($choice == "2")
        {
            $air = ReportAirByUser::where('id', $id)->get();

            if($air[0]->air_pollution == "เล็กน้อย")
            {
                ReportAirByUser::where('id', $id)->update(['air_pollution' => 'ปานกลาง']);
            }
            else if($air[0]->air_pollution  == "ปานกลาง")
            {
                ReportAirByUser::where('id', $id)->update(['air_pollution' => 'รุนแรง']);
            }
            else if($air[0]->air_pollution  == "รุนแรง")
            {
                ReportAirByUser::where('id', $id)->update(['air_pollution' => 'รุนแรง']);
            }
        }
    }

    public function select_condition_air()
    {
        $input = Input::all();

        $condition = $input["condition"];

        if($condition === "ทั้งหมด")
        {
            $markers = ReportAirByUser::all();
        }
        else
        {
            $markers = ReportAirByUser::where('air_pollution', $condition)->get();
        }

        return view('report_air_maps')->with('markers', $markers);
    }


}
