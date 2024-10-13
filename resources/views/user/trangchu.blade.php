@extends('layout.user')

@section('content')
    <main class="container mx-auto px-4 py-8">
        <!-- banner -->
        <section class="bg-pink-200 p-8 rounded-lg flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-pink-600 mb-4">
                    Mua vé xem phim Online trên MoMo
                </h1>
                <p class="text-gray-700 mb-4">
                    Với nhiều ưu đãi hấp dẫn và kết nối với tất cả các rạp lớn phủ rộng
                    khắp Việt Nam. Đặt vé ngay tại MoMo!
                </p>
                <ul class="text-gray-700 mb-4">
                    <li class="flex items-center mb-2">
                        <i class="fas fa-check-circle text-pink-600 mr-2"> </i>
                        Mua vé Online, trải nghiệm phim hay
                    </li>
                    <li class="flex items-center mb-2">
                        <i class="fas fa-check-circle text-pink-600 mr-2"> </i>
                        Đặt vé an toàn trên MoMo
                    </li>
                    <li class="flex items-center mb-2">
                        <i class="fas fa-check-circle text-pink-600 mr-2"> </i>
                        Tha hồ chọn chỗ ngồi, mua bắp nước tiện lợi.
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check-circle text-pink-600 mr-2"> </i>
                        Lịch sử đặt vé được lưu lại ngay
                    </li>
                </ul>
                <button class="bg-pink-600 text-white px-6 py-2 rounded-full">
                    ĐẶT VÉ NGAY
                </button>
            </div>
            <img alt="Promotional Banner" class="rounded-lg" height="200"
                src="https://storage.googleapis.com/a1aa/image/yyDVCIcr3oqJLBUI7Jy23AirAE7VCS2vaOpJSgEyT2fW6yxJA.jpg"
                width="400" />
        </section>
        <!-- phim đang chiếu -->
        <section class="mt-12">
            <h2 class="text-2xl font-bold text-center text-gray-900 mb-8">
                Phim đang chiếu
            </h2>
            <div class="grid grid-cols-5 gap-4">
                <div class="bg-black text-white p-4 rounded-lg">
                    <img alt="Movie Poster 1" class="rounded-lg mb-4" height="300"
                        src="https://storage.googleapis.com/a1aa/image/rsf7RftzSBsheI4LMfqkFDXNFxCNgTePbXajseZPydiJMd54E.jpg"
                        width="200" />
                    <h3 class="text-lg font-bold">CẤM</h3>
                    <p>Kinh Dị</p>
                    <p class="text-yellow-500">
                        <i class="fas fa-star"> </i>
                        6.3
                    </p>
                </div>
                <div class="bg-black text-white p-4 rounded-lg">
                    <img alt="Movie Poster 2" class="rounded-lg mb-4" height="300"
                        src="https://storage.googleapis.com/a1aa/image/HmJyHfw6F5xXHCJdmV01YidmP4Gcjn5ly4X4cc1yceN10ljTA.jpg"
                        width="200" />
                    <h3 class="text-lg font-bold">Joker: Folie à Deux - Điên Cuồng</h3>
                    <p>Nhạc Kịch, Tâm Lý</p>
                    <p class="text-yellow-500">
                        <i class="fas fa-star"> </i>
                        4.8
                    </p>
                </div>
                <div class="bg-black text-white p-4 rounded-lg">
                    <img alt="Movie Poster 3" class="rounded-lg mb-4" height="300"
                        src="https://storage.googleapis.com/a1aa/image/m5YdNkwP3nLJJtcDgFGEVQDOQtLTfMeBNSBKqPoluFRu0ljTA.jpg"
                        width="200" />
                    <h3 class="text-lg font-bold">Yeo: Quỷ Án Tang Phần 2</h3>
                    <p>Kinh Dị, Gây Cấn</p>
                    <p class="text-yellow-500">
                        <i class="fas fa-star"> </i>
                        9.6
                    </p>
                </div>
                <div class="bg-black text-white p-4 rounded-lg">
                    <img alt="Movie Poster 4" class="rounded-lg mb-4" height="300"
                        src="https://storage.googleapis.com/a1aa/image/f1Rj2Bs7hNy1NSCFByfnO7VfmXZQe1JBHTdslmX5fRRWmuccC.jpg"
                        width="200" />
                    <h3 class="text-lg font-bold">Transformers Một</h3>
                    <p>Khoa Học Viễn Tưởng, Hoạt Hình</p>
                    <p class="text-yellow-500">
                        <i class="fas fa-star"> </i>
                        9.6
                    </p>
                </div>
                <div class="bg-black text-white p-4 rounded-lg">
                    <img alt="Movie Poster 5" class="rounded-lg mb-4" height="300"
                        src="https://storage.googleapis.com/a1aa/image/ruZcDS03ZzbIPBgKIAf5OtfEPWjcEuJ03v2pbEIUoh8x0ljTA.jpg"
                        width="200" />
                    <h3 class="text-lg font-bold">Đồ Anh Công Dược Tôi</h3>
                    <p>Hài, Hình Sự</p>
                    <p class="text-yellow-500">
                        <i class="fas fa-star"> </i>
                        8.9
                    </p>
                </div>
            </div>
        </section>
    </main>
    <!-- lịch chiếu phim -->
    <div class="container mx-auto p-4">
        <h1 class="text-center text-pink-600 text-3xl font-bold mb-4">
            Lịch chiếu phim
        </h1>
        <div class="bg-white rounded-lg shadow-lg p-4">
            <div class="flex justify-between items-center mb-4">
                <div class="flex items-center space-x-2">
                    <button class="bg-pink-600 text-white px-4 py-2 rounded-full flex items-center">
                        <i class="fas fa-map-marker-alt mr-2"> </i>
                        Hồ Chí Minh
                    </button>
                    <button class="bg-gray-200 text-gray-700 px-4 py-2 rounded-full">
                        Gần bạn
                    </button>
                </div>
                <div class="flex space-x-2">
                    <img alt="Logo 1" class="rounded-full" height="40"
                        src="https://storage.googleapis.com/a1aa/image/p8Ff0A20vWwNCiMSvKZuxqnbopu5uepdfHkXuF3sppxHyLHnA.jpg"
                        width="40" />
                    <img alt="Logo 2" class="rounded-full" height="40"
                        src="https://storage.googleapis.com/a1aa/image/48Tce4YSKqX4LKGZZlJvGCnNQBmrgKjARajgTLNQ50sk8yxJA.jpg"
                        width="40" />
                    <img alt="Logo 3" class="rounded-full" height="40"
                        src="https://storage.googleapis.com/a1aa/image/Lcb7KnQO22aKN98T00IiH96Yef7zRGGErO30eMrJwtuYyLHnA.jpg"
                        width="40" />
                    <img alt="Logo 4" class="rounded-full" height="40"
                        src="https://storage.googleapis.com/a1aa/image/XVBa7gmvLt4SN1VZNodeseJXivK4LmRDOqNBkjr2otMN5ljTA.jpg"
                        width="40" />
                </div>
            </div>
            <div class="flex">
                <div class="w-1/4 pr-4">
                    <div class="bg-gray-100 p-2 rounded-lg mb-4">
                        <input class="w-full p-2 rounded-lg border border-gray-300" placeholder="Tìm theo tên rạp ..."
                            type="text" />
                    </div>
                    <ul class="space-y-2">
                        <li class="bg-pink-100 p-2 rounded-lg flex items-center">
                            <img alt="CGV Logo" class="mr-2" height="30"
                                src="https://storage.googleapis.com/a1aa/image/Ih1UAft2w8T0Ri5D2V7eyXKOOJsoJVLEJecKB6Nf2UlZkXOOB.jpg"
                                width="30" />
                            CGV Aeon Bình Tân
                        </li>
                        <li class="p-2 rounded-lg flex items-center">
                            <img alt="CGV Logo" class="mr-2" height="30"
                                src="https://storage.googleapis.com/a1aa/image/Ih1UAft2w8T0Ri5D2V7eyXKOOJsoJVLEJecKB6Nf2UlZkXOOB.jpg"
                                width="30" />
                            CGV Vincom Gò Vấp
                        </li>
                        <li class="p-2 rounded-lg flex items-center">
                            <img alt="CGV Logo" class="mr-2" height="30"
                                src="https://storage.googleapis.com/a1aa/image/Ih1UAft2w8T0Ri5D2V7eyXKOOJsoJVLEJecKB6Nf2UlZkXOOB.jpg"
                                width="30" />
                            CGV Crescent Mall
                        </li>
                        <li class="p-2 rounded-lg flex items-center">
                            <img alt="CGV Logo" class="mr-2" height="30"
                                src="https://storage.googleapis.com/a1aa/image/Ih1UAft2w8T0Ri5D2V7eyXKOOJsoJVLEJecKB6Nf2UlZkXOOB.jpg"
                                width="30" />
                            CGV Liberty Citypoint
                        </li>
                        <li class="p-2 rounded-lg flex items-center">
                            <img alt="CGV Logo" class="mr-2" height="30"
                                src="https://storage.googleapis.com/a1aa/image/Ih1UAft2w8T0Ri5D2V7eyXKOOJsoJVLEJecKB6Nf2UlZkXOOB.jpg"
                                width="30" />
                            CGV Pearl Plaza
                        </li>
                        <li class="p-2 rounded-lg flex items-center">
                            <img alt="CGV Logo" class="mr-2" height="30"
                                src="https://storage.googleapis.com/a1aa/image/Ih1UAft2w8T0Ri5D2V7eyXKOOJsoJVLEJecKB6Nf2UlZkXOOB.jpg"
                                width="30" />
                            CGV Vivo City
                        </li>
                        <li class="p-2 rounded-lg flex items-center">
                            <img alt="CGV Logo" class="mr-2" height="30"
                                src="https://storage.googleapis.com/a1aa/image/Ih1UAft2w8T0Ri5D2V7eyXKOOJsoJVLEJecKB6Nf2UlZkXOOB.jpg"
                                width="30" />
                            CGV Sư Vạn Hạnh
                        </li>
                    </ul>
                    <button class="bg-pink-600 text-white w-full py-2 rounded-lg mt-4">
                        Xem thêm
                    </button>
                </div>
                <div class="w-3/4">
                    <div class="bg-gray-100 p-4 rounded-lg mb-4">
                        <div class="flex items-center mb-2">
                            <img alt="CGV Logo" class="mr-2" height="30"
                                src="https://storage.googleapis.com/a1aa/image/Ih1UAft2w8T0Ri5D2V7eyXKOOJsoJVLEJecKB6Nf2UlZkXOOB.jpg"
                                width="30" />
                            <span class="font-bold">
                                Lịch chiếu phim CGV Aeon Bình Tân
                            </span>
                        </div>
                        <p class="text-gray-600">
                            Tầng 3, Trung tâm thương mại Aeon Mall Bình Tân, Số 1 đường số
                            17A, khu phố 11, phường Bình Trị Đông B, quận Bình Tân, TP. Hồ
                            Chí Minh [ Bản đồ ]
                        </p>
                    </div>
                    <div class="flex space-x-2 mb-4">
                        <button class="bg-pink-600 text-white px-4 py-2 rounded-lg">
                            5 Hôm nay
                        </button>
                        <button class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg">
                            6 Chủ nhật
                        </button>
                        <button class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg">
                            7 Thứ 2
                        </button>
                        <button class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg">
                            8 Thứ 3
                        </button>
                        <button class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg">
                            9 Thứ 4
                        </button>
                        <button class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg">
                            10 Thứ 5
                        </button>
                        <button class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg">
                            11 Thứ 6
                        </button>
                    </div>
                    <div class="mb-4">
                        <div class="flex mb-2">
                            <img alt="Robot Hoang Dã Poster" class="mr-4" height="150"
                                src="https://storage.googleapis.com/a1aa/image/lzQCy0o3Gt6xG5GdKahbiGpQEScylcjdO2081e72reFT5ljTA.jpg"
                                width="100" />
                            <div>
                                <h2 class="font-bold text-lg">Robot Hoang Dã</h2>
                                <p class="text-gray-600">
                                    Khoa Học Viễn Tưởng, Hoạt Hình, Gia Đình
                                </p>
                                <p class="font-bold mt-2">2D Lồng tiếng</p>
                                <div class="flex space-x-2 mt-2">
                                    <button class="bg-blue-100 text-blue-600 px-4 py-2 rounded-lg">
                                        10:20 ~ 12:10
                                    </button>
                                    <button class="bg-blue-100 text-blue-600 px-4 py-2 rounded-lg">
                                        14:50 ~ 16:40
                                    </button>
                                    <button class="bg-blue-100 text-blue-600 px-4 py-2 rounded-lg">
                                        17:00 ~ 18:50
                                    </button>
                                    <button class="bg-blue-100 text-blue-600 px-4 py-2 rounded-lg">
                                        19:20 ~ 21:10
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="flex">
                            <img alt="Đổ Anh Cùng Được Tội Poster" class="mr-4" height="150"
                                src="https://storage.googleapis.com/a1aa/image/3f4DWmefuPVNeS6bg4H1hJ35roJfxn2X8vMbyDrdieVlTeyxJA.jpg"
                                width="100" />
                            <div>
                                <h2 class="font-bold text-lg">Đổ Anh Cùng Được Tội</h2>
                                <p class="text-gray-600">Hài, Hình Sự, Hành Động</p>
                                <p class="font-bold mt-2">2D Phụ đề</p>
                                <div class="flex space-x-2 mt-2">
                                    <button class="bg-blue-100 text-blue-600 px-4 py-2 rounded-lg">
                                        10:50 ~ 12:40
                                    </button>
                                    <button class="bg-blue-100 text-blue-600 px-4 py-2 rounded-lg">
                                        15:10 ~ 16:58
                                    </button>
                                    <button class="bg-blue-100 text-blue-600 px-4 py-2 rounded-lg">
                                        18:10 ~ 20:08
                                    </button>
                                    <button class="bg-blue-100 text-blue-600 px-4 py-2 rounded-lg">
                                        20:40 ~ 22:38
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-center">
                        <button class="bg-pink-600 text-white w-52 py-2 rounded-lg">
                            Xem tất cả
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex mt-2 justify-center">
            <button class="bg-pink-600 text-white w-52 py-2 rounded-lg">
                Xem tất cả
            </button>
        </div>
    </div>
    <!-- banner 2 -->
    <div class="bg-red-600 text-white text-center py-10">
        <div class="container mx-auto">
            <img alt="Promotional banner with a couple sitting on a couch, holding popcorn, and a large smartphone in the background"
                class="mx-auto" height="100"
                src="https://storage.googleapis.com/a1aa/image/FSNbUd9C47IqJponVPl0VN8yy7NYhI3pql4zRArkKs5Cg54E.jpg"
                width="600" />
            <h1 class="text-4xl font-bold mt-4">Ngập tràn phim hay</h1>
            <h2 class="text-5xl font-bold mt-2">ĐẶT VÉ XEM PHIM NGAY</h2>
            <h3 class="text-3xl mt-2">TRÊN Ví VNPAY</h3>
        </div>
    </div>
    <!-- bình luận nổi bật -->
    <main class="container mx-auto mt-10">
        <h2 class="text-3xl font-bold text-center text-pink-600 mb-8">
            Bình luận nổi bật
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-lg shadow-md p-4">
                <img alt="Movie poster for CẤM" class="rounded-lg mb-4" height="400"
                    src="https://storage.googleapis.com/a1aa/image/J86HwvsSZm43A9gBNr7YqfEeFFvYjCOU6OaY3twSbQ1JAmjTA.jpg"
                    width="600" />
                <div class="flex items-center justify-between mb-2">
                    <span class="text-lg font-bold"> CẤM </span>
                    <div class="flex items-center">
                        <span class="text-sm text-gray-500 mr-2">
                            <i class="fas fa-star text-yellow-500"> </i>
                            6.3
                        </span>
                        <span class="text-sm text-gray-500">
                            <i class="fas fa-comment"> </i>
                            6K
                        </span>
                    </div>
                </div>
                <div class="text-sm text-gray-500 mb-4">
                    Nguyen Van Khuong - 29/09/2024
                </div>
                <p class="text-sm text-gray-700 mb-4">
                    Thấy phim OK mà bị mọi người chê dữ, có bạn chê truyện nhưng tình
                    tiết bị đơ. Công tâm mà nói thì so với mặt bằng ở Việt Nam...
                </p>
                <a class="text-pink-600 text-sm" href="#"> Xem thêm </a>
            </div>
            <div class="bg-white rounded-lg shadow-md p-4">
                <img alt="Movie poster for Làm Giàu Với Ma" class="rounded-lg mb-4" height="400"
                    src="https://storage.googleapis.com/a1aa/image/JXzImuS4nU7qLN5QrAK2KfQ3ag8IN2R2OxJEU6sYl5BDAzxJA.jpg"
                    width="600" />
                <div class="flex items-center justify-between mb-2">
                    <span class="text-lg font-bold"> Làm Giàu Với Ma </span>
                    <div class="flex items-center">
                        <span class="text-sm text-gray-500 mr-2">
                            <i class="fas fa-star text-yellow-500"> </i>
                            5.5
                        </span>
                        <span class="text-sm text-gray-500">
                            <i class="fas fa-comment"> </i>
                            5.5K
                        </span>
                    </div>
                </div>
                <div class="text-sm text-gray-500 mb-4">
                    Nguyen Thi My Hien - 08/09/2024
                </div>
                <p class="text-sm text-gray-700 mb-4">
                    Phim làm khá hay về gia đình dân tộc và đề tài về ma. Thể hiện được
                    tình cảm cha mẹ đến với giới trẻ...
                </p>
                <a class="text-pink-600 text-sm" href="#"> Xem thêm </a>
            </div>
            <div class="bg-white rounded-lg shadow-md p-4">
                <img alt="Movie poster for Minh Hôn" class="rounded-lg mb-4" height="400"
                    src="https://storage.googleapis.com/a1aa/image/LfZK9uvw2bxMUi7p9eNm7hBJRGj1FVEWH78TcbWebWfgAYOOB.jpg"
                    width="600" />
                <div class="flex items-center justify-between mb-2">
                    <span class="text-lg font-bold"> Minh Hôn </span>
                    <div class="flex items-center">
                        <span class="text-sm text-gray-500 mr-2">
                            <i class="fas fa-star text-yellow-500"> </i>
                            4.2
                        </span>
                        <span class="text-sm text-gray-500">
                            <i class="fas fa-comment"> </i>
                            1.2K
                        </span>
                    </div>
                </div>
                <div class="text-sm text-gray-500 mb-4">
                    Tran Phuong Thao - 2 giờ trước
                </div>
                <p class="text-sm text-gray-700 mb-4">
                    Chưa bao giờ xem 1 bộ điển như này tốn tiền quá bây ơi!
                </p>
                <a class="text-pink-600 text-sm" href="#"> Xem thêm </a>
            </div>
        </div>
        <div class="text-center m-4">
            <button class="text-pink-600 bg-black text-lg font-bold p-4 rounded-xl" href="#">
                Xem tiếp nhé!
            </button>
        </div>
    </main>
@endsection