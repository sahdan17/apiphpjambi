<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pressure;
use App\Models\FlowData;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Exports\PressureDataExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;

class PressController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function getPressure(Request $request) {
        $selectedDate = $request->date;
        $nextDay = Carbon::parse($selectedDate)->addDay();
        $first = $request->first;
        
        if ($first) {
            $pressures = Pressure::where('idSpot', $request->idSpot)
                ->where('timestamp', '>=', $selectedDate)
                ->where('timestamp', '<', $nextDay)
                ->get();
        } else {
            $pressures = Pressure::where('idSpot', $request->idSpot)
                ->where('timestamp', '>=', $selectedDate)
                ->where('timestamp', '<', $nextDay)
                ->orderBy('timestamp', 'desc')
                ->limit(5)
                ->get()
                ->reverse()
                ->values();
        }
                
        return response()->json([
            'id' => $request->idSpot,
            'selectedDate' => $selectedDate,
            'pressures' => $pressures,
        ]);
    }
    
    public function getPressureNext(Request $request) {
        $selectedDate = $request->date;
        $nextDay = Carbon::parse($selectedDate)->addDay();
        
        $pressures = Pressure::where('idSpot', $request->idSpot)
                ->where('timestamp', '>=', $selectedDate)
                ->where('timestamp', '<', $nextDay)
                ->orderBy('timestamp', 'desc')
                ->limit(5)
                ->get()
                ->reverse()
                ->values();
                
        return response()->json([
            'id' => $request->idSpot,
            'selectedDate' => $selectedDate,
            // 'max' => $max->max,
            'pressures' => $pressures,
        ]);
    }
    
    public function getSEMFOLIndex(Request $request) {
        $selectedDate = $request->date;
        $idSpot = $request->idSpot;
        $idSpotMod = $request->idSpot;
        $first = $request->first;
        
        if ($idSpot == 15) {
            $idSpotMod = 1;
        } elseif ($idSpot == 16) {
            $idSpotMod = 1;
        } elseif ($idSpot == 11) {
            $idSpotMod = 10;
        } elseif ($idSpot == 12) {
            $idSpotMod = 10;
        } elseif ($idSpot == 13) {
            $idSpotMod = 10;
        } elseif ($idSpot == 6) {
            $idSpotMod = 5;
        } elseif ($idSpot == 7) {
            $idSpotMod = 5;
        }
        
        $nextDay = Carbon::parse($selectedDate)->addDay();
        
        if ($first) {
            $pressures = Pressure::where('idSpot', $request->idSpot)
                ->where('timestamp', '>=', $selectedDate)
                ->where('timestamp', '<', $nextDay)
                ->get();

            $sem = FlowData::where('idSpot', $idSpotMod)
                ->where('timestamp', '>=', $selectedDate)
                ->where('timestamp', '<', $nextDay)
                ->get();
        } else {
            $pressures = Pressure::where('idSpot', $request->idSpot)
                ->where('timestamp', '>=', $selectedDate)
                ->where('timestamp', '<', $nextDay)
                ->orderBy('timestamp', 'desc')
                ->limit(5)
                ->get()
                ->reverse()
                ->values();

            $sem = FlowData::where('idSpot', $idSpotMod)
                ->where('timestamp', '>=', $selectedDate)
                ->where('timestamp', '<', $nextDay)
                ->orderBy('timestamp', 'desc')
                ->limit(5)
                ->get()
                ->reverse()
                ->values();
        }

        return response()->json([
            'id' => $request->idSpot,
            'selectedDate' => $selectedDate,
            'pressures' => $pressures,
            'sem' => $sem,
        ]);
    }
    
    public function getSEMFOLNext(Request $request) {
        $selectedDate = $request->date;
        $idSpot = $request->idSpot;
        $idSpotMod = $request->idSpot;
        
        if ($idSpot == 15) {
            $idSpotMod = 1;
        } elseif ($idSpot == 16) {
            $idSpotMod = 1;
        } elseif ($idSpot == 11) {
            $idSpotMod = 10;
        } elseif ($idSpot == 12) {
            $idSpotMod = 10;
        } elseif ($idSpot == 13) {
            $idSpotMod = 10;
        } elseif ($idSpot == 6) {
            $idSpotMod = 5;
        } elseif ($idSpot == 7) {
            $idSpotMod = 5;
        }
        
        $nextDay = Carbon::parse($selectedDate)->addDay();
        
        $pressures = Pressure::where('idSpot', $idSpot)
                ->where('timestamp', '>=', $selectedDate)
                ->where('timestamp', '<', $nextDay)
                ->orderBy('timestamp', 'desc')
                ->limit(5)
                ->get()
                ->reverse()
                ->values();
                
        $sem = FlowData::where('idSpot', $idSpotMod)
                ->where('timestamp', '>=', $selectedDate)
                ->where('timestamp', '<', $nextDay)
                ->orderBy('timestamp', 'desc')
                ->limit(5)
                ->get()
                ->reverse()
                ->values();

        return response()->json([
            'id' => $request->idSpot,
            'selectedDate' => $selectedDate,
            'pressures' => $pressures,
            'sem' => $sem,
        ]);
    }
}
