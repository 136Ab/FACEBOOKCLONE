<?php require_once "auth_guard.php"; require_once "helpers.php";
$id=(int)($_GET['id'] ?? 0);
$st=$conn->prepare("SELECT user_id,content,image_path FROM posts WHERE id=?");
$st->bind_param("i",$id); $st->execute(); $p=$st->get_result()->fetch_assoc();
if(!$p || $p['user_id']!=uid()) redirect_js("home.php");
if($_SERVER['REQUEST_METHOD']==='POST'){
  if(!csrf_check($_POST['csrf'] ?? "")) die("Bad request");
  $content=trim($_POST['content'] ?? "");
  $img = upload_image('image');
  if($img){
    $u=$conn->prepare("UPDATE posts SET content=?, image_path=?, updated_at=NOW() WHERE id=?");
    $u->bind_param("ssi",$content,$img,$id);
  }else{
    $u=$conn->prepare("UPDATE posts SET content=?, updated_at=NOW() WHERE id=?");
    $u->bind_param("si",$content,$id);
  }
  $u->execute(); redirect_js("home.php");
}
?>
<!DOCTYPE html><html><head><meta charset="utf-8"><title>Edit Post</title>
<style>
body{font-family:system-ui;background:#0b1220;color:#e8eef6;margin:0}
.card{max-width:680px;margin:8vh auto;background:#10151d;border:1px solid #1b2638;border-radius:14px;padding:16px}
textarea{width:100%;min-height:120px;border-radius:12px;border:1px solid #233043;background:#0c111b;color:#e8eef6;padding:10px}
input[type=file],input[type=submit],button{margin-top:12px;padding:10px 12px;border-radius:10px;border:1px solid #22314a;background:#121a29;color:#dbe6ff}
</style></head><body>
<div class="card">
  <h2>Edit Post</h2>
  <form method="post" enctype="multipart/form-data">
    <input type="hidden" name="csrf" value="<?=e(csrf_token())?>">
    <textarea name="content" required><?=e($p['content'])?></textarea>
    <div>Current image: <?= $p['image_path'] ? "<a href='".e($p['image_path'])."' target='_blank'>view</a>" : "none" ?></div>
    <input type="file" name="image" accept="image/*">
    <input type="submit" value="Save">
    <button type="button" onclick="window.history.back()">Cancel</button>
  </form>
</div>
</body></html>
