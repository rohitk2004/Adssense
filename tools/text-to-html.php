<?php
include '../includes/config.php';
$pageInfo = [
    'title' => 'Free Text to HTML Converter - ' . SITE_NAME,
    'description' => 'Convert plain text into clean, formatted HTML code instantly.'
];
include '../includes/header.php';
?>

<style>
    /* Reusing styles from paraphraser for consistency */
    .tool-container {
        max-width: 1000px;
        margin: 0 auto;
        padding-top: 2rem;
    }

    .tool-header {
        text-align: center;
        margin-bottom: 3rem;
    }

    .tool-workspace {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 2rem;
        background: var(--bg-card);
        padding: 2rem;
        border-radius: 24px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        box-shadow: var(--shadow-soft);
    }

    .input-group {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .input-group label {
        font-weight: 600;
        color: var(--text-secondary);
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    textarea {
        width: 100%;
        height: 400px;
        background: var(--bg-elevated);
        border: 2px solid rgba(255, 255, 255, 0.05);
        border-radius: 16px;
        padding: 1.5rem;
        color: var(--text-primary);
        font-family: 'Courier New', monospace;
        /* Monospace for code */
        font-size: 0.95rem;
        line-height: 1.6;
        resize: none;
        transition: all 0.3s ease;
    }

    textarea:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 20px rgba(51, 153, 255, 0.1);
    }

    .controls {
        grid-column: 1 / -1;
        display: flex;
        justify-content: center;
        gap: 1rem;
        padding: 1rem 0;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        margin-top: 1rem;
    }

    .btn-action {
        padding: 0.8rem 2rem;
        background: var(--gradient-primary);
        color: white;
        border: none;
        border-radius: 12px;
        font-weight: 700;
        cursor: pointer;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .btn-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(51, 153, 255, 0.3);
    }

    .btn-secondary {
        background: transparent;
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: var(--text-secondary);
    }

    .options-panel {
        grid-column: 1 / -1;
        display: flex;
        gap: 2rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        margin-bottom: 1rem;
        color: var(--text-secondary);
    }

    .checkbox-wrapper {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        cursor: pointer;
    }

    .checkbox-wrapper input {
        width: 18px;
        height: 18px;
        cursor: pointer;
    }

    @media (max-width: 768px) {
        .tool-workspace {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="container tool-container">
    <div class="tool-header">
        <h1>Text to HTML Converter</h1>
        <p class="subtitle">Transform plain text into clean, structured HTML markup.</p>
    </div>

    <div class="tool-workspace">
        <div class="options-panel">
            <label class="checkbox-wrapper">
                <input type="checkbox" id="optParagraphs" checked> Use &lt;p&gt; tags
            </label>
            <label class="checkbox-wrapper">
                <input type="checkbox" id="optBr" checked> Use &lt;br&gt; for single line breaks
            </label>
            <label class="checkbox-wrapper">
                <input type="checkbox" id="optBold" checked> Convert **bold** to &lt;strong&gt;
            </label>
        </div>

        <div class="input-group">
            <label for="inputText">Plain Text Input</label>
            <textarea id="inputText" placeholder="Paste your text here..."></textarea>
        </div>

        <div class="input-group">
            <label for="outputText">HTML Output</label>
            <textarea id="outputText" readonly placeholder="HTML code will appear here..."></textarea>
        </div>

        <div class="controls">
            <button class="btn-action" onclick="convertToHtml()">
                Generate HTML
            </button>
            <button class="btn-action btn-secondary" onclick="copyResult()">
                Copy Code
            </button>
            <button class="btn-action btn-secondary" onclick="clearAll()">
                Clear
            </button>
        </div>
    </div>
</div>

<script>
    function escapeHtml(text) {
        return text
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;");
    }

    function convertToHtml() {
        let input = document.getElementById('inputText').value;
        if (!input) return;

        // Escape existing HTML entities to prevent conflicts/XSS
        input = escapeHtml(input);

        // Options
        const useParagraphs = document.getElementById('optParagraphs').checked;
        const useBr = document.getElementById('optBr').checked;
        const convertBold = document.getElementById('optBold').checked;

        let output = input;

        // Convert **text** to <strong>text</strong>
        if (convertBold) {
            output = output.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>');
        }

        // Handle Paragraphs and Line Breaks
        if (useParagraphs) {
            // Split by double newline to identify paragraphs
            const paragraphs = output.split(/\n\s*\n/);

            output = paragraphs.map(para => {
                if (!para.trim()) return '';

                // Handle single line breaks if enabled
                let pContent = para;
                if (useBr) {
                    pContent = pContent.replace(/\n/g, '<br>\n');
                }

                return `<p>${pContent.trim()}</p>`;
            }).join('\n\n');
        } else if (useBr) {
            // If strictly just <br> tags without <p>
            output = output.replace(/\n/g, '<br>\n');
        }

        document.getElementById('outputText').value = output;
    }

    function copyResult() {
        const output = document.getElementById('outputText');
        output.select();
        document.execCommand('copy');
        alert('Copied HTML to clipboard!');
    }

    function clearAll() {
        document.getElementById('inputText').value = '';
        document.getElementById('outputText').value = '';
    }
</script>

<?php include '../includes/footer.php'; ?>