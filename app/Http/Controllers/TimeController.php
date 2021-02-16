<?php

namespace App\Http\Controllers;

use App\Components\TimeConverter;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TimeController extends Controller
{
    public function ConvertTime(Request $request)
    {
        $validatedData = $this->validate($request, [
            'date' => 'required|date_format:Y-m-d H:i:s',
        ]);

        return response()->json(
            TimeConverter::convertTime(Carbon::createFromTimeString($validatedData['date']))
        );
    }
}
