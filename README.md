# TSPB
The Simplest PHP  Blog / 极简 PHP Blog
## 功能特色：
- **极简设计**：不使用数据库，所有文章直接生成为静态 HTML，访问速度极快，且利于 SEO。
- **硬编码验证**：通过 Hash 匹配，避免了明文存储密码。

## 管理功能：
- **发表**：输入标题和内容（支持 HTML 标签），点击 Publish 后直接在 /post 下生成文件。
- **命名规范**：文件名自动设为 20260418-093001.html 这种格式，确保唯一且按时间排序。
- **管理**：登录后可以看到“Delete”链接，一键删除物理文件。
- **自动列表**：index.php 会自动扫描 /post 目录并显示所有已发布的文章链接。

## 注意事项:
- **安全**：虽然是极简版，但由于你会直接在编辑器里写内容，发布时建议不要输入未经转义的恶意脚本。
- **权限**：如果无法发布文章，请检查目录权限，通常命令为 chmod 755 post。
- **更改用户和用户组**： `chown -R www-data:www-data /var/www/html`

## Hash 建议
建议使用 PHP 原生的 password_hash 生成 Hash
`php -r "echo password_hash('你的密码', PASSWORD_DEFAULT) . PHP_EOL;"`

# English  Introduction
## Key Features:
- **Minimalist Design:** No database is used; all articles are generated directly as static HTML files, ensuring extremely fast access speeds and excellent SEO performance.
- **Hardcoded Authentication:** Authentication is handled via Hash matching, eliminating the need to store passwords in plaintext.

## Management Features:
- **Publishing:** Simply enter a title and content (HTML tags are supported); clicking "Publish" automatically generates the corresponding file directly within the `/post` directory.
- **Naming Convention:** Filenames are automatically formatted as `20260418-093001.html`, ensuring uniqueness and chronological sorting.
- **Administration:** Once logged in, a "Delete" link becomes visible, allowing for the one-click deletion of physical files.
- **Automatic Listing:** The `index.php` script automatically scans the `/post` directory and displays links to all published articles.

## Important Notes:
- **Security:** Although this is a minimalist application, since you will be entering content directly into the editor, it is strongly recommended that you do *not* input unescaped malicious scripts when publishing.
- **Permissions:** If you are unable to publish articles, please check your directory permissions; the standard command to fix this is `chmod 755 post`.
- **Changing User and Group Ownership:** `chown -R www-data:www-data /var/www/html`

## Hash Generation Recommendation
It is recommended to use PHP's native `password_hash` function to generate your password hash:
`php -r "echo password_hash('YourPasswordHere', PASSWORD_DEFAULT) . PHP_EOL;"`
