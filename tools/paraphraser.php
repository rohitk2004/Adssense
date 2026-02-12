<?php
include '../includes/config.php';
$pageInfo = [
    'title' => 'Free Paraphraser Tool - ' . SITE_NAME,
    'description' => 'Rewrite your content instantly with our free online paraphrasing tool.'
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
        font-family: inherit;
        font-size: 1rem;
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
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        margin: 1rem 0;
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
        display: flex;
        align-items: center;
        gap: 0.5rem;
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

    .btn-secondary:hover {
        background: rgba(255, 255, 255, 0.05);
        color: var(--text-primary);
    }

    @media (max-width: 768px) {
        .tool-workspace {
            grid-template-columns: 1fr;
        }

        textarea {
            height: 250px;
        }
    }
</style>

<div class="container tool-container">
    <div class="tool-header">
        <h1>Free Paraphraser</h1>
        <p class="subtitle">Rewrite your text to improve clarity and uniqueness.</p>
    </div>

    <div class="tool-workspace">
        <div class="input-group">
            <label for="inputText">Original Text</label>
            <textarea id="inputText" placeholder="Paste your text here to paraphrase..."></textarea>
        </div>

        <div class="input-group">
            <label for="outputText">Paraphrased Output</label>
            <textarea id="outputText" readonly placeholder="Your rewritten text will appear here..."></textarea>
        </div>

        <div class="controls">
            <button class="btn-action" onclick="paraphraseText()">
                <span>⚡ Paraphrase Now</span>
            </button>
            <button class="btn-action btn-secondary" onclick="copyResult()">
                <span>📋 Copy Result</span>
            </button>
            <button class="btn-action btn-secondary" onclick="clearAll()">
                <span>🗑️ Clear</span>
            </button>
        </div>
    </div>
</div>

<script>
    function paraphraseText() {
        const input = document.getElementById('inputText').value;
        const output = document.getElementById('outputText');

        if (!input.trim()) {
            alert('Please enter some text first.');
            return;
        }

        output.value = "Processing...";

        // Simple synonym dictionary for demo
        const synonyms = {
            "good": "excellent",
            "bad": "unfavorable",
            "happy": "delighted",
            "sad": "melancholy",
            "fast": "rapid",
            "slow": "sluggish",
            "big": "substantial",
            "small": "diminutive",
            "easy": "effortless",
            "hard": "challenging",
            "use": "utilize",
            "make": "create",
            "get": "obtain",
            "new": "innovative",
            "important": "crucial",
            "very": "extremely",
            "many": "numerous",
            "help": "assist",
            "look": "examine",
            "like": "enjoy",
            "want": "desire",
            "need": "require",
            "think": "believe",
            "say": "state",
            "tell": "inform",
            "ask": "inquire",
            "go": "depart",
            "come": "arrive"
            // Add more as needed
        };

        // Simulate processing delay for specific "tool feel"
        setTimeout(() => {
            let result = input;

            // Basic word replacement logic
            // Using regex to match whole words, case-insensitive
            for (const [word, synonym] of Object.entries(synonyms)) {
                const regex = new RegExp(`\\b${word}\\b`, 'gi');
                result = result.replace(regex, (match) => {
                    // Preserve capitalization
                    if (match[0] === match[0].toUpperCase()) {
                        return synonym.charAt(0).toUpperCase() + synonym.slice(1);
                    }
                    return synonym;
                });
            }

            output.value = result;
        }, 800);
    }

    function copyResult() {
        const output = document.getElementById('outputText');
        output.select();
        document.execCommand('copy');
        alert('Copied to clipboard!');
    }

    function clearAll() {
        document.getElementById('inputText').value = '';
        document.getElementById('outputText').value = '';
    }
</script>

<?php include '../includes/footer.php'; ?>