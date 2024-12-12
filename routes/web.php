<?php

use App\Http\Controllers\Admin\AuthController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\VeController;
use App\Http\Controllers\RapController;
use App\Http\Controllers\DoAnController;
use App\Http\Controllers\PhimController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\VaiTroController;
use App\Http\Controllers\DaoDienController;
use App\Http\Controllers\GheNgoiController;
use App\Http\Controllers\DienVienController;
use App\Http\Controllers\MaGiamGiaController;
use App\Http\Controllers\NguoiDungController;
use App\Http\Controllers\SuatChieuController;
use App\Http\Controllers\PhongChieuController;
use App\Http\Controllers\BaiVietTinTucController;
use App\Http\Controllers\BannerQuangCaoController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\AnhBannerQuangCaoController;
use App\Http\Controllers\VaiTroVaNguoiDungController;
use App\Http\Controllers\DanhMucBaiVietTinTucController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\Admin\ThongKeDoanhThuRapController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthenController;
use App\Http\Controllers\BinhLuanPhimController;
use App\Http\Controllers\ChiTietLichChieuController;
use App\Http\Controllers\Client\LichChieuController;
use App\Http\Controllers\Client\LocController;
use App\Http\Controllers\Client\SanPhamController;
use App\Http\Controllers\DanhGiaController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\NgheSiController;
use App\Http\Controllers\TheLoaiPhimController;
use App\Http\Controllers\ThongKeController;
use App\Http\Middleware\AdminMiddleware;
use GuzzleHttp\Client;

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


Route::prefix('admin')->group(function () {
  // Thống kê doanh thu theo rạp
  Route::get('thong-ke/doanh-thu-theo-rap', [ThongKeDoanhThuRapController::class, 'thongkedoanhtheorap'])->name('doanhthutheorap');
  Route::get('thong-ke/rap/doanh-thu-theo-phong/{idRap}', [ThongKeDoanhThuRapController::class, 'doanhthutheophong'])->name('doanhthutheophong');
  // route auth admin

  Route::get('/login', [AuthController::class, 'formDanngNhap'])->name('admin.form');
  Route::post('post/login', [AuthController::class, 'dangNhap'])->name('login.admin');
  Route::post('dang-xuat', [AuthController::class, 'dangXuat'])->name('admin.dangxuat');
  Route::get('/', [DashboardController::class, 'dashboard'])->name('admin.index'); //->middleware(['auth', AdminMiddleware::class]);

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
  Route::post('admin/nguoi-dung/{id}/restore', [NguoiDungController::class, 'restore'])->name('nguoi-dung.restore');
  Route::delete('admin/nguoi-dung/{id}/force-delete', [NguoiDungController::class, 'forceDelete'])->name('nguoi-dung.forceDelete');

  // Xem và cập nhật thông tin cá nhân
  Route::get('thong-tin-ca-nhan3', [AdminController::class, 'thongTin'])->name('admin.ttadmin');
  Route::get('thong-tin-ca-nhan', [AdminController::class, 'formEdit'])->name('admin.edit');
  Route::put('cap-nhat-thong-tin-ca-nhan', [AdminController::class, 'editThongTin'])->name('admin.editpro');

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

  // Đạo diễn và diễn viên
  Route::post('/admin/dienVien/uploadMoTa', [DienVienController::class, 'upload'])->name('admin.dienVien.upload');
  Route::post('/admin/phim/uploadMoTa', [PhimController::class, 'upload'])->name('admin.phim.upload');
  Route::post('/admin/daodien/uploadMoTa', [DaoDienController::class, 'upload'])->name('admin.daodien.upload');
  Route::get('/api/phim/{id}/ngay-chieu', [PhimController::class, 'layNgayChieu']);
  Route::resource('daoDien', DaoDienController::class);

  // Phim
  Route::resource('phim', PhimController::class);
  Route::resource('dienVien', DienVienController::class);
  Route::delete('phim/{id}/soft-delete', [PhimController::class, 'softDelete'])->name('phim.softDelete');
  Route::get('/phim/listSoftDelete/list', [PhimController::class, 'listSoftDelete'])->name('phim.listSoftDelete');
  Route::patch('/phim/restore/{id}', [PhimController::class, 'restore'])->name('phim.restore');
  Route::delete('/phim/force-delete/{id}', [PhimController::class, 'forceDelete'])->name('phim.forceDelete');

  // Thể loại phim
  Route::resource('theLoaiPhim', TheLoaiPhimController::class);

  //Rạp chiếu
  Route::resource('rap', RapController::class);

  // Suất chiếu
  Route::resource('suatChieu', SuatChieuController::class);

  Route::get('/search', [SearchController::class, 'search'])->name('search');

  /// Phần chi tiết suất chiếu
  Route::get('chi-tiet-suat-chieu/', [ChiTietLichChieuController::class, 'index'])->name('admin.chitietsuatchieu');
  Route::get('phim/phong-chieu/{id}', [ChiTietLichChieuController::class, 'phongchieutheophim'])->name('admin.suatchieutheophim');
  Route::get('suat-chieu/phim/{idphim}/phong-chieu/{idphongchieu}', [ChiTietLichChieuController::class, 'suatchieutheophongvaphim']);

  // Thống kê
  Route::get('/thong-ke-ve-ban-ra', [ThongKeController::class, 'thongKeVeBanRaTheoPhim'])->name('thongke.vesbanra');
  Route::get('/thong-ke-tong-doanh-thu-rap', [ThongKeController::class, 'thongTongDoanhThuRap'])->name('thongke.rap');
});

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

  // Đổi mật khẩu
  Route::get('doi-mat-khau', [MemberController::class, 'formDoiMatKhau'])->name('doimatkhau');
  Route::post('doi-mat-khau', [MemberController::class, 'doiMatKhau'])->name('capnhatmk');

  // Xem và cập nhật thông tin cá nhân
  Route::get('thong-tin-ca-nhan3', [MemberController::class, 'thongTin'])->name('thongtin3');
  Route::get('thong-tin-ca-nhan', [MemberController::class, 'formCapNhatThongTin'])->name('formcapnhat');
  Route::put('cap-nhat-thong-tin-ca-nhan', [MemberController::class, 'capNhatThongTin'])->name('capnhatthongtin');

  //Lịch sử đặt vé
  Route::get('lich-su-dat-ve', [MemberController::class, 'lichSuDatVe'])->name('lichsudatve');
  Route::delete('huy-ve/{id}', [MemberController::class, 'huyVe'])->name('huyve');

  // Quên mật khẩu
  Route::get('/forgot-password', [PasswordResetController::class, 'formForgotPass'])->name('forgot.password');
  Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLink'])->name('forgot.password.submit');
  Route::get('/reset-password/{token}', [PasswordResetController::class, 'formResetPass'])->name('reset.pass');
  Route::post('/reset-password', [PasswordResetController::class, 'resetPass'])->name('resetpass');

  // Xem và cập nhập thông tin cá nhân
  Route::get('thong-tin-ca-nhan', [MemberController::class, 'thongTin'])->name('thong-tin-nguoi-dung');
  Route::get('thong-tin-ca-nhan', [MemberController::class, 'formCapNhatThongTin'])->name('formcapnhat');
  Route::put('cap-nhat-thong-tin-ca-nhan', [MemberController::class, 'capNhatThongTin'])->name('capnhatthongtin');

  // Tin tức
  Route::get('tin-tuc', [BaiVietTinTucController::class, 'hienThi'])->name('tintuc.hienthi');
  Route::get('tin-tuc/{id}', [BaiVietTinTucController::class, 'showTinTuc'])->name('tintuc.show');
  // Route::get('/tin-tuc/loctin/', [LocController::class, 'locTinTuc'])->name('tintuc.locdm');

  // ->middleware(['auth', MemberMiddleware::class])
  // Sản phẩm
  Route::get('/', [SanPhamController::class, 'SanPhamHome'])->name('trangchu.member');

  // Banner
  Route::get('banner-dau', [SanPhamController::class, 'bannerDau'])->name('banner.dau');
  Route::get('banner-giua/{id}', [SanPhamController::class, 'bannerGiua'])->name('banner.giua');

  // Tìm kiếm
  Route::get('timkiem', [SanPhamController::class, 'TimKiemPhim'])->name('timkiem');

  // Phim
  Route::get('chitietphim/{id}', [SanPhamController::class, 'ChiTietPhim'])->name('chitietphim');
  Route::get('danhsachphim', [SanPhamController::class, 'DanhSachPhim'])->name('danhsachphim');
  Route::get('phimdangchieu', [SanPhamController::class, 'PhimDangChieu'])->name('phimdangchieu');
  Route::resource('binhluan', BinhLuanPhimController::class);
  Route::resource('danh-gia', DanhGiaController::class);

  // Đặt vé
  Route::get('datve', [SanPhamController::class, 'DatVe'])->name('datve');

  // phần phúc code thêm chức năng rạp và lịch chiếu 

  // phần route rạp chiếu
  Route::get('rap', [RapController::class, 'index'])->name('rap');
  Route::get('rap/{id}', [RapController::class, 'chitietrap'])->name('chitietrap');
  Route::get('phim/rap/{id}/{ngay}', [RapController::class, 'suatphimtheorap']);

  // phần route lịch chiếu
  Route::get('lich-chieu', [LichChieuController::class, 'index'])->name('lichchieuphimclient');
  Route::get('lich-chieu/phim-rap/{id}/{ngay}', [LichChieuController::class, 'suatphimtheorap']);

  // Thông tin diễn viên đạo diễn
  Route::get('dien-vien/{id}', [NgheSiController::class, 'index'])->name('thongtin.dienvien');
  Route::get('dao-vien/{id}', [NgheSiController::class, 'daodien'])->name('thongtin.daodien');
});
