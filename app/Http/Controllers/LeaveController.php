<?php

namespace App\Http\Controllers;

use App\User;
use App\Leave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\LeaveRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\LeaveRejectNotification;
use App\Mail\LeaveApprovalNotification;
use RealRashid\SweetAlert\Facades\Alert;

class LeaveController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        if(Auth::user()->role=='admin') {
            $leaves = Leave::orderBy('id', 'DESC')->paginate(5);
        }else{
            $leaves =  Auth::user()->leave()->paginate(5);
        }
//        $user = Auth::user();
        return view('leave-mgt.index',compact('leaves','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $leaves = Leave::all();
        return view('leave-mgt.create', compact('leaves'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LeaveRequest $request)
    {
        Leave::create([
            'employee_id'   => Auth::id(),
            'leave_type'    => $request->leave_type,
            'date_from'     => $request->date_from,
            'date_to'       => $request->date_to,
            'days'          => $request->days,
            'reason'        => $request->reason,
            'reference_no'        => 'EMS-' . $this->randGen(8),
        ]);


        return redirect()->intended('leave')->with('success', 'Leave successfully requested to Admin!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $leaves =Leave::where('leave_type', 'LIKE',"%{$request->search}%")->paginate();

        return view('leave-mgt.index',compact('leaves'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function edit(Leave $leave)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Leave $leave)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */

    public function approve(Request $request,$id)
    {
        $leave = Leave::find($id);

       if($leave){
           try{
            $leave->is_approved = $request->approve;
            $leave->save();
            Mail::to($leave->users->email)->send(new LeaveApprovalNotification($leave));
            return redirect()->back()->with('success', 'Leave approved by Admin!');
           }catch (\Exception $e){
               return ('Error approving leave!');
           }

       }

    }

    public function reject(Request $request,$id)
    {
        $leave = Leave::find($id);

       if($leave){
           try {
            $leave->is_approved = $request->approve;
            $leave->save();
            Mail::to($leave->users->email)->send(new LeaveRejectNotification($leave));
            Alert::success('Leave rejected by Admin!');
            return redirect()->back();
           } catch (\Exception $e) {
                return ('Error rejecting leave!');
           }

       }
    }

    public function paid(Request $request,$id)
    {
        $leave = Leave::find($id);
        if($leave){
            try {
                $leave->leave_type_offer = $request->paid;
                $leave->save();
                return redirect()->back()->with('success', 'Leave with pay!');
            } catch (\Excepion $e) {
                return ('Error approving leave with pay! Try again later.');
            }

        }
    }

    public function unpaid(Request $request,$id)
    {
        $leave = Leave::find($id);
        if($leave){
            try {
                $leave->leave_type_offer = $request->paid;
                $leave->save();
                return redirect()->back()->with('warning', 'Leave without pay!');
            } catch (\Exception $e) {
                return ('Something went wrong approving leave without pay!');
            }

        }
    }

    public function randGen($length)
    {
        $id = '';
        for ($i = 0; $i < $length; $i++) {
            $id .= mt_rand(0, $length);
        }
        return ($id);
    }
}
