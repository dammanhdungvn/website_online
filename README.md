# 🎯 Hệ thống Thi Trắc nghiệm Online

[![PHP](https://img.shields.io/badge/PHP-7.4+-777BB4.svg)](https://php.net)
[![MySQL](https://img.shields.io/badge/MySQL-8.0+-4479A1.svg)](https://mysql.com)
[![JavaScript](https://img.shields.io/badge/JavaScript-ES6+-F7DF1E.svg)](https://javascript.com)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-5.0+-7952B3.svg)](https://getbootstrap.com)
[![License](https://img.shields.io/badge/License-MIT-yellow.svg)](LICENSE)

## 🌐 Link Website

- **Click**: [tracnghiemonline.ct.ws](http://tracnghiemonline.ct.ws)
- username: dasiesuspicious@punkproof.com
- password: dung1234

## 📋 Mô tả dự án

Hệ thống thi trắc nghiệm online được thiết kế để tạo ra một nền tảng học tập và đánh giá hiện đại. Hệ thống cho phép giáo viên tạo ngân hàng câu hỏi, thiết lập đề thi và theo dõi kết quả, đồng thời cung cấp cho sinh viên giao diện thi trực tuyến thân thiện và hiệu quả.

### 🎯 Mục tiêu

- Tạo nền tảng thi trắc nghiệm trực tuyến tiện lợi và hiệu quả
- Quản lý ngân hàng câu hỏi theo môn học một cách khoa học
- Hỗ trợ tạo đề thi tự động với khả năng tùy chỉnh linh hoạt
- Cung cấp giao diện thi thân thiện với tính năng định thời gian
- Lưu trữ và theo dõi kết quả thi một cách chi tiết

## ✨ Tính năng chính

### 🔐 Quản lý người dùng

- **Đăng ký tài khoản** với xác thực email tự động
- **Đăng nhập an toàn** với mã hóa mật khẩu
- **Quên mật khẩu** với khôi phục qua email
- **Quản lý thông tin cá nhân** và đổi mật khẩu
- **Phân quyền người dùng** với session management

### 📚 Quản lý ngân hàng câu hỏi

- **Thêm câu hỏi mới** với 4 lựa chọn trả lời
- **Phân loại theo môn học** (Toán, Văn, Lịch sử, Địa lý, v.v.)
- **Ngân hàng câu hỏi** với khả năng tìm kiếm và lọc
- **Chỉnh sửa và xóa** câu hỏi dễ dàng
- **Import/Export** dữ liệu câu hỏi

### 🎲 Tạo và quản lý đề thi

- **Thiết lập đề thi** với tùy chọn số lượng câu hỏi
- **Chọn môn học** và thời gian làm bài
- **Random câu hỏi** để tăng tính công bằng
- **Skip câu hỏi** theo yêu cầu
- **Xem trước đề thi** trước khi phát hành

### 🖥️ Giao diện thi trực tuyến

- **Giao diện thân thiện** với thiết kế responsive
- **Đồng hồ đếm ngược** thời gian làm bài
- **Thanh progress** hiển thị tiến độ
- **Navigation** linh hoạt giữa các câu hỏi
- **Tự động submit** khi hết thời gian
- **Confirmation** trước khi nộp bài

### 📊 Quản lý kết quả

- **Chấm điểm tự động** và hiển thị kết quả ngay lập tức
- **Lưu trữ lịch sử** thi của từng người dùng
- **Thống kê chi tiết** số câu đúng/sai
- **Xuất báo cáo** kết quả theo nhiều định dạng

## 🏗️ Kiến trúc hệ thống

```text
website_online/
├── 📁 config.php                    # Cấu hình hệ thống
├── 📁 index.php                     # Entry point chính
├── 📁 API/                          # RESTful API endpoints
│   └── data.php                     # API lấy dữ liệu câu hỏi
├── 📁 database/                     # Cơ sở dữ liệu
│   └── if0_38101093_tracnghiemonline.sql
├── 📁 includes/                     # Core libraries
│   ├── connect.php                  # Kết nối database
│   ├── database.php                 # Database operations
│   ├── functions.php                # Utility functions
│   ├── session.php                  # Session management
│   └── mailer/                      # Email service
│       ├── PHPMailer.php
│       ├── SMTP.php
│       └── Exception.php
├── 📁 modules/                      # MVC modules
│   ├── auth/                        # Authentication
│   │   ├── login.php
│   │   ├── register.php
│   │   ├── forgot.php
│   │   ├── reset.php
│   │   ├── active.php
│   │   ├── changepass.php
│   │   ├── info.php
│   │   └── logout.php
│   ├── home/                        # Main features
│   │   ├── dashbroad.php
│   │   ├── setupKiemTra.php
│   │   ├── question.php
│   │   ├── query_add_question.php
│   │   ├── list_question.php
│   │   ├── get_questions.php
│   │   ├── delete_question.php
│   │   ├── kiemtra.php
│   │   ├── save_score.php
│   │   └── score.php
│   └── error/                       # Error handling
│       └── 404.php
└── 📁 templates/                    # Frontend assets
    ├── css/                         # Stylesheets
    │   ├── style.css
    │   ├── base.css
    │   └── kiemtra.css
    ├── js/                          # JavaScript
    │   └── kiemtra.js
    ├── images/                      # UI icons
    └── layout/                      # Layout templates
        ├── header.php
        ├── header-logined.php
        ├── header-kiemtra.php
        ├── footer.php
        ├── footer-logined.php
        └── footer-kiemtra.php
```

## 🔧 Công nghệ sử dụng

### Backend

- **PHP 7.4+** - Ngôn ngữ lập trình chính
- **MySQL/MariaDB** - Hệ quản trị cơ sở dữ liệu
- **PHPMailer** - Gửi email xác thực và thông báo
- **MySQLi** - Database connectivity layer

### Frontend

- **HTML5/CSS3** - Cấu trúc và styling
- **JavaScript ES6+** - Logic phía client
- **Bootstrap 5** - Responsive UI framework
- **FontAwesome** - Icon library

### Bảo mật

- **Password Hashing** - Mã hóa mật khẩu với PHP password_hash()
- **Session Management** - Quản lý phiên đăng nhập an toàn
- **SQL Injection Prevention** - Bảo vệ khỏi SQL injection
- **XSS Protection** - Ngăn chặn Cross-site scripting
- **CSRF Protection** - Token-based request validation

### Database Schema

- **users** - Thông tin người dùng và authentication
- **questions** - Ngân hàng câu hỏi
- **answers** - Các lựa chọn trả lời
- **subjects** - Danh mục môn học
- **score** - Kết quả thi
- **login_token** - Quản lý session

## 📦 Cài đặt và triển khai

### Yêu cầu hệ thống

- **PHP 7.4** trở lên
- **MySQL 5.7+** hoặc **MariaDB 10.3+**
- **Apache/Nginx** web server
- **Composer** (optional, cho package management)

### 🚀 Cài đặt Local Development

1. **Clone repository:**

```bash
git clone https://github.com/dammanhdungvn/website_online.git
cd website_online
```

2. **Cấu hình web server:**

```bash
# Với XAMPP/WAMP
# Copy project vào htdocs/www folder

# Với Apache Virtual Host
sudo nano /etc/apache2/sites-available/tracnghiem.conf
```

3. **Tạo cơ sở dữ liệu:**

```sql
CREATE DATABASE tracnghiemonline CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

4. **Import database:**

```bash
mysql -u root -p tracnghiemonline < database/if0_38101093_tracnghiemonline.sql
```

5. **Cấu hình kết nối database:**

```php
// includes/connect.php
$servername = "localhost";
$username = "root";
$password = "yourpassword";
$dbname = "tracnghiemonline";
$port = 3306;
```

6. **Cấu hình email (PHPMailer):**

```php
// includes/functions.php
$mail->Username = 'your-email@gmail.com';
$mail->Password = 'your-app-password';
```

### 🌐 Production Deployment

1. **Upload files** lên hosting provider
2. **Tạo database** trên hosting control panel
3. **Import SQL file** qua phpMyAdmin
4. **Cập nhật config** với thông tin hosting:

```php
// includes/connect.php - Production config
$servername = "sql211.infinityfree.com";
$username = "if0_38101093";
$password = "your-db-password";
$dbname = "if0_38101093_tracnghiemonline";
```

## 🎯 Hướng dẫn sử dụng

### 👤 Dành cho Người dùng

#### Đăng ký tài khoản

1. Truy cập `/modules/auth/register.php`
2. Điền thông tin: Họ, Tên, Email, Số điện thoại, Mật khẩu
3. Kiểm tra email và click link kích hoạt
4. Đăng nhập với tài khoản đã tạo

#### Tham gia thi

1. Đăng nhập vào hệ thống
2. Chờ giáo viên tạo đề thi
3. Click vào link thi được cung cấp
4. Làm bài trong thời gian quy định
5. Submit bài thi và xem kết quả

### 👨‍🏫 Dành cho Giáo viên/Admin

#### Quản lý câu hỏi

1. **Thêm câu hỏi mới:**
   - Vào "Thêm câu hỏi" từ dashboard
   - Nhập nội dung câu hỏi
   - Thêm 4 lựa chọn trả lời
   - Đánh dấu đáp án đúng
   - Chọn môn học

2. **Quản lý ngân hàng câu hỏi:**
   - Vào "Ngân hàng câu hỏi"
   - Lọc theo môn học
   - Chỉnh sửa hoặc xóa câu hỏi

#### Tạo đề thi

1. Vào "Tạo đề kiểm tra"
2. Chọn môn học
3. Thiết lập:
   - Số lượng câu hỏi
   - Thời gian làm bài (phút)
   - Số câu hỏi skip (nếu có)
4. Hệ thống sẽ tự động tạo đề thi random

#### Xem kết quả

1. Vào "Kết quả kiểm tra"
2. Xem danh sách kết quả thi
3. Phân tích thống kê điểm số

## 📊 Cấu trúc dữ liệu

### 🔑 Bảng Users

```sql
CREATE TABLE `users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `FIRSTNAME` varchar(50) NOT NULL,
  `LASTNAME` varchar(50) NOT NULL,
  `EMAIL` varchar(100) NOT NULL,
  `PHONE` varchar(20) DEFAULT NULL,
  `PASSWORD` varchar(100) NOT NULL,
  `FORGOT_TOKEN` varchar(255) DEFAULT NULL,
  `ACTIVE_TOKEN` varchar(255) DEFAULT NULL,
  `STATUS` int(11) NOT NULL DEFAULT 0,
  `CREATED_AT` timestamp NOT NULL DEFAULT current_timestamp(),
  `UPDATED_AT` timestamp NOT NULL DEFAULT current_timestamp()
);
```

### 📝 Bảng Questions

```sql
CREATE TABLE `questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` text NOT NULL,
  `subject_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
);
```

### ✅ Bảng Answers

```sql
CREATE TABLE `answers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) NOT NULL,
  `answer` text NOT NULL,
  `is_correct` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id`)
);
```

### 📚 Bảng Subjects

```sql
CREATE TABLE `subjects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_subject` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
);
```

### 🏆 Bảng Score

```sql
CREATE TABLE `score` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `POINT` int(11) NOT NULL,
  `QUESTIONS` int(11) NOT NULL,
  `CREATED_AT` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`ID`)
);
```

## 🛠️ API Endpoints

| Method | Endpoint | Mô tả | Parameters |
|--------|----------|-------|------------|
| `GET` | `/API/data.php` | Lấy danh sách câu hỏi | `limit`, `skip`, `subject` |
| `POST` | `/modules/auth/login.php` | Đăng nhập | `email`, `password` |
| `POST` | `/modules/auth/register.php` | Đăng ký | `firstname`, `lastname`, `email`, `phone`, `password` |
| `POST` | `/modules/home/query_add_question.php` | Thêm câu hỏi | `question`, `answers[]`, `correct_answer`, `subject` |
| `POST` | `/modules/home/save_score.php` | Lưu điểm thi | `score` (JSON) |
| `GET` | `/modules/home/get_questions.php` | Lấy câu hỏi theo môn | `subject_id` |

### Ví dụ API Response

```json
{
  "questions": [
    {
      "quiz_id": 1,
      "question": "Phần mềm mã nguồn mở nào được sử dụng để quản lý dự án?",
      "answers": ["OpenProject", "Microsoft Project", "Primavera", "Basecamp"]
    }
  ],
  "correct_answers": [
    {
      "quiz_id": 1,
      "answer": "OpenProject"
    }
  ]
}
```

## 🔒 Bảo mật và Best Practices

### Bảo mật ứng dụng

- **Password Security**: Sử dụng `password_hash()` và `password_verify()`
- **Session Security**: Regenerate session ID sau login
- **SQL Injection**: Sử dụng prepared statements
- **XSS Prevention**: HTML encoding cho user input
- **CSRF Protection**: Token validation cho sensitive operations

### Validation và Error Handling

```php
// Example: Input validation
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Error handling
function handleDatabaseError($error) {
    error_log($error);
    return "Hệ thống đang bảo trì, vui lòng thử lại sau";
}
```

### Performance Optimization

- **Database Indexing**: Tối ưu query với proper indexes
- **Caching**: Implement session và query caching
- **Minification**: Compress CSS/JS files
- **Image Optimization**: Optimize images và icons

## 🚀 Roadmap phát triển

### Version 2.0 - Tính năng nâng cao

- [ ] **Multi-choice questions** - Câu hỏi nhiều đáp án đúng
- [ ] **Question pools** - Nhóm câu hỏi theo độ khó
- [ ] **Time tracking** - Theo dõi thời gian từng câu hỏi
- [ ] **Real-time monitoring** - Giám sát thi trực tuyến
- [ ] **Advanced reporting** - Báo cáo chi tiết với biểu đồ

### Version 2.5 - Mobile & UX

- [ ] **Progressive Web App** - PWA cho mobile
- [ ] **Offline support** - Làm bài offline
- [ ] **Dark mode** - Giao diện tối
- [ ] **Accessibility** - Hỗ trợ người khuyết tật
- [ ] **Multi-language** - Đa ngôn ngữ

### Version 3.0 - Enterprise Features

- [ ] **Role-based access** - Phân quyền chi tiết
- [ ] **Question bank sharing** - Chia sẻ ngân hàng câu hỏi
- [ ] **Integration APIs** - Tích hợp với LMS
- [ ] **Advanced analytics** - Phân tích học tập AI
- [ ] **Video questions** - Câu hỏi dạng video

## 🤝 Đóng góp và phát triển

### Hướng dẫn đóng góp

1. **Fork** repository này
2. **Create feature branch**: `git checkout -b feature/AmazingFeature`
3. **Commit changes**: `git commit -m 'Add some AmazingFeature'`
4. **Push to branch**: `git push origin feature/AmazingFeature`
5. **Open Pull Request**

### Coding Standards

- **PSR-12** coding standard cho PHP
- **ESLint** cho JavaScript
- **Semantic commit messages**
- **Comprehensive testing**

### Development Setup

```bash
# Install dependencies
composer install

# Setup environment
cp .env.example .env

# Run tests
php vendor/bin/phpunit

# Start development server
php -S localhost:8000
```

## 🐛 Troubleshooting

### Lỗi thường gặp

**1. Không kết nối được database**

```php
// Kiểm tra config trong includes/connect.php
$conn = mysqli_connect($servername, $username, $password, $dbname, $port);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
```

**2. Email không gửi được**

```php
// Kiểm tra config PHPMailer trong includes/functions.php
$mail->Username = 'your-email@gmail.com';
$mail->Password = 'your-app-password'; // Sử dụng App Password
```

**3. Session không hoạt động**

```php
// Đảm bảo session_start() được gọi
session_start();
```

**4. CSS/JS không load**

```php
// Kiểm tra đường dẫn trong config.php
define('_WEB_HOST_TEMPLATE', _WEB_HOST . '/templates');
```
---

## 📄 License và Credits

### License

Dự án này được phát hành dưới [MIT License](LICENSE).

### Credits

- **PHP** - Server-side scripting
- **MySQL** - Database management
- **Bootstrap** - CSS framework
- **PHPMailer** - Email functionality
- **FontAwesome** - Icons

### Contributors

- **Developer**: dammanhdungvn
<!-- - **Email**: [contact@example.com] -->
- **GitHub**: [@dammanhdungvn](https://github.com/dammanhdungvn)

## 📞 Liên hệ và hỗ trợ

### Thông tin liên hệ

- **📧 Email**: dammanhdungvn@gmail.com
<!-- - **🌐 Website**: https://tracnghiem.com -->
<!-- - **📱 Hotline**: +84 123 456 789 -->

<!-- ### Báo lỗi và đề xuất

- **🐛 Issues**: [GitHub Issues](https://github.com/dammanhdungvn/website_online/issues)
- **💡 Feature Requests**: [GitHub Discussions](https://github.com/dammanhdungvn/website_online/discussions)
- **📖 Documentation**: [Wiki](https://github.com/dammanhdungvn/website_online/wiki)

### Community

- **💬 Discord**: [Join our community](https://discord.gg/tracnghiem)
- **📘 Facebook**: [Facebook Page](https://facebook.com/tracnghiemonline)
- **🐦 Twitter**: [@TracNghiemOnline](https://twitter.com/TracNghiemOnline) -->

---

<div align="center">

**⭐ Nếu dự án này hữu ích với bạn, hãy cho chúng tôi một star trên GitHub! ⭐**

Made with ❤️ by [dammanhdungvn](https://github.com/dammanhdungvn)

</div>
