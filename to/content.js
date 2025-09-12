
// Gmail Markdown Previewer - content script
(function() {
  const STATE = {
    panel: null,
    toggleBtn: null,
    editor: null,
    preview: null,
    useMarkdown: true
  };

  function ready(fn) {
    if (document.readyState !== 'loading') fn();
    else document.addEventListener('DOMContentLoaded', fn);
  }

  // Utility: find the active compose body
  function getActiveComposeBody() {
    // Gmail uses div[aria-label="Message body"] with contentEditable
    const bodies = Array.from(document.querySelectorAll('div[aria-label="Message body"]'));
    if (!bodies.length) return null;
    // Prefer the one currently in view
    const visible = bodies.filter(el => el.offsetParent !== null);
    return (visible[visible.length-1] || bodies[bodies.length-1]) || null;
  }

  // Utility: insert HTML at cursor/replace in compose
  function setComposeHTML(html) {
    const body = getActiveComposeBody();
    if (!body) {
      alert('לא נמצא חלון כתיבה פעיל בג׳ימייל.');
      return;
    }
    // Replace the compose body with our HTML
    body.focus();
    body.innerHTML = html;
  }

  // Build UI panel
  function buildPanel() {
    if (STATE.panel) return STATE.panel;

    // Toggle button
    const toggle = document.createElement('button');
    toggle.className = 'gmdp-toggle';
    toggle.textContent = 'Markdown ▶';
    toggle.title = 'פתח/סגור עורך Markdown ל-Gmail';
    toggle.addEventListener('click', () => {
      STATE.panel.style.display = (STATE.panel.style.display === 'none' || !STATE.panel.style.display) ? 'block' : 'none';
    });
    document.body.appendChild(toggle);
    STATE.toggleBtn = toggle;

    // Panel
    const panel = document.createElement('div');
    panel.className = 'gmdp-panel';
    panel.innerHTML = `
      <div class="gmdp-header">
        <div>
          <span class="gmdp-badge">Gmail</span>
          <strong class="gmdp-title">עורך Markdown/HTML + תצוגה מקדימה</strong>
        </div>
        <div class="gmdp-actions">
          <button class="gmdp-btn" data-action="mode">מצב: Markdown</button>
          <button class="gmdp-btn" data-action="clear">נקה</button>
          <button class="gmdp-btn primary" data-action="insert">הכנס לטיוטה</button>
          <button class="gmdp-btn" data-action="close">סגור</button>
        </div>
      </div>
      <div class="gmdp-body">
        <div class="gmdp-col">
          <textarea dir="rtl" placeholder="כתוב כאן Markdown או HTML...">
# 📢 עלון - אישור קבלה

✨ כתבתך **התקבלה בהצלחה** ✨  
ותפורסם בהקדם בעלון.

---

> הודעה זו נשלחה באופן אוטומטי, נא לא להשיב אליה.
          </textarea>
          <div class="gmdp-help">טיפ: לחץ על "מצב: Markdown" כדי לעבור למצב HTML גולמי.</div>
        </div>
        <div class="gmdp-col">
          <div class="gmdp-preview" dir="rtl"></div>
        </div>
      </div>
    `;
    document.body.appendChild(panel);
    STATE.panel = panel;
    STATE.editor = panel.querySelector('textarea');
    STATE.preview = panel.querySelector('.gmdp-preview');

    // Actions
    panel.querySelector('[data-action="close"]').addEventListener('click', () => {
      panel.style.display = 'none';
    });
    panel.querySelector('[data-action="clear"]').addEventListener('click', () => {
      STATE.editor.value = '';
      render();
    });
    panel.querySelector('[data-action="insert"]').addEventListener('click', () => {
      const html = getRenderedHTML();
      setComposeHTML(html);
    });
    panel.querySelector('[data-action="mode"]').addEventListener('click', (e) => {
      STATE.useMarkdown = !STATE.useMarkdown;
      e.currentTarget.textContent = 'מצב: ' + (STATE.useMarkdown ? 'Markdown' : 'HTML');
      render();
    });

    // Live render
    STATE.editor.addEventListener('input', render);
    render();

    return panel;
  }

  function getRenderedHTML() {
    const src = STATE.editor.value || '';
    if (STATE.useMarkdown) {
      try {
        // marked is loaded via lib/marked.min.js
        return marked.parse(src, { breaks: true, gfm: true });
      } catch(e) {
        console.error(e);
        return `<pre>${escapeHTML(src)}</pre>`;
      }
    } else {
      return src;
    }
  }

  function render() {
    const html = getRenderedHTML();
    STATE.preview.innerHTML = html;
  }

  function escapeHTML(s) {
    return s.replace(/[&<>"']/g, c => ({
      '&': '&amp;',
      '<': '&lt;',
      '>': '&gt;',
      '"': '&quot;',
      "'": '&#39;'
    }[c]));
  }

  // Initialize when Gmail is ready
  ready(() => {
    // Build after a small delay to ensure Gmail UI is present
    setTimeout(buildPanel, 1500);
  });
})();
