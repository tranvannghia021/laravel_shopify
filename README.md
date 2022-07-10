<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## cách chạy hoàn chỉnh


##
sau khi chạy xong -cài composer kiểm tra composer:
* composer -v cách cài:https://hocwebchuan.com/tutorial/laravel/install_composer.php 
* cài docker và compose kiểm tra docker: docker -v && compose -v 
* cách cài :https://docs.docker.com/compose/install/uninstall/ 
* nếu như run báo lỗi không thấy thư viện vendor thì run:composer i
## sau khi cài xong tất cả chạy docker desktop lên trong project cd tới thư mục chứa file docker-compose.yml chạy các lệnh sau:
##
"docker build ./docker"
##
"docker-compose up -d"
## chạy  http://localhost:8000/
## Nếu thêm ảnh mà không thấy ảnh hiện thì chạy lệnh sau:
php artisan storage:link

## phần comand file backupdata
## comands backup database products
- docker exec -it fontend bash
- php artisan backupdata:file Ten_file
## tự động backup sau 1 phút 
- docker exec -it fontend bash
- php artisan schedule:work
## crawl data từ website khác về lưu database
- tham khảo:https://github.com/dweidner/laravel-goutte
- package hổ trợ :composer require weidner/goutte
- run:php artisan crawl:data (cào 1 lần)
- run: php artisan schedule:work (cào bài báo từ dân trí vô hạn: 1 lần cào/1h)
## http://localhost:8000/admin (trang quản trị)
## http://localhost:8000(trang bài post)


