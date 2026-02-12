<?php
include '../includes/config.php';
$pageInfo = [
    'title' => 'Free Content Replacer Tool - ' . SITE_NAME,
    'description' => 'Find and replace text across large content blocks efficiently.'
];
include '../includes/header.php';
?>

<style>
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
        grid-template-columns: 1fr;
        gap: 2rem;
        background: var(--bg-card);
        padding: 2rem;
        border-radius: 24px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        box-shadow: var(--shadow-soft);
    }

    .replacer-controls {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
        background: var(--bg-elevated);
        padding: 1.5rem;
        border-radius: 16px;
        border: 1px solid rgba(255, 255, 255, 0.05);
    }

    .input-wrapper {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .input-wrapper label {
        font-size: 0.9rem;
        font-weight: 600;
        color: var(--text-secondary);
    }

    .input-wrapper input {
        padding: 0.8rem;
        border-radius: 8px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        background: var(--bg-card);
        color: var(--text-primary);
        font-size: 1rem;
    }

    .input-wrapper input:focus {
        outline: none;
        border-color: var(--primary);
    }

    .checkbox-options {
        grid-column: 1 / -1;
        display: flex;
        gap: 2rem;
        margin-top: 0.5rem;
    }

    .checkbox-label {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        cursor: pointer;
        color: var(--text-secondary);
        font-size: 0.9rem;
    }

    .io-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 2rem;
    }

    .io-section {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .io-section label {
        font-weight: 600;
        color: var(--text-secondary);
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.05em;
    }

    textarea {
        width: 100%;
        height: 400px;
        background: var(--bg-elevated);
        border: 2px solid rgba(255, 255, 255, 0.05);
        border-radius: 16px;
        padding: 1rem;
        color: var(--text-primary);
        font-family: inherit;
        font-size: 0.95rem;
        line-height: 1.6;
        resize: vertical;
    }

    textarea:focus {
        outline: none;
        border-color: var(--primary);
    }

    .action-bar {
        grid-column: 1 / -1;
        display: flex;
        justify-content: center;
        gap: 1rem;
        margin-top: 1rem;
    }

    button {
        padding: 0.8rem 2rem;
        border-radius: 12px;
        font-weight: 700;
        cursor: pointer;
        border: none;
        transition: all 0.2s ease;
    }

    .btn-primary {
        background: var(--gradient-primary);
        color: white;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(51, 153, 255, 0.3);
    }

    .btn-secondary {
        background: transparent;
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: var(--text-secondary);
    }

    .btn-secondary:hover {
        border-color: var(--text-primary);
        color: var(--text-primary);
    }

    @media (max-width: 768px) {
        .io-grid {
            grid-template-columns: 1fr;
        }

        .replacer-controls {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="container tool-container">
    <div class="tool-header">
        <h1>Content Replacer</h1>
        <p class="subtitle">Search and replace text within your content instantly.</p>
    </div>

    <div class="tool-workspace">
        <!-- Controls -->
        <div class="replacer-controls">
            <div class="input-wrapper">
                <label for="findText">Find what:</label>
                <input type="text" id="findText" placeholder="Text to find...">
            </div>
            <div class="input-wrapper">
                <label for="replaceText">Replace with:</label>
                <input type="text" id="replaceText" placeholder="Replacement text...">
            </div>

            <div class="checkbox-options">
                <label class="checkbox-label">
                    <input type="checkbox" id="matchCase"> Match Case
                </label>
                <label class="checkbox-label">
                    <input type="checkbox" id="useRegex"> Use Regular Expressions
                </label>
            </div>
        </div>

        <!-- Inputs/Outputs -->
        <div class="io-grid">
            <div class="io-section">
                <label for="contentInput">Original Content</label>
                <textarea id="contentInput" placeholder="Paste your content here..."></textarea>
            </div>
            <div class="io-section">
                <label for="contentOutput">Result</label>
                <textarea id="contentOutput" readonly placeholder="Result will appear here..."></textarea>
            </div>
        </div>

        <!-- Actions -->
        <div class="action-bar">
            <button class="btn-primary" onclick="processReplace()">Replace All</button>
            <button class="btn-secondary" onclick="copyResult()">Copy Result</button>
            <button class="btn-secondary" onclick="clearAll()">Clear</button>
        </div>
    </div>
</div>

<script>
    function processReplace() {
        const content = document.getElementById('contentInput').value;
        const find = document.getElementById('findText').value;
        const replace = document.getElementById('replaceText').value;
        const matchCase = document.getElementById('matchCase').checked;
        const useRegex = document.getElementById('useRegex').checked;

        if (!content) return;
        if (!find) {
            alert("Please enter text to find.");
            return;
        }

        let result = content;

        if (useRegex) {
            try {
                // If regex, Create RegExp object
                // Flags: 'g' for global (replace all), 'i' if case insensitive is NOT checked
                // Wait, logic: Match Case -> NO 'i' flag. Ignore Case -> 'i' flag.
                // Standard Find/Replace usually implies Global.
                const flags = matchCase ? 'g' : 'gi';
                const regex = new RegExp(find, flags);
                result = content.replace(regex, replace);
            } catch (e) {
                alert("Invalid Regular Expression: " + e.message);
                return;
            }
        } else {
            // Standard String Replace
            if (matchCase) {
                // replaceAll is ES2021, but widely supported now.
                // Or use split/join for older support.
                result = content.split(find).join(replace);
            } else {
                // Case insensitive literal match
                // Need to escape regex characters from 'find' string to use in RegExp
                const escapedFind = find.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
                const regex = new RegExp(escapedFind, 'gi');
                result = content.replace(regex, replace);
            }
        }

        document.getElementById('contentOutput').value = result;

        // Show success indicator (optional)
        const count = useRegex || !matchCase ?
            (content.match(new RegExp(useRegex ? find : find.replace(/[.*+?^${}()|[\]\\]/g, '\\$&'), matchCase ? 'g' : 'gi')) || []).length :
            (content.split(find).length - 1);

        if (count > 0) {
            // Maybe show a toast or small message? 
            // Alert is annoying but fine for MVP
            // alert(`Replaced ${count} occurrences.`);
        }
    }

    function copyResult() {
        const output = document.getElementById('contentOutput');
        output.select();
        document.execCommand('copy');
        alert('Copied to clipboard!');
    }

    function clearAll() {
        document.getElementById('contentInput').value = '';
        document.getElementById('contentOutput').value = '';
        document.getElementById('findText').value = '';
        document.getElementById('replaceText').value = '';
    }
</script>

<?php include '../includes/footer.php'; ?>