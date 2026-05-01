<?php
session_start();
$password_hash = 'putyourhashhere'; 
$auth = isset($_SESSION['admin']);

// 登录逻辑
if (isset($_POST['login'])) {
    if (password_verify($_POST['pw'], $password_hash)) $_SESSION['admin'] = true;
    header("Location: index.php"); exit;
}
if (isset($_GET['logout'])) { session_destroy(); header("Location: index.php"); exit; }

// 发布文章
if ($auth && isset($_POST['content'])) {
    $title = htmlspecialchars($_POST['title']);
    $file = 'post/' . date('Ymd-His') . '.html';
    $template = "<html><head><meta charset='utf-8'><title>$title</title><style>body{max-width:600px;margin:40px auto;line-height:1.6;font-family:sans-serif;padding:0 10px}</style></head>
                 <body><a href='../index.php'>← Back</a><h1>$title</h1><hr>{$_POST['content']}</body></html>";
    file_put_contents($file, $template);
}

// 删除文章
if ($auth && isset($_GET['del'])) {
    $target = 'post/' . basename($_GET['del']);
    if (file_exists($target)) unlink($target);
    header("Location: index.php"); exit;
}

$posts = glob("post/*.html");
rsort($posts); // 按时间倒序
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>My Blog</title>
    <style>body{max-width:600px;margin:40px auto;font-family:sans-serif;padding:20px;line-height:1.6} .post-item{display:flex;justify-content:space-between;margin-bottom:10px} textarea{width:100%;height:200px;margin:10px 0}</style>
</head>
<body>
    <?php if (!$auth): ?>
        <h1>My Blog</h1>
        <?php foreach($posts as $p): 
    // 读取文件内容并提取标题
    $html = file_get_contents($p);
    preg_match('/<title>(.*?)<\/title>/', $html, $matches);
    $display_title = $matches[1] ?? basename($p); 
?>
    <div class="post-item">
        <a href="<?= $p ?>"><?= $display_title ?></a>
        <?php if ($auth): ?>
            <a href="?del=<?= basename($p) ?>" onclick="return confirm('Delete?')">Delete</a>
        <?php endif; ?>
    </div>
<?php endforeach; ?>
        <hr><form method="post"><input type="password" name="pw" placeholder="Admin?"><button name="login">Login</button></form>
    <?php else: ?>
        <h1>Admin Console <small><a href="?logout=1">Logout</a></small></h1>
        <form method="post">
            <input type="text" name="title" placeholder="Post Title" required style="width:100%">
            <textarea name="content" placeholder="HTML content allowed..." required></textarea>
            <button>Publish</button>
        </form>
        <hr>
        <?php foreach($posts as $p): 
    // 读取文件内容并提取标题
    $html = file_get_contents($p);
    preg_match('/<title>(.*?)<\/title>/', $html, $matches);
    $display_title = $matches[1] ?? basename($p); 
?>
    <div class="post-item">
        <a href="<?= $p ?>"><?= $display_title ?></a>
        <?php if ($auth): ?>
            <a href="?del=<?= basename($p) ?>" onclick="return confirm('Delete?')">Delete</a>
        <?php endif; ?>
    </div>
<?php endforeach; ?>
    <?php endif; ?>
</body>
</html>