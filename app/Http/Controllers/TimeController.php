<?php

namespace App\Http\Controllers;

use App\Services\TimeConverterService;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TimeController extends Controller
{
    /**
     * @var TimeConverterService
     */
    private $converter;

    /**
     * TimeController constructor.
     * @param TimeConverterService $converter
     */
    public function __construct(TimeConverterService $converter)
    {
        $this->converter = $converter;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ConvertTime(Request $request)
    {
        $validatedData = $this->validate($request, [
            'date' => 'required|date_format:Y-m-d\TH:i:s\Z',
        ]);

        return response()->json(
            $this->converter->convert(Carbon::createFromTimeString($validatedData['date']))
        );
    }
}
