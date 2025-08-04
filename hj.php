<!DOCTYPE html>
<html lang="he" dir="rtl">
<head>
    <meta charset="UTF-8"><title>ניהול מערכת</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Hebrew:wght@400;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #3a7bd5; --secondary-color: #3a60d5; --success-color: #28a745;
            --warning-color: #ffc107; --danger-color: #dc3545; --info-color: #17a2b8;
            --light-gray: #f8f9fa; --gray: #dee2e6; --text-color: #343a40; --border-radius: 8px;
            --box-shadow: 0 4px 15px rgba(0, 0, 0, 0.07);
        }
        body { font-family: 'Noto Sans Hebrew', Arial, sans-serif; margin: 0; padding: 15px; background-color: var(--light-gray); color: var(--text-color); font-size: 16px; }
        .container { max-width: 1200px; margin: auto; background: #fff; padding: 20px; border-radius: var(--border-radius); box-shadow: var(--box-shadow); }
        .page-header { display: flex; flex-direction: column; align-items: center; text-align: center; border-bottom: 1px solid var(--gray); padding-bottom: 15px; margin-bottom: 20px; gap: 15px; }
        .page-header .logo { max-height: 50px; order: 1; }
        .page-header .header-text { font-size: 14px; color: #555; line-height: 1.7; order: 2; }
        .page-header .header-text a { color: var(--primary-color); font-weight: bold; text-decoration: none; }
        .page-header .header-text a:hover { text-decoration: underline; }
        .page-header .header-text i { margin-left: 5px; } .page-header .header-text .whatsapp i { color: #25D366; }
        h1, h2, h3 { text-align: center; color: var(--primary-color); font-weight: 700; margin: 1.5rem 0 1rem 0; }
        h1 { font-size: 1.8rem; } h2 { font-size: 1.5rem; } h3 { color: var(--secondary-color); font-size: 1.3rem; border-bottom: 2px solid var(--light-gray); padding-bottom: 10px; }
        .message { padding: 15px; border-radius: var(--border-radius); margin-bottom: 20px; text-align: center; font-weight: bold; border: 1px solid transparent; }
        .error { color: #721c24; background-color: #f8d7da; border-color: #f5c6cb; }
        .success { color: #155724; background-color: #d4edda; border-color: #c3e6cb; }
        .form-group, .form-check { margin-bottom: 15px; }
        label { margin-bottom: 8px; font-weight: bold; text-align: right; font-size: 1rem; display: block; }
        input[type="text"], input[type="password"], input[type="email"], input[type="datetime-local"], select, input[type="number"], input[type="time"], textarea { width: 100%; box-sizing: border-box; padding: 12px 15px; border: 1px solid var(--gray); border-radius: var(--border-radius); font-size: 16px; background: #fff; }
        button, .button { display: inline-flex; align-items: center; justify-content: center; gap: 8px; padding: 12px 20px; border: none; border-radius: var(--border-radius); color: white; font-weight: bold; font-size: 1rem; cursor: pointer; transition: all 0.2s; box-shadow: 0 2px 5px rgba(0,0,0,0.1); width: 100%; margin-top: 5px; }
        button:hover, .button:hover { transform: translateY(-2px); box-shadow: 0 4px 8px rgba(0,0,0,0.15); }
        button:disabled { background-color: #ccc; cursor: not-allowed; transform: none; box-shadow: none; }
        .login-form { max-width: 400px; margin: 20px auto; }
        .login-form button { background-color: var(--primary-color); }
        .tab-container { display: flex; flex-wrap: wrap; border-bottom: 3px solid var(--gray); margin-bottom: 25px; }
        .tab-button { padding: 10px; cursor: pointer; background: transparent; border: none; border-bottom: 3px solid transparent; font-weight: bold; font-size: 0.9rem; color: #888; display: flex; align-items: center; gap: 8px; flex-grow: 1; justify-content: center; }
        .tab-button.active { color: var(--primary-color); border-bottom-color: var(--primary-color); }
        .tab-content { display: none; } .tab-content.active { display: block; animation: fadeIn 0.5s; }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        thead { display: none; }
        tr { display: block; border: 1px solid var(--gray); border-radius: var(--border-radius); margin-bottom: 15px; padding: 10px; background: #fff; box-shadow: var(--box-shadow); }
        td { display: flex; justify-content: space-between; align-items: center; padding: 8px 5px; text-align: right; border-bottom: 1px solid var(--light-gray); flex-wrap: wrap; }
        td:last-child { border-bottom: none; }
        td::before { content: attr(data-label); font-weight: bold; margin-left: 10px; flex-shrink: 0; }
        .actions { margin-bottom: 20px; padding: 15px; background: var(--light-gray); border-radius: var(--border-radius); }
        .actions .buttons { display: flex; flex-wrap: wrap; gap: 10px; }
        .download-btn { background-color: var(--primary-color); }
        .copy-btn { background-color: var(--info-color); }
        .select-all-btn { background-color: var(--warning-color); color: #333; }
        .download-folder-btn { background-color: var(--success-color); }
        .details-grid { display: grid; grid-template-columns: 1fr; gap: 20px; }
        .details-list { list-style-type: none; padding: 0; margin: 0; }
        .details-list li { padding: 12px 0; border-bottom: 1px solid var(--light-gray); display: flex; align-items: center; gap: 10px; flex-wrap: wrap; }
        .details-list li i { color: var(--primary-color); font-size: 1.2rem; width: 25px; text-align: center; }
        .details-list li strong { font-weight: bold; color: #000; word-break: break-all; }
        .details-list li span { color: #555; }
        .path-info { background: #e9ecef; padding: 10px 15px; border-radius: var(--border-radius); margin-bottom: 20px; font-weight: bold; }
        .modal-overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.6); z-index: 1000; display: none; justify-content: center; align-items: flex-start; padding: 15px; overflow-y: auto; }
        .modal-content { background: #fff; padding: 25px; border-radius: var(--border-radius); width: 100%; max-width: 600px; position: relative; animation: slideIn 0.3s; margin-top: 5vh; margin-bottom: 5vh; }
        .close-modal { position: absolute; top: 10px; left: 15px; font-size: 28px; font-weight: bold; cursor: pointer; color: #888; }
        .status-icon { font-size: 1.5em; line-height: 1; vertical-align: middle; } .status-icon.active { color: var(--success-color); } .status-icon.inactive { color: var(--danger-color); }
        .task-actions button { width: auto; padding: 6px 12px; font-size: 0.9rem; margin: 2px; }
        .day-selector { display: flex; justify-content: space-around; background: var(--light-gray); padding: 10px; border-radius: var(--border-radius); margin-bottom: 15px; flex-wrap: wrap; }
        .day-selector label { display: flex; flex-direction: column; align-items: center; cursor: pointer; padding: 5px; }
        .day-selector input { margin-top: 5px; transform: scale(1.2); }
        .button-group { display: flex; gap: 5px; margin-bottom: 15px; }
        .button-group .button { flex: 1; background-color: var(--gray); color: var(--text-color); }
        .button-group .button.active { background-color: var(--primary-color); color: white; }

        @media (min-width: 768px) {
            body { padding: 20px; }
            .container { padding: 25px 30px; }
            .page-header { flex-direction: row; justify-content: space-between; text-align: right; }
            .page-header .logo { order: 2; } .page-header .header-text { order: 1; }
            button, .button { width: auto; }
            .tab-button { font-size: 1rem; }
            thead { display: table-header-group; }
            tr { display: table-row; border: 0; box-shadow: none; background: transparent; }
            tr:not(.header-row):not(.dir-row):hover { background-color: #eef5ff; }
            tr.dir-row:hover { background-color: #f1f1f1; }
            td { display: table-cell; text-align: right; vertical-align: middle; padding: 12px 15px; border-bottom: 1px solid var(--gray); }
            td::before { display: none; }
            .details-grid { grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); }
        }
    </style>
</head>
<body>
<div class="container">
    <header class="page-header">
        <div class="header-text">
            אתר זה נבנה על ידי <strong>מרכזיה פלוס</strong>.<br>
            להזמנות ופיתוח:
            <a href="tel:0733517517"><i class="fa-solid fa-phone"></i> 073-3517517</a> |
            <a href="https://wa.me/972733517517" target="_blank" class="whatsapp"><i class="fa-brands fa-whatsapp"></i> וואטסאפ</a> |
            <a href="mailto:A0556762713@gmail.com"><i class="fa-solid fa-envelope"></i> מייל</a>
        </div>
        <img src="מרכזיה פלוס.png" alt="לוגו מרכזיה פלוס" class="logo">
    </header>

    <h1><i class="fa-solid fa-shield-halved"></i> ניהול מערכת</h1>
        
            <h2><i class="fa-solid fa-right-to-bracket"></i> התחברות</h2>
        <form action="" method="GET" class="login-form">
            <div class="form-group"><label for="did-input">מספר מערכת:</label><input type="text" id="did-input" name="did" value="" required></div>
            <div class="form-group"><label for="pass-input">סיסמה:</label><input type="password" id="pass-input" name="pass" required></div>
            <button type="submit" class="button login-form-button" style="background-color: var(--primary-color);"><i class="fa-solid fa-right-to-bracket"></i> התחבר</button>
        </form>
    </div>

<!-- All modals here -->
<div id="copy-modal" class="modal-overlay"> <div class="modal-content"> <span class="close-modal" onclick="closeCopyModal()">×</span> <h3>העתקת קבצים למערכת אחרת</h3> <p>הקבצים יועלו עם <strong>מספור אוטומטי</strong> לשלוחה שתבחר.</p> <div class="form-group"><label for="dest-did-input">מספר מערכת יעד:</label><input type="text" id="dest-did-input" required></div> <div class="form-group"><label for="dest-pass-input">סיסמת יעד:</label><input type="password" id="dest-pass-input" required></div> <div class="form-group"><label for="dest-extension-input">מספר שלוחה ביעד:</label><input type="text" id="dest-extension-input" placeholder="לדוגמה: 1 או 1/2" required></div> <button onclick="startCopyProcess()" class="button" style="background-color: var(--info-color);"><i class="fa-solid fa-rocket"></i> התחל העתקה</button> </div> </div>
<div id="task-modal" class="modal-overlay"> <div class="modal-content"> <span class="close-modal" onclick="closeTaskModal()">×</span> <h3 id="task-modal-title">יצירת משימה חדשה</h3> <form id="task-form" onsubmit="handleTaskFormSubmit(event)"> <input type="hidden" name="TaskId" id="TaskId"> <div class="form-group"><label for="task-description">תיאור המשימה</label><input type="text" id="task-description" name="description" required></div> <div class="form-group"> <label for="task-type">סוג המשימה</label> <select id="task-type" name="taskType" onchange="toggleTaskFields()" required> <option value="">בחר סוג...</option><option value="SendSMS">שליחת SMS</option><option value="RunTzintuk">הרצת צנתוק</option><option value="MoveOnFile">העברת קבצים</option> </select> </div> <div id="task-fields-container"> <div class="task-type-fields" data-type="SendSMS" style="display:none;"><div class="form-group"><label>מזהה/שם רשימת תפוצה</label><input type="text" name="smsList"></div><div class="form-group"><label>זיהוי יוצא</label><input type="text" name="callerId"></div><div class="form-group"><label>תוכן ההודעה</label><input type="text" name="smsMessage"></div></div> <div class="task-type-fields" data-type="RunTzintuk" style="display:none;"><div class="form-group"><label>מזהה/שם רשימה</label><input type="text" name="toList"></div><div class="form-group"><label>סוג רשימה</label><select name="typeList"><option value="tpl">tpl</option><option value="tzl">tzl</option></select></div><div class="form-group"><label>זיהוי יוצא</label><input type="text" name="callerId"></div></div> <div class="task-type-fields" data-type="MoveOnFile" style="display:none;"><div class="form-group"><label>תיקיית מקור</label><input type="text" name="folder"></div><div class="form-group"><label>תיקיית יעד</label><input type="text" name="target"></div><div class="form-group"><label>סוג קובץ להעברה</label><select name="moveFileType"><option value="maxFile">maxFile</option><option value="minFile">minFile</option></select></div><div class="form-group"><label>חסימת העברה אם קיים קובץ חדש ביעד (דקות)</label><input type="number" name="blockMoveIfNewFileInMinutes"></div></div> </div> <h3>תזמון</h3> <div class="details-grid"><div class="form-group"><label>דקה (0-59)</label><input type="number" name="minute" min="0" max="59"></div><div class="form-group"><label>שעה (0-23)</label><input type="number" name="hour" min="0" max="23"></div><div class="form-group"><label>יום בחודש (1-31)</label><input type="number" name="day" min="1" max="31"></div><div class="form-group"><label>חודש (1-12)</label><input type="number" name="month" min="1" max="12"></div><div class="form-group"><label>שנה</label><input type="number" name="year" min="2025"></div></div> <p style="text-align:center; font-size:0.9em;">השאר שדות ריקים כדי להתעלם מהם.</p> <label>ימי הרצה בשבוע</label> <div class="day-selector"><label>א<input type="checkbox" name="days" value="0"></label><label>ב<input type="checkbox" name="days" value="1"></label><label>ג<input type="checkbox" name="days" value="2"></label><label>ד<input type="checkbox" name="days" value="3"></label><label>ה<input type="checkbox" name="days" value="4"></label><label>ו<input type="checkbox" name="days" value="5"></label><label>ש<input type="checkbox" name="days" value="6"></label></div> <div class="form-check"><label><input type="checkbox" name="ifAnyDay" value="1"> התעלם מימים נבחרים והרץ בכל יום</label></div> <h3>אפשרויות</h3> <div class="details-grid"><div class="form-check"><label><input type="checkbox" name="active" value="1" checked> משימה פעילה</label></div><div class="form-check"><label><input type="checkbox" name="checkIsKodesh" value="1" checked> אל תריץ בשבת וחג</label></div><div class="form-check"><label><input type="checkbox" name="mailInEnd" value="1"> שלח מייל בסיום מוצלח</label></div><div class="form-check"><label><input type="checkbox" name="mailInError" value="1"> שלח מייל בכישלון</label></div></div> <button type="submit" id="task-submit-btn" class="button" style="background-color:var(--primary-color); margin-top: 20px;">שמור משימה</button> </form> </div> </div>
<div id="logs-modal" class="modal-overlay"><div class="modal-content"><span class="close-modal" onclick="document.getElementById('logs-modal').style.display='none'">×</span><h3 id="logs-modal-title">לוגים</h3><div id="logs-content"></div></div></div>

<script>
    
    // --- Global Functions ---
    function openTab(evt, tabName) {
        let i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tab-content");
        for (i = 0; i < tabcontent.length; i++) { tabcontent[i].style.display = "none"; }
        tablinks = document.getElementsByClassName("tab-button");
        for (i = 0; i < tablinks.length; i++) { tablinks[i].className = tablinks[i].className.replace(" active", ""); }
        document.getElementById(tabName).style.display = "block";
        if(evt) evt.currentTarget.className += " active";
            }

    document.addEventListener('DOMContentLoaded', function() {
        const activeTabId = "fileManager";
        const activeTabButton = document.querySelector('.tab-button[onclick*="\'' + activeTabId + '\'"]');
        if (activeTabButton) activeTabButton.click();
        else if (document.querySelector('.tab-button')) document.querySelector('.tab-button').click();

            });

    </script>
</body>
</html>
<!-- Injection By NetFree -->
<script src="https://netfree.link/injection-script/go-payment.js" type="text/javascript" async  ></script>
<script src="https://netfree.link/injection-script/popup-card-init.js" type="text/javascript" async  ></script>
