<?php
// theme.php
// Include this file and call print_theme() where you want the CSS injected (usually inside <head> or at top of <body>)
// Example: <?php require_once 'theme.php'; print_theme(); ?>

function print_theme(){
?>
<style>
/* ===== BlueNova / social theme (internal CSS) ===== */
body { 
    font-family: Arial, sans-serif; 
    margin: 0; 
    background: linear-gradient(to right, #f0f4ff, #e6faff); 
}

/* ===== Navbar ===== */
.navbar { 
    background: linear-gradient(90deg, #1877f2, #00c6ff); 
    padding: 12px 20px; 
    display: flex; 
    justify-content: space-between; 
    align-items: center; 
    color: white; 
    box-shadow: 0 2px 8px rgba(0,0,0,0.2);
    position: sticky;
    top: 0;
    z-index: 999;
}
.navbar .brand { font-weight: 700; font-size: 18px; }
.navbar .menu { display:flex; gap:12px; align-items:center; }
.navbar a { 
    color: white; 
    text-decoration: none; 
    margin: 0 8px; 
    font-weight: 600; 
    transition: all 0.18s ease; 
    padding:6px 10px;
    border-radius:6px;
}
.navbar a:hover { 
    color: #ffeb3b; 
    transform: translateY(-2px);
    background: rgba(255,255,255,0.06);
}

/* ===== Container ===== */
.container { 
    width: 92%; 
    max-width: 900px; 
    margin: 22px auto; 
}

/* ===== Card ===== */
.card { 
    background: white; 
    padding: 20px; 
    border-radius: 14px; 
    margin-bottom: 20px; 
    box-shadow: 0 6px 18px rgba(13,38,65,0.06); 
    transition: transform 0.18s, box-shadow 0.18s;
}
.card:hover { 
    transform: translateY(-4px); 
    box-shadow: 0 10px 30px rgba(13,38,65,0.09); 
}

/* ===== Post Box ===== */
.post-box { display:block; }
.post-box .greet { font-size:20px; font-weight:700; margin-bottom:12px; color:#0b3b8c; }
.post-box textarea {
    width: 100%; 
    padding: 14px; 
    border: 1px solid #e1e8f5; 
    border-radius: 12px; 
    margin-top: 6px;
    resize: vertical; 
    min-height: 90px;
    font-size: 15px;
    color: #111;
    background: linear-gradient(180deg, #ffffff, #fbfdff);
    box-shadow: inset 0 1px 0 rgba(0,0,0,0.02);
}
.post-actions { display:flex; align-items:center; gap:12px; margin-top:12px; }
.btn {
    background: linear-gradient(90deg, #42b72a, #36a420); 
    color: white; 
    padding: 10px 18px; 
    border: none; 
    border-radius: 10px; 
    cursor: pointer; 
    font-weight: 700; 
    box-shadow: 0 6px 16px rgba(54,164,32,0.12);
    transition: transform .14s ease, box-shadow .14s ease;
}
.btn:hover { transform: translateY(-3px); box-shadow: 0 10px 22px rgba(54,164,32,0.16); }

/* ===== Post list ===== */
.post {
    background: linear-gradient(180deg,#ffffff,#fcfeff);
    padding: 18px;
    border-radius: 12px;
    margin-bottom: 16px;
    border: 1px solid rgba(15,40,80,0.04);
}
.post .head { display:flex; gap:12px; align-items:center; margin-bottom:8px;}
.avatar {
    width:48px; height:48px; border-radius:50%; object-fit:cover; border:2px solid #fff;
    box-shadow: 0 3px 10px rgba(10,30,60,0.08);
}
.post .name { font-weight:700; color:#1877f2; font-size:15px; }
.post .time { color:#7b8aa3; font-size:13px; margin-left:6px; }
.post .content { margin-top:8px; font-size:15px; color:#111; line-height:1.5; }
.post img.post-image { max-width:100%; border-radius:10px; margin-top:12px; }

/* ===== Actions under each post ===== */
.post .meta { display:flex; gap:14px; align-items:center; margin-top:12px; color:#556575; font-size:14px; }
.meta button { background:transparent; border:0; cursor:pointer; color:#1877f2; font-weight:600; padding:6px 8px; border-radius:8px; transition:background .12s; }
.meta button:hover { background: rgba(24,119,242,0.08); transform:translateY(-2px); }

/* ===== Friends / messages list ===== */
.side-list { display:grid; gap:10px; }
.friend-card, .message-card { 
    display:flex; align-items:center; gap:12px; background:#fff; padding:10px; border-radius:10px; border:1px solid rgba(15,40,80,0.03);
}
.friend-card img, .message-card img { width:46px; height:46px; border-radius:50%; object-fit:cover; }

/* ===== Responsive ===== */
@media (max-width:760px){
    .container { width:95%; }
    .navbar .menu { gap:8px; font-size:14px; }
    .post-box textarea { min-height:80px; }
}

/* small helper classes */
.text-muted { color:#7b8aa3; font-size:13px; }
.right { margin-left:auto; }
</style>
<?php
}
?>
