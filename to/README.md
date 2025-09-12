
# Gmail Markdown Previewer (Chrome Extension)

Write Gmail messages in **Markdown** or **raw HTML**, see a **live preview**, and insert the rendered HTML into your draft.

## Install (Developer Mode)

1. Download this folder as a zip and extract it.
2. Open Chrome → `chrome://extensions/`
3. Toggle **Developer mode** (top-right).
4. Click **Load unpacked** and select the extracted folder.
5. Open **Gmail** and start composing a message. A floating button **“Markdown ▶”** will appear.

## Usage

- Click **Markdown ▶** to open the side panel.
- Type Markdown (default) or switch to **HTML mode** using the “מצב: Markdown/HTML” button.
- The right pane shows a **live preview**.
- Click **“הכנס לטיוטה”** to replace the Gmail compose body with the rendered HTML.

## Notes

- The extension runs only on `https://mail.google.com/*`.
- No external network requests; the Markdown parser is bundled locally.
- If you have multiple compose windows open, the **most recently visible** one is targeted.
