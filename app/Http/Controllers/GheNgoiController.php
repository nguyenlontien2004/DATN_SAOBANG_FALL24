<?php

namespace App\Http\Controllers;

use App\Models\GheNgoi;
use App\Models\PhongChieu;
use App\Http\Requests\StoreGheNgoiRequest;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateGheNgoiRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\SeatsRowResource;
use Carbon\Carbon;

class GheNgoiController extends Controller
{
    const PATH_VIEW = 'admin.phong_chieu.';
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
                        ->withCount([
                            'chitietve as isBooked' => function ($query) {
                                $query->whereHas('ticket', function ($q) {
                                    $currentTime = Carbon::now('Asia/Ho_Chi_Minh')->format('H:i:s');
                                    $curdate = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
                                    $q->whereHas('suatChieu', function ($st) use ($currentTime, $curdate) {
                                        $st->whereRaw('TIME(gio_ket_thuc) >= ?', $currentTime)
                                            ->whereDate('ngay', '>=', $curdate);

                                    });
                                });
                            }
                        ])
                        // ->with([
                        //     'chitietve' => function ($q) {
                        //         $q->with([
                        //             'ticket' => function ($q) {
                        //                 $q->with('suatChieu');
                        //             }
                        //         ]);
                        //     }
                        // ])
                        ->orderBy('hang_ghe')
                        ->orderBy('so_hieu_ghe');
                }
            ])
            ->find($id);
        //dd($ghePhongChieu->ghe_ngoi->groupBy('hang_ghe')->toArray(), Carbon::now('Asia/Ho_Chi_Minh')->format('H:i:s'));
        return response()->json([
            'status' => 200,
            'msg' => 'success',
            'data' => new SeatsRowResource($ghePhongChieu->ghe_ngoi->groupBy('hang_ghe'))
        ]);
    }
    public function getTypeSeat($id, $type)
    {
        $currentTime = Carbon::now('Asia/Ho_Chi_Minh')->format('H:i:s');
        $phongChieu = PhongChieu::query()->with([
            'ghe_ngoi' => function ($query) use ($type, $currentTime) {
                $query->select(['ghe_ngois.id', 'ghe_ngois.phong_chieu_id', 'ghe_ngois.hang_ghe', 'ghe_ngois.the_loai', 'ghe_ngois.so_hieu_ghe', 'ghe_ngois.isDoubleChair', 'ghe_ngois.trang_thai'])
                    ->whereDoesntHave('chitietve', function ($q) use ($currentTime) {
                        $q->whereHas('ticket', function ($q) {
                            $currentTime = Carbon::now('Asia/Ho_Chi_Minh')->format('H:i:s');
                            $curdate = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
                            $q->whereHas('suatChieu', function ($st) use ($currentTime, $curdate) {
                                $st->whereRaw('TIME(gio_ket_thuc) >= ?', $currentTime)
                                    ->whereDate('ngay', '>=', $curdate);

                            });
                        });
                        // $q->join('ves', 'chi_tiet_ves.ve_id', '=', 'ves.id')
                        //     ->join('suat_chieus', 'ves.suat_chieu_id', '=', 'suat_chieus.id')
                        //     ->whereRaw('TIME(suat_chieus.gio_ket_thuc) >= ?', [$currentTime]);
                    })
                    ->where('the_loai', $type)
                    ->orderBy('hang_ghe')
                    ->orderBy('so_hieu_ghe');
            }
        ])->find($id);

        $loaighe = $phongChieu->ghe_ngoi->groupBy('hang_ghe');
        //dd($loaighe->toArray());
        return response()->json([
            'status' => 200,
            'msg' => 'success',
            'data' => $loaighe
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    public function khoiphucghe($id)
    {
        $phongChieu = PhongChieu::query()->find($id);

        return view(self::PATH_VIEW . 'khoiphucghe', compact(['phongChieu']));
    }
    public function listgheanra($id)
    {
        $ghePhongChieu = PhongChieu::query()
            ->select(['id'])
            ->with([
                'ghe_ngoi' => function ($query) {
                    $query->onlyTrashed()
                        ->select(['ghe_ngois.id', 'ghe_ngois.phong_chieu_id', 'ghe_ngois.hang_ghe', 'ghe_ngois.the_loai', 'ghe_ngois.so_hieu_ghe', 'ghe_ngois.isDoubleChair', 'ghe_ngois.trang_thai'])
                        ->orderBy('hang_ghe')
                        ->orderBy('so_hieu_ghe');
                }
            ])
            ->find($id);
        //dd($ghePhongChieu->ghe_ngoi->groupBy('hang_ghe')->toArray(), Carbon::now('Asia/Ho_Chi_Minh')->format('H:i:s'));
        return response()->json([
            'status' => 200,
            'msg' => 'success',
            'data' => new SeatsRowResource($ghePhongChieu->ghe_ngoi->groupBy('hang_ghe'))
        ]);
    }

    public function restoreghe(Request $request)
    {
        try {
            DB::beginTransaction();
            foreach ($request->datarestore as $key => $value) {
                $ghengoi = GheNgoi::onlyTrashed()->find($value);
                $ghengoi->restore();
            }
            DB::commit();
            return response()->json([
                'status' => 200,
                'msg' => 'success',
            ],200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => 409,
                'msg' => 'error',
            ]);
        }

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
    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $idSeat = $request->seat['idSeat'];
            $idSttRow = $request->seat['sttRow'];
            if ($request->type == GheNgoi::TYPE_SEAT_OFTEN || $request->type == GheNgoi::TYPE_SEAT_VIP) {
                $this->updataTypeOftenAndVip($idSeat, $request->type);
            } else {
                $this->updataTypeDoble($idSeat, $request->type, $idSttRow);
            }
            DB::commit();
            return response()->json([
                'status' => 200,
                'msg' => 'successfully'
            ], 200);
        } catch (\Exception $e) {
            //throw $th;
            DB::rollBack();
            return response()->json([
                'status' => 500,
                'msg' => 'Error updating seats: ' . $e->getMessage()
            ], 500);
        }

    }
    public function updataTypeOftenAndVip($listSeat, $typeSeat)
    {
        foreach ($listSeat as $row => $idS) {
            GheNgoi::query()->whereIn('id', $idS)->update([
                'the_loai' => $typeSeat,
                'isDoubleChair' => null
            ]);
        }
    }
    public function updataTypeDoble($listSeat, $typeSeat, $idSttRow)
    {
        foreach ($listSeat as $row => $idS) {
            for ($i = 0; $i < count($idS); $i++) {
                if (isset($idS[$i + 1])) {
                    GheNgoi::query()->whereIn('id', [$idS[$i], $idS[$i + 1]])->update([
                        'the_loai' => $typeSeat,
                        'isDoubleChair' => $idSttRow[$row][$i] . $idSttRow[$row][$i + 1]
                    ]);
                }
                $i++;
            }
        }
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
