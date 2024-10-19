<?php

namespace App\Http\Controllers;

use App\Models\GheNgoi;
use App\Models\PhongChieu;
use App\Http\Requests\StoreGheNgoiRequest;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateGheNgoiRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\SeatsRowResource;

class GheNgoiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $ghePhongChieu = PhongChieu::query()
            ->select(['id'])
            ->with([
                'ghe_ngoi' => function ($query) {
                    $query->select(['ghe_ngois.id', 'ghe_ngois.phong_chieu_id', 'ghe_ngois.hang_ghe', 'ghe_ngois.the_loai', 'ghe_ngois.so_hieu_ghe', 'ghe_ngois.isDoubleChair', 'ghe_ngois.trang_thai'])
                        ->orderBy('hang_ghe', )
                        ->orderBy('so_hieu_ghe');
                }
            ])
            ->find($id);

        return response()->json([
            'status' => 200,
            'msg' => 'success',
            'data' => new SeatsRowResource($ghePhongChieu->ghe_ngoi->groupBy('hang_ghe'))
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $data = json_decode($request->getContent(), true);
            foreach ($data as $value) {
                $this->switchCacheTypeSeat($id, $value);
            }
            DB::commit();
            return response()->json([
                'status' => 200,
                'msg' => 'Adding rows of seats successfully'
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => 404,
                'msg' => 'More rows of faulty seats'
            ], 404);
        }

    }
    public function switchCacheTypeSeat($id, $value)
    {
        switch ($value['type']) {
            case GheNgoi::TYPE_SEAT_OFTEN:
                $this->creatSeatRowOften($id, $value['row'], $value['total']);
                break;
            case GheNgoi::TYPE_SEAT_VIP:
                $this->creatSeatRowVip($id, $value['row'], $value['total']);
                break;
            case GheNgoi::TYPE_SEAT_DOUBLE:
                $this->creatSeatRowDouble($id, $value['row'], $value['total']);
                break;
            default:
                return response()->json([
                    'status' => 404,
                    'msg' => 'Chair style is not specified'
                ], 404);
        }
    }
    public function creatSeatRowOften($id, $row, $totalSeat)
    {
        $maximunQuantity = false;

        foreach ($row as $value) {
            $largestSeatNumber = GheNgoi::query()
                ->select(['id', 'phong_chieu_id', 'hang_ghe', 'so_hieu_ghe'])
                ->where('phong_chieu_id', $id)
                ->where('hang_ghe', $value)
                ->orderBy('so_hieu_ghe', 'desc')
                ->first();

            if ($largestSeatNumber && $totalSeat + $largestSeatNumber['so_hieu_ghe'] >= 12) {
                $maximunQuantity = true;
                $checkTotal = 12 - $largestSeatNumber['so_hieu_ghe'];
            }
            $totalNUmber = $maximunQuantity ? $checkTotal : $totalSeat;

            if ($largestSeatNumber == null || $largestSeatNumber['so_hieu_ghe'] != 12) {
                for ($i = 0; $i < $totalNUmber; $i++) {
                    GheNgoi::query()->create([
                        'phong_chieu_id' => $id,
                        'hang_ghe' => $value,
                        'the_loai' => GheNgoi::TYPE_SEAT_OFTEN,
                        'so_hieu_ghe' => ($largestSeatNumber && $largestSeatNumber !== null ? $largestSeatNumber['so_hieu_ghe'] + $i + 1 : $i + 1),
                    ]);
                    //echo $value . ($largestSeatNumber && $largestSeatNumber !== null ? $largestSeatNumber['so_hieu_ghe'] + $i + 1 : $i + 1);
                }
            }
            $maximunQuantity = false;
        }
    }
    public function creatSeatRowVip($id, $row, $totalSeat)
    {
        $maximunQuantity = false;
        foreach ($row as $value) {
            $largestSeatNumber = GheNgoi::query()
                ->select(['id', 'phong_chieu_id', 'hang_ghe', 'so_hieu_ghe'])
                ->where('phong_chieu_id', $id)
                ->where('hang_ghe', $value)
                ->orderBy('so_hieu_ghe', 'desc')
                ->first();
            if ($largestSeatNumber && $totalSeat + $largestSeatNumber['so_hieu_ghe'] >= 12) {
                $maximunQuantity = true;
                $checkTotal = 12 - $largestSeatNumber['so_hieu_ghe'];
            }
            $totalNUmber = $maximunQuantity ? $checkTotal : $totalSeat;
            if ($largestSeatNumber == null || $largestSeatNumber['so_hieu_ghe'] != 12) {
                for ($i = 0; $i < $totalNUmber; $i++) {
                    GheNgoi::query()->create([
                        'phong_chieu_id' => $id,
                        'hang_ghe' => $value,
                        'the_loai' => GheNgoi::TYPE_SEAT_VIP,
                        'so_hieu_ghe' => ($largestSeatNumber && $largestSeatNumber !== null ? $largestSeatNumber['so_hieu_ghe'] + $i + 1 : $i + 1),
                    ]);
                    // echo $value . ($largestSeatNumber && $largestSeatNumber !== null ? $largestSeatNumber['so_hieu_ghe'] + $i + 1 : $i + 1);
                }
            }
            $maximunQuantity = false;
        }
    }
    public function creatSeatRowDouble($id, $row, $totalSeat)
    {
        $seatPairs = [];
        $maximunQuantity = false;
        foreach ($row as $value) {
            $count = 0;

            $largestSeatNumber = GheNgoi::query()
                ->select(['id', 'phong_chieu_id', 'hang_ghe', 'so_hieu_ghe'])
                ->where('phong_chieu_id', $id)
                ->where('hang_ghe', $value)
                ->orderBy('so_hieu_ghe', 'desc')
                ->first();
            if ($largestSeatNumber && $totalSeat + $largestSeatNumber['so_hieu_ghe'] >= 12) {
                $maximunQuantity = true;
                $checkTotal = 12 - $largestSeatNumber['so_hieu_ghe'];
            }

            $totalNUmber = $maximunQuantity ? $checkTotal : $totalSeat;
            if ($largestSeatNumber == null || $largestSeatNumber['so_hieu_ghe'] != 12) {
                for ($i = 0; $i < $totalNUmber; $i++) {
                    if ($count == 0) {
                        $firstSeat = (object) [
                            'row' => $value,
                            'numerical' => $largestSeatNumber && $largestSeatNumber !== null ? $largestSeatNumber['so_hieu_ghe'] + $i + 1 : $i + 1,
                            'isDoubleChair' => $largestSeatNumber && $largestSeatNumber !== null ? $largestSeatNumber['so_hieu_ghe'] + $i + 1 . $largestSeatNumber['so_hieu_ghe'] + $i + 1 + 1 : $i + 1 . $i + 1 + 1,
                        ];
                    }
                    $count++;
                    if ($count == 2) {
                        $seatPairs[] = [
                            $firstSeat,
                            $firstSeat = (object) [
                                'row' => $value,
                                'numerical' => $largestSeatNumber && $largestSeatNumber !== null ? $largestSeatNumber['so_hieu_ghe'] + $i + 1 : $i + 1,
                                'isDoubleChair' => $largestSeatNumber && $largestSeatNumber !== null ? $largestSeatNumber['so_hieu_ghe'] + $i + 1 - 1 . $largestSeatNumber['so_hieu_ghe'] + $i + 1 : $i + 1 - 1 . $i + 1,
                            ]
                        ];
                        $count = 0;
                    }
                }
            }
            $maximunQuantity = false;
        }
        foreach ($seatPairs as $item) {
            foreach ($item as $value) {
                GheNgoi::query()->create([
                    'phong_chieu_id' => $id,
                    'hang_ghe' => $value->row,
                    'the_loai' => GheNgoi::TYPE_SEAT_DOUBLE,
                    'so_hieu_ghe' => $value->numerical,
                    'isDoubleChair' => $value->isDoubleChair
                ]);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(GheNgoi $gheNgoi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GheNgoi $gheNgoi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGheNgoiRequest $request, GheNgoi $gheNgoi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request)
    {
        try {
            $data = json_decode($request->getContent(), true);
            DB::beginTransaction();
           GheNgoi::query()->whereIn('id', $data)->delete();
            DB::commit();
            return response()->json([
                'status' => 200,
                'msg' => 'Deleted successfully'
            ], 200);
        } catch (\Throwable $th) {
           DB::rollBack();
            return response()->json([
                'status' => 500,
                'msg' => 'error'
            ], 500);
        }
    }
    public function destroy(GheNgoi $gheNgoi)
    {
        //
    }
}
