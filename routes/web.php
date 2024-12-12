<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VeController;
use App\Http\Controllers\RapController;
use App\Http\Controllers\DoAnController;
use App\Http\Controllers\PhimController;
use App\Http\Controllers\AuthenController;
use App\Http\Controllers\VaiTroController;
use App\Http\Controllers\DanhGiaController;
use App\Http\Controllers\DaoDienController;
use App\Http\Controllers\GheNgoiController;
use App\Http\Controllers\DienVienController;
use App\Http\Controllers\MaGiamGiaController;
use App\Http\Controllers\NguoiDungController;
use App\Http\Controllers\SuatChieuController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\PhongChieuController;
use App\Http\Controllers\TheLoaiPhimController;
use App\Http\Controllers\BinhLuanPhimController;
use App\Http\Controllers\BaiVietTinTucController;
use App\Http\Controllers\BannerQuangCaoController;
use App\Http\Controllers\Client\SanPhamController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\AnhBannerQuangCaoController;
use App\Http\Controllers\VaiTroVaNguoiDungController;
use App\Http\Controllers\DanhMucBaiVietTinTucController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\Admin\ThongKeDoanhThuRapController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\MemberMiddleware;
// =======================================
use App\Http\Controllers\NhanVien\DashboardController as NhanVienDashboardController;
use App\Http\Controllers\NhanVien\DoAnController as NhanVienDoAnController;
use App\Http\Controllers\NhanVien\NhanVienController;
use App\Http\Controllers\NhanVien\ThongTinController;
use App\Http\Controllers\NhanVien\VeController as NhanVienVeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
  return view('welcome');
});

Route::prefix('admin')->group(function(){
  Route::get('login', [AuthController::class, 'formDanngNhap'])->name('admin.form');
  Route::post('post/login', [AuthController::class, 'dangNhap'])->name('login.admin');
});


Route::prefix('admin')->middleware(['auth.admin', AdminMiddleware::class])->group(function () {
  // Thống kê doanh thu theo rạp
  Route::get('thong-ke/doanh-thu-theo-rap', [ThongKeDoanhThuRapController::class, 'thongkedoanhtheorap'])->name('doanhthutheorap');
  Route::get('thong-ke/rap/doanh-thu-theo-phong/{idRap}', [ThongKeDoanhThuRapController::class, 'doanhthutheophong'])->name('doanhthutheophong');
  // route auth admin
  
  Route::post('dang-xuat', [AuthController::class, 'dangXuat'])->name('admin.dangxuat');
  Route::get('/', [DashboardController::class, 'dashboard'])->name('admin.index')->middleware(['auth', AdminMiddleware::class]);//

  // Bài viết tin tức
  Route::resource('bai-viet-tin-tuc', BaiVietTinTucController::class);
  Route::post('admin/bai-viet-tin-tuc/{baiVietTinTuc}/restore', [BaiVietTinTucController::class, 'restore'])->name('bai-viet-tin-tuc.restore');
  Route::delete('admin/bai-viet-tin-tuc/{baiVietTinTuc}/force-delete', [BaiVietTinTucController::class, 'forceDelete'])->name('bai-viet-tin-tuc.forDelete');

  // Danh mục bài viết tin tức
  Route::resource('danh-muc-bai-viet-tin-tuc', DanhMucBaiVietTinTucController::class);
  Route::post('admin/danh-muc-bai-viet-tin-tuc/{id}/restore', [DanhMucBaiVietTinTucController::class, 'restore'])->name('danh-muc-bai-viet-tin-tuc.restore');
  Route::delete('admin/danh-muc-bai-viet-tin-tuc/{id}/force-delete', [DanhMucBaiVietTinTucController::class, 'forceDelete'])->name('danh-muc-bai-viet-tin-tuc.forDelete');

  // Vị trí banner quảng cáo
  Route::resource('banner-quang-cao', BannerQuangCaoController::class);
  Route::post('admin/banner-quang-cao/{id}/restore', [BannerQuangCaoController::class, 'restore'])->name('banner-quang-cao.restore');
  Route::delete('admin/banner-quang-cao/{id}/force-delete', [BannerQuangCaoController::class, 'forceDelete'])->name('banner-quang-cao.forDelete');

  // Ảnh banner quảng cáo
  Route::resource('anh-banner-quang-cao', AnhBannerQuangCaoController::class);
  Route::post('admin/anh-banner-quang-cao/{id}/restore', [AnhBannerQuangCaoController::class, 'restore'])->name('anh-banner-quang-cao.restore');
  Route::delete('admin/anh-banner-quang-cao/{id}/force-delete', [AnhBannerQuangCaoController::class, 'forceDelete'])->name('anh-banner-quang-cao.forDelete');

  // Mã giảm giá
  Route::resource('ma_giam_gia', MaGiamGiaController::class);
  Route::post('admin/ma_giam_gia/{id}/restore', [MaGiamGiaController::class, 'restore'])->name('ma_giam_gia.restore');
  Route::delete('admin/ma_giam_gia/{id}/force-delete', [MaGiamGiaController::class, 'forceDelete'])->name('ma_giam_gia.forceDelete');

  // Người dùng
  Route::resource('nguoi-dung', NguoiDungController::class);
  Route::post('admin/ttadmin', [AdminController::class, 'thongTin'])->name('tt.admin');
  Route::post('admin/nguoi-dung/{id}/restore', [NguoiDungController::class, 'restore'])->name('nguoi-dung.restore');
  Route::delete('admin/nguoi-dung/{id}/force-delete', [NguoiDungController::class, 'forceDelete'])->name('nguoi-dung.forceDelete');

  // Đồ ăn
  Route::get('/danh-sach-do-an', [DoAnController::class, 'index'])->name('do-an.index');
  Route::get('/do-an/create', [DoAnController::class, 'create'])->name('do-an.create');
  Route::post('/do-an/store', [DoAnController::class, 'store'])->name('do-an.store');
  Route::get('/do-an/show/{id}', [DoAnController::class, 'show'])->name('do-an.show');
  Route::get('/do-an/{id}/edit', [DoAnController::class, 'edit'])->name('do-an.edit');
  Route::put('/do-an/{id}/update', [DoAnController::class, 'update'])->name('do-an.update');
  Route::delete('/do-an/{id}/destroy', [DoAnController::class, 'destroy'])->name('do-an.destroy');

  //start route phòng chiếu 
  Route::get('danh-sach-phong-chieu', [PhongChieuController::class, 'index'])->name('admin.phongChieu');
  Route::get('them-phong-chieu', [PhongChieuController::class, 'create'])->name('admin.themphongChieu');
  Route::post('them-phong-chieu', [PhongChieuController::class, 'store'])->name('admin.storephongChieu');
  Route::get('sua-phong-chieu/{id}', [PhongChieuController::class, 'edit'])->name('admin.editphongChieu');
  Route::post('updata-phong-chieu/{id}', [PhongChieuController::class, 'update'])->name('admin.updataphongChieu');
  Route::get('softDelete-phong-chieu/{id}', [PhongChieuController::class, 'delete'])->name('admin.softDeletehongChieu');
  Route::get('danh-sach-phong-chieu-an', [PhongChieuController::class, 'listSoftDelete'])->name('admin.listSoftDeletehongChieu');
  Route::get('restore-phong-chieu/{id}', [PhongChieuController::class, 'restore'])->name('admin.restorePhongchieu');
  Route::get('phong-chieu/quan-ly-ghe/{id}', [PhongChieuController::class, 'quanLyGhecuaphong'])->name('admin.quanLyGhecuaphong');

  // route thêm ghế cho phòng chiếu
  Route::get('get/ghe/phong-chieu/{id}', [GheNgoiController::class, 'index'])->name('admin.showSeats');
  Route::post('post/them-ghe/phong-chieu/{id}', [GheNgoiController::class, 'store'])->name('admin.storeGhe');
  Route::post('delete/ghe/phong-chieu/', [GheNgoiController::class, 'delete'])->name('admin.deleteGhengoi');
  Route::get('get/loai-ghe/phong-chieu/{id}/{type}', [GheNgoiController::class, 'getTypeSeat'])->name('admin.getTypeSeat');
  Route::post('post/sua-ghe/phong-chieu/{id}', [GheNgoiController::class, 'update'])->name('admin.update');

  //end route phòng chiếu

  //start route vai trò
  Route::get('danh-sach-vai-tro/', [VaiTroController::class, 'index'])->name('admin.role.index');
  Route::get('danh-sach-vai-tro-an/', [VaiTroController::class, 'listRoleSoft'])->name('admin.role.listRoleSoft');
  Route::get('them-vai-tro/', [VaiTroController::class, 'create'])->name('admin.role.create');
  Route::post('post/them-vai-tro/', [VaiTroController::class, 'store'])->name('admin.role.store');
  Route::get('sua-vai-tro/{id}', [VaiTroController::class, 'edit'])->name('admin.role.edit');
  Route::post('post/sua-vai-tro/{id}', [VaiTroController::class, 'update'])->name('admin.role.update');
  Route::get('restore/vai-tro/{id}', [VaiTroController::class, 'restore'])->name('admin.role.restore');
  Route::get('xoa-vai-tro/{id}', [VaiTroController::class, 'delete'])->name('admin.role.delete');

  // route người dùng và vai trò
  Route::get('danh-sach-vai-tro-nguoi-dung/', [VaiTroVaNguoiDungController::class, 'index'])->name('admin.roleAndUser.index');
  Route::get('cap-nhat-vai-tro-nguoi-dung/{id}', [VaiTroVaNguoiDungController::class, 'edit'])->name('admin.roleAndUser.edit');
  Route::post('post/cap-nhat-vai-tro-nguoi-dung/{id}', [VaiTroVaNguoiDungController::class, 'update'])->name('admin.roleAndUser.update');

  // route vé 
  Route::get('danh-sach-ve/', [VeController::class, 'index'])->name('admin.ticket.index');
  Route::get('chi-tiet-ve/{id}', [VeController::class, 'detail'])->name('admin.ticket.detail');
  Route::get('tao-ve-gia-lap/', [VeController::class, 'create'])->name('admin.ticket.create');

  // Route::resources('phims');
  // đạo diễn
  Route::resource('daoDien', App\Http\Controllers\DaoDienController::class);
  Route::delete('daoDien/{id}/soft-delete', [DaoDienController::class, 'softDelete'])->name('daoDien.softDelete');
  Route::get('/dao-dien/listSoftDelete', [App\Http\Controllers\DaoDienController::class, 'listSoftDelete'])->name('admin.daoDien.listSoftDelete');
  Route::patch('/daoDien/restore/{id}', [DaoDienController::class, 'restore'])->name('daoDien.restore');  

  // phim
  Route::resource('phim', App\Http\Controllers\PhimController::class);
  Route::resource('dienVien', App\Http\Controllers\DienVienController::class);
  Route::delete('dienVien/{id}/soft-delete', [DienVienController::class, 'softDelete'])->name('dienVien.softDelete');
  Route::get('/dien-vien/listSoftDelete', [DienVienController::class, 'listSoftDelete'])->name('dienVien.listSoftDelete');
  Route::patch('/dienVien/restore/{id}', [DienVienController::class, 'restore'])->name('dienVien.restore');

  Route::post('/admin/dienVien/uploadMoTa', [DienVienController::class, 'upload'])->name('admin.dienVien.upload');
  Route::post('/admin/phim/uploadMoTa', [PhimController::class, 'upload'])->name('admin.phim.upload');
  Route::post('/admin/daodien/uploadMoTa', [DaoDienController::class, 'upload'])->name('admin.daodien.upload');

  Route::delete('phim/{id}/soft-delete', [PhimController::class, 'softDelete'])->name('phim.softDelete');
 Route::get('/phim/listSoftDelete/list', [PhimController::class, 'listSoftDelete'])->name('phim.listSoftDelete');
Route::patch('/phim/restore/{id}', [PhimController::class, 'restore'])->name('phim.restore');
Route::delete('/phim/force-delete/{id}', [PhimController::class, 'forceDelete'])->name('phim.forceDelete');

  // thể loại phim
  Route::resource('theLoaiPhim', App\Http\Controllers\TheLoaiPhimController::class);
  Route::delete('theLoaiPhim/{id}/soft-delete', [TheLoaiPhimController::class, 'softDelete'])->name('theLoaiPhim.softDelete');
  Route::get('/theLoaiPhim/listSoftDelete/list', [TheLoaiPhimController::class, 'listSoftDelete'])->name('theLoaiPhim.listSoftDelete');
  Route::patch('/theLoaiPhim/restore/{id}', [TheLoaiPhimController::class, 'restore'])->name('theLoaiPhim.restore');
  Route::delete('/theLoaiPhim/force-delete/{id}', [TheLoaiPhimController::class, 'forceDelete'])->name('theLoaiPhim.forceDelete');
  Route::resource('rap', App\Http\Controllers\RapController::class);

//  suất chiếu
  Route::resource('suatChieu', App\Http\Controllers\SuatChieuController::class);
  Route::delete('suatChieu/{id}/soft-delete', [SuatChieuController::class, 'softDelete'])->name('admin.suatChieu.softDelete');
  Route::get('/suatChieu/listSoftDelete/list', [SuatChieuController::class, 'listSoftDelete'])->name('admin.suatChieu.listSoftDelete');
  Route::patch('/suatChieu/restore/{id}', [SuatChieuController::class, 'restore'])->name('admin.suatChieu.restore');
  Route::delete('/suatChieu/force-delete/{id}', [SuatChieuController::class, 'forceDelete'])->name('admin.suatChieu.forceDelete');

  /// Phần chi tiết suất chiếu
  Route::get('chi-tiet-suat-chieu/', [App\Http\Controllers\Admin\ChiTietLichChieuController::class, 'index'])->name('admin.chitietsuatchieu');
  Route::get('phim/phong-chieu/{id}', [App\Http\Controllers\Admin\ChiTietLichChieuController::class, 'phongchieutheophim'])->name('admin.suatchieutheophim');
  Route::get('suat-chieu/phim/{idphim}/phong-chieu/{idphongchieu}', [App\Http\Controllers\Admin\ChiTietLichChieuController::class, 'suatchieutheophongvaphim']);
  // Phần huy vé
  Route::get('admin/huy-ve/{id}', [VeController::class, 'huyveAdmin'])->name('admin.huyvend');
  // huỷ suất chiếu
  Route::post('admin/huy-suat-chieu/{id}', [SuatChieuController::class, 'huysuatchieu'])->name('admin.huysuatchieu');
  // Thống kê
  Route::get('/thong-ke-ve-ban-ra', [App\Http\Controllers\ThongKeController::class, 'thongKeVeBanRaTheoPhim'])->name('thongke.vesbanra');
  Route::get('/thong-ke-tong-doanh-thu-rap', [App\Http\Controllers\ThongKeController::class, 'thongTongDoanhThuRap'])->name('thongke.rap');
});

//=================================================================================================================================

// Nhân viên 
Route::get('check-qrCode/{id}', [App\Http\Controllers\NhanVien\KiemTraVeController::class, 'checkQrCode']);
// Route không cần middleware
Route::prefix('nhanvien')->group(function () {
  Route::get('login', [NhanVienController::class, 'formDangNhap'])->name('nhanvien.form');
  Route::post('login', [NhanVienController::class, 'dangNhap'])->name('nhanvien.dangnhap.post');
});

// Route cần middleware
Route::prefix('nhanvien')->middleware(['checkNhanVienRole'])->group(function () {
  Route::post('logout', [NhanVienController::class, 'dangXuat'])->name('nhanvien.dangxuat');
  Route::get('/', [App\Http\Controllers\NhanVien\DashboardController::class, 'dashboard'])->name('nhanvien.dashboard.index');

  // quét vé
  Route::get('/quet-ve', [App\Http\Controllers\NhanVien\KiemTraVeController::class, 'quetve'])->name('nhanvien.quetve');
  Route::get('/trang-kiem-tra-ve-qua-ma-code', [App\Http\Controllers\NhanVien\KiemTraVeController::class, 'viewcheckmacodeve'])->name('nhanvien.viewcheckmacodeve');
  Route::post('/check-ma-ve-code', [App\Http\Controllers\NhanVien\KiemTraVeController::class, 'checkmacodeve'])->name('nhanvien.checkmacodeve');
  // quét đồ ăn
  Route::get('/quet-do-an', [App\Http\Controllers\NhanVien\KiemTraDoAnControllerzz::class, 'quetdoan'])->name('nhanvien.quetdoan');
  Route::get('/ma-code-do-an', [App\Http\Controllers\NhanVien\KiemTraDoAnControllerzz::class, 'checkmacodedoan'])->name('nhanvien.checkmacodedoan');
  Route::post('/check-ma-code-do-an', [App\Http\Controllers\NhanVien\KiemTraDoAnControllerzz::class, 'kiemtradoantheomacode'])->name('nhanvien.kiemtradoanpost');

  // Suất chiếu
  Route::resource('nhanvienSuatchieu', App\Http\Controllers\NhanVien\SuatChieuController::class);
  Route::delete('suatChieu/{id}/soft-delete', [App\Http\Controllers\NhanVien\SuatChieuController::class, 'softDelete'])->name('nhanvien.suatchieu.softDelete');
  Route::get('/suatChieu/listSoftDelete/list', [App\Http\Controllers\NhanVien\SuatChieuController::class, 'listSoftDelete'])->name('nhanvien.suatChieu.listSoftDelete');
  Route::patch('/suatChieu/restore/{id}', [App\Http\Controllers\NhanVien\SuatChieuController::class, 'restore'])->name('nhanvien.suatchieu.restore');
  Route::post('admin/huy-suat-chieu/{id}', [App\Http\Controllers\NhanVien\SuatChieuController::class, 'huysuatchieu'])->name('nhanvien.huysuatchieu');

  //Route::get('/danh-sach-suat-chieu', [App\Http\Controllers\NhanVien\SuatChieuController::class, 'index'])->name('nhanvien.suatchieu.index');
  // Route::get('/xem-suat-chieu/{id}', [App\Http\Controllers\NhanVien\SuatChieuController::class, 'show'])->name('nhanvien.suatchieu.show');
  // Route::get('/them-moi-suat-chieu', [App\Http\Controllers\NhanVien\SuatChieuController::class, 'create'])->name('nhanvien.suatchieu.create');
  // Route::post('/them-moi-suat-chieu/store', [App\Http\Controllers\NhanVien\SuatChieuController::class, 'store'])->name('nhanvien.suatchieu.store');
  // Route::get('/sua-moi-suat-chieu/{id}', [App\Http\Controllers\NhanVien\SuatChieuController::class, 'edit'])->name('nhanvien.suatchieu.edit');
  // Route::put('/sua-moi-suat-chieu/{id}', [App\Http\Controllers\NhanVien\SuatChieuController::class, 'update'])->name('nhanvien.suatchieu.update');

  // Đồ ăn
  Route::get('/danh-sach-do-an', [NhanVienDoAnController::class, 'index'])->name('nhanvien.do-an.index');
  Route::get('/do-an/create', [NhanVienDoAnController::class, 'create'])->name('nhanvien.do-an.create');
  Route::post('/do-an/store', [NhanVienDoAnController::class, 'store'])->name('nhanvien.do-an.store');
  Route::get('/do-an/show/{id}', [NhanVienDoAnController::class, 'show'])->name('nhanvien.do-an.show');
  Route::get('/do-an/{id}/edit', [NhanVienDoAnController::class, 'edit'])->name('nhanviendoan.do-an.edit');
  Route::put('/do-an/{id}/update', [NhanVienDoAnController::class, 'update'])->name('nhanvien.do-an.update');
  Route::delete('/do-an/{id}/destroy', [NhanVienDoAnController::class, 'destroy'])->name('nhanvien.do-an.destroy');

  // Thông tin nhân viên
  Route::get('/profile', [ThongTinController::class, 'show'])->name('profile.show');
  Route::get('/profile/{id}/edit', [ThongTinController::class, 'edit'])->name('profile.edit');
  Route::put('/profile/{id}/update', [ThongTinController::class, 'update'])->name('profile.update');

  // Quản lí vé
  Route::get('/ve/danh-sach-ve', [NhanVienVeController::class, 'index'])->name('nhanvien.ve.danhsachve'); // Hiển thị form mua vé
  Route::get('/ve/mua', [NhanVienVeController::class, 'hienThiFormMuaVe'])->name('ve.mua'); // Hiển thị form mua vé
  Route::post('/ve/mua', [NhanVienVeController::class, 'luuVe'])->name('ve.luu'); // Lưu vé mới
  Route::get('/ve/chua-thanh-toan', [NhanVienVeController::class, 'danhSachVeChuaThanhToan'])->name('ve.chua-thanh-toan'); // Danh sách vé chưa thanh toán
  Route::post('/ve/thanh-toan/{ve}', [NhanVienVeController::class, 'thanhToanVaInVe'])->name('ve.thanh-toan'); // Thanh toán và in vé
  Route::get('/ve/qr/{ve}', [NhanVienVeController::class, 'inMaQR'])->name('ve.qr'); // In mã QR cho vé
  Route::put('/ve/cap-nhat-trang-thai/{ve}', [NhanVienVeController::class, 'capNhatTrangThaiVe'])->name('ve.cap-nhat-trang-thai'); // Cập nhật trạng thái vé
});



//=================================================================================================================================
// // Đăng ký
// Route::get('dang-ky', [AuthenController::class, 'formDangKy'])->name('dangky');
// Route::post('dang-ky', [AuthenController::class, 'dangKy']);

// // Đăng nhập
// Route::get('dang-nhap', [AuthenController::class, 'formDangNhap'])->name('formDangNhap');
// Route::post('dang-nhap', [AuthenController::class, 'dangNhap'])->name('dangNhap');

// // Đăng xuất
// Route::post('dang-xuat', [AuthenController::class, 'dangXuat'])->name('dangxuat');


// Member
// Route::prefix('thanh-vien')->group(function () {
//   Route::get('trang-chu', [MemberController::class, 'trangChu'])
//     ->name('trangchu.member');
//   Route::get('doi-mat-khau', [MemberController::class, 'formDoiMatKhau'])->name('doimatkhau');
//   Route::post('doi-mat-khau', [MemberController::class, 'doiMatKhau']);
// });

//Route người dùng
Route::get('/', [SanPhamController::class, 'SanPhamHome'])->name('/');
// Route::get('chitietphim/{id}', [SanPhamController::class, 'ChiTietPhim'])->name('chitietphim');
// Route::get('timkiem', [SanPhamController::class, 'TimKiemPhim'])->name('timkiem');
// Route::get('danhsachphim', [SanPhamController::class, 'DanhSachPhim'])->name('danhsachphim');
// Route::get('phimdangchieu', [SanPhamController::class, 'PhimDangChieu'])->name('phimdangchieu');
// Route::get('datve', [SanPhamController::class, 'DatVe'])->name('datve');
// Route::resource('binhluan', BinhLuanPhimController::class);
// Route::resource('danhgia', DanhGiaController::class);
// Thành viên
Route::prefix('thanh-vien')->group(function () {

  // Đăng ký
  Route::get('dang-ky', [AuthenController::class, 'formDangKy'])->name('dangky');
  Route::post('dang-ky', [AuthenController::class, 'dangKy']);

  // Đăng nhập
  Route::get('dang-nhap', [AuthenController::class, 'formDangNhap'])->name('dangnhap');
  Route::post('dang-nhap', [AuthenController::class, 'dangNhap']);

  // Đăng xuất
  Route::post('dang-xuat', [AuthenController::class, 'dangXuat'])->name('dangxuat');

  // Route::get('trang-chu', [MemberController::class, 'trangChu'])
  //   ->name('trangchu.member');

  // Đổi mật khẩu
  Route::get('doi-mat-khau', [MemberController::class, 'formDoiMatKhau'])->name('doimatkhau');
  Route::post('doi-mat-khau', [MemberController::class, 'doiMatKhau'])->name('capnhatmk');


  Route::get('thong-tin-ca-nhan', [MemberController::class, 'thongTin'])->name('thong-tin-nguoi-dung')->middleware(['auth', MemberMiddleware::class]);

  Route::get('cap-nhat/thong-tin-ca-nhan', [MemberController::class, 'formCapNhatThongTin'])->name('formcapnhat')->middleware(['auth', MemberMiddleware::class]);
  Route::put('cap-nhat-thong-tin-ca-nhan', [MemberController::class, 'capNhatThongTin'])->name('capnhatthongtin')->middleware(['auth', MemberMiddleware::class]);
  //Lịch sử đặt vé
  Route::get('lich-su-dat-ve', [MemberController::class, 'lichSuDatVe'])->name('lichsudatve')->middleware(['auth', MemberMiddleware::class]);
  Route::post('huy-ve/{id}', [MemberController::class, 'huyVe'])->name('huyve')->middleware(['auth', MemberMiddleware::class]);


  Route::get('/forgot-password', [PasswordResetController::class, 'formForgotPass'])->name('forgot.password');
  Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLink'])->name('forgot.password.submit');
  Route::get('/reset-password/{token}', [PasswordResetController::class, 'formResetPass'])->name('reset.pass');
  Route::post('/reset-password', [PasswordResetController::class, 'resetPass'])->name('resetpass');

  // Tin tức
  Route::get('tin-tuc', [BaiVietTinTucController::class, 'hienThi'])->name('tintuc.hienthi');
  Route::get('tin-tuc/{id}', [BaiVietTinTucController::class, 'showTinTuc'])->name('tintuc.show');
  Route::get('/', [SanPhamController::class, 'SanPhamHome'])->name('trangchu.member');
  Route::get('chitietphim/{id}', [SanPhamController::class, 'ChiTietPhim'])->name('chitietphim');
  Route::get('timkiem', [SanPhamController::class, 'TimKiemPhim'])->name('timkiem');
  Route::get('danhsachphim', [SanPhamController::class, 'DanhSachPhim'])->name('danhsachphim');
  Route::get('phimdangchieu', [SanPhamController::class, 'PhimDangChieu'])->name('phimdangchieu');
  Route::get('datve', [SanPhamController::class, 'DatVe'])->name('datve');
  Route::resource('binhluan', BinhLuanPhimController::class);
  Route::resource('danh-gia', DanhGiaController::class);

  // phần phúc code thêm chức năng rạp và lịch chiếu 
  // phần trang chủ 
  Route::get('trang-chu/lich-chieu/rap/{id}/{ngay}', [App\Http\Controllers\Client\SanPhamController::class, 'suatphimtheorap']);
  // phần route rạp chiếu
  Route::get('rap', [App\Http\Controllers\Client\RapController::class, 'index'])->name('rap');
  Route::get('rap/{id}', [App\Http\Controllers\Client\RapController::class, 'chitietrap'])->name('chitietrap');
  Route::get('phim/rap/{id}/{ngay}', [App\Http\Controllers\Client\RapController::class, 'suatphimtheorap']);
  // phần route lịch chiếu
  Route::get('lich-chieu', [App\Http\Controllers\Client\LichChieuController::class, 'index'])->name('lichchieuphimclient');
  Route::get('lich-chieu/phim-rap/{id}/{ngay}', [App\Http\Controllers\Client\LichChieuController::class, 'suatphimtheorap']);
  // chi tiết vé đặt
  Route::get('chi-tiet-ve/{id}',[MemberController::class,'chitietvedat'])->name('client.chitietvedat');
  // Thông tin diễn viên đạo diễn
  Route::get('dien-vien/{id}',[App\Http\Controllers\Client\NgheSiController::class,'index'])->name('thongtin.dienvien');
  Route::get('dao-vien/{id}',[App\Http\Controllers\Client\NgheSiController::class,'daodien'])->name('thongtin.daodien');
});

