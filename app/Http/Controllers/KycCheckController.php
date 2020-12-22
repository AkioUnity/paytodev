<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Knowyc;
use Carbon\Carbon;

class KycCheckController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $kyc = Knowyc::where('status', "unconfirmed")->where('users', null)->first();
        if ($kyc == null) {
            $kyc = Knowyc::where('status', "Pending")->where('users', null)->first();
            if ($kyc == null) {
                return view('KYC.approve');
            }
        }
        $kyc->users = "active";
        $kyc->save();
        $kyc->pic_passport = $this->getImagewithdim($kyc->pic_passport);
        $kyc->pic_portrait = $this->getImage($kyc->pic_portrait);
        $count = Knowyc::count();
        $kyc->pre = $kyc->id - 1;
        $kyc->post = $count - $kyc->id;
        
        return view('KYCCheck.index')->withInfo($kyc);
    }

    public function ApproveStatus($id)
    {
        $kyc = Knowyc::find($id);
        $kyc->status = "Approved";
        $kyc->users = null;
        $kyc->save();
    
        return redirect()->route('kyccheck');
    }

    public function refresh()
    {
        $kyc = Knowyc::where('users', "active")->update(array('users' => null));

        return redirect()->route('kyccheck');
    }
    
    public function getPending()
    {
        $kyc = Knowyc::where('status', "Pending")->first();
        $kyc->pic_passport = $this->getImagewithdim($kyc->pic_passport);
        $kyc->pic_portrait = $this->getImage($kyc->pic_portrait);
        $count = Knowyc::count();
        $kyc->pre = $kyc->id - 1;
        $kyc->post = $count - $kyc->id;
       
        return view('KYCCheck.index')->withInfo('$kyc');
    }

    public function PendingStatus($id)
    {
        $kyc = Knowyc::find($id);
        $kyc->status = "Pending";
        $kyc->users = null;
        $kyc->save();
    
        return redirect()->route('kyccheck');
    }

    public function RejectStatus($id)
    {
        $kyc = Knowyc::find($id);
        $kyc->status = "Reject";
        $kyc->users = null;
        $kyc->save();
    
        return redirect()->route('kyccheck');
    }
    
    public function updateNote(Request $request)
    {
        $kyc = Knowyc::where('users', "active")->first();
        $kyc->note = $request->comment;
        $kyc->save();
        $kyc->pic_passport = $this->getImagewithdim($kyc->pic_passport);
        $kyc->pic_portrait = $this->getImage($kyc->pic_portrait);
        $count = Knowyc::count();
        $kyc->pre = $kyc->id - 1;
        $kyc->post = $count - $kyc->id;
        
        return view('KYCCheck.index')->withInfo($kyc);
    }

    
    public function getNext($id)
    {
        $kyc = Knowyc::find($id);
        $kyc->users = null;
        $kyc->save();

        $kyc = Knowyc::find($id+1);
        $kyc->users = "active";
        $kyc->save();
        $kyc->pic_passport = $this->getImagewithdim($kyc->pic_passport);
        $kyc->pic_portrait = $this->getImage($kyc->pic_portrait);
        $count = Knowyc::count();
        $kyc->pre = $kyc->id - 1;
        $kyc->post = $count - $kyc->id;
        
        return view('KYCCheck.index')->withInfo($kyc);
    }

        
    public function getPrevious($id)
    {
        $kyc = Knowyc::find($id);
        $kyc->users = null;
        $kyc->save();

        $kyc = Knowyc::find($id-1);
        $kyc->users = "active";
        $kyc->save();
        $kyc->pic_passport = $this->getImagewithdim($kyc->pic_passport);
        $kyc->pic_portrait = $this->getImage($kyc->pic_portrait);
        $count = Knowyc::count();
        $kyc->pre = $kyc->id - 1;
        $kyc->post = $count - $kyc->id;
        
        return view('KYCCheck.index')->withInfo($kyc);
    }

    public function getImagewithdim($name)
    {
        $url[0] = Storage::disk('s3')->temporaryUrl(
            $name,
        
            Carbon::now()->addSeconds(5)
        );

        list($width, $height) = getimagesize($url[0]);
        
        if ($width > $height) {
            $url['width'] = 300;
            $url['height'] = $height/$width*300;
        } else {
            $url['height'] = 300;
            $url['width'] = $width/$height*300;
        }

        return $url;
    }

    public function getImage($name)
    {
        $url = Storage::disk('s3')->temporaryUrl(
            $name,
        
            Carbon::now()->addSeconds(5)
        );

        return $url;
    }
}
