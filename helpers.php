<?php
// helpers.php — small utilities
function e($s){ return htmlspecialchars($s ?? "", ENT_QUOTES, 'UTF-8'); }
function logged_in(){ return isset($_SESSION['user_id']); }
function uid(){ return $_SESSION['user_id'] ?? null; }
function redirect_js($to){ echo "<script>window.location.href='".e($to)."';</script>"; exit; }
function csrf_token(){
    if(empty($_SESSION['csrf'])) $_SESSION['csrf']=bin2hex(random_bytes(16));
    return $_SESSION['csrf'];
}
function csrf_check($t){ return isset($_SESSION['csrf']) && hash_equals($_SESSION['csrf'],$t ?? ""); }
function upload_image($field, $dir='uploads'){
    if(!isset($_FILES[$field]) || $_FILES[$field]['error']!==UPLOAD_ERR_OK) return null;
    if(!is_dir($dir)) mkdir($dir,0775,true);
    $tmp = $_FILES[$field]['tmp_name'];
    $info = getimagesize($tmp);
    if(!$info) return null;
    $ext = image_type_to_extension($info[2], false);
    $name = $dir."/".time()."_".bin2hex(random_bytes(4)).".".$ext;
    move_uploaded_file($tmp, $name);
    return $name;
}
